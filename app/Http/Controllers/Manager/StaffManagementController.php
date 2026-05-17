<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffManagementController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->staff && $user->staff->branch_id) {
            $staffList = Staff::with(['supervisor', 'branch', 'nextOfKin'])
                ->where('branch_id', $user->staff->branch_id)
                ->get();
                
            $supervisors = Staff::withCount('properties') // just in case, but we want staff count. Actually let's manually count or load relationship. 
                // Wait, staff relation is not strictly named "managedStaff". Let's just fetch them and we can filter or count in Blade.
                ->where('branch_id', $user->staff->branch_id)
                ->where('position', 'Supervisor')
                ->get();
                
            $assignableStaff = Staff::where('branch_id', $user->staff->branch_id)
                ->whereIn('position', ['Regular staff', 'Regular Staff', 'Secretary'])
                ->get();
        } else {
            // Fallback if the manager is not explicitly tied to a branch
            $staffList = Staff::with(['supervisor', 'branch', 'nextOfKin'])->get();
            $supervisors = Staff::where('position', 'Supervisor')->get();
            $assignableStaff = Staff::whereIn('position', ['Regular staff', 'Regular Staff', 'Secretary'])->get();
        }

        return view('manager.StaffManagement.index', compact('staffList', 'supervisors', 'assignableStaff'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Restrict positions - Manager cannot be created via this form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:M,F',
            'date_of_birth' => 'required|date',
            'nin' => 'required|string|max:255|unique:staff,nin',
            'telephone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'position' => 'required|in:Regular staff,Regular Staff,Secretary,Supervisor',
            'salary' => 'required|numeric|min:0',
            'date_started' => 'required|date',
        ]);
        
        // Assign the new staff member to the Manager's branch
        $branchId = $user->staff ? $user->staff->branch_id : null;
        
        if (!$branchId) {
            return back()->withErrors(['error' => 'You must be assigned to a branch to register staff.']);
        }
        
        $validated['branch_id'] = $branchId;
        
        // Force correct casing for PostgreSQL check constraint, ignoring browser cache
        if (isset($validated['position']) && $validated['position'] === 'Regular Staff') {
            $validated['position'] = 'Regular staff';
        }
        
        // IMPORTANT: Tell PostgreSQL the current user's role so the security trigger doesn't block the INSERT
        \DB::statement("SELECT set_config('app.current_role', ?, false)", [$user->role]);

        $staff = Staff::create($validated);
        
        // Create the login account for the new staff member
        User::create([
            'name' => $staff->full_name,
            'email' => $request->email,
            'password' => Hash::make('password'), // Default password
            'staff_id' => $staff->staff_id,
        ]);
        
        return back()->with('success', 'Staff member registered successfully. Their default password is "password".');
    }
    
    public function updateAssignment(Request $request, $supervisorId)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'staff_ids' => 'required|array|min:5|max:10',
            'staff_ids.*' => 'exists:staff,staff_id'
        ], [
            'staff_ids.min' => 'A Supervisor must manage at least 5 staff members.',
            'staff_ids.max' => 'A Supervisor cannot manage more than 10 staff members.',
            'staff_ids.required' => 'You must select between 5 and 10 staff members.'
        ]);

        $supervisor = Staff::where('position', 'Supervisor')->findOrFail($supervisorId);
        
        // IMPORTANT: Tell PostgreSQL the current user's role so the security trigger doesn't block the UPDATE
        \DB::statement("SELECT set_config('app.current_role', ?, false)", [$user->role]);

        // 1. Remove this supervisor from staff who were un-checked
        Staff::where('supervisor_id', $supervisorId)
             ->whereNotIn('staff_id', $validated['staff_ids'])
             ->update(['supervisor_id' => null]);
             
        // 2. Assign this supervisor to the checked staff
        Staff::whereIn('staff_id', $validated['staff_ids'])
             ->update(['supervisor_id' => $supervisorId]);
             
        return back()->with('success', 'Team assignment updated successfully.');
    }
    
    public function storeNextOfKin(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'next_of_kin_id' => 'nullable|integer|exists:nextofkin,next_of_kin_id',
            'staff_id' => 'required|integer|exists:staff,staff_id',
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);
        
        // Ensure manager can only add next of kin for their branch
        $targetStaff = Staff::findOrFail($validated['staff_id']);
        if ($user->staff && $user->staff->branch_id && $targetStaff->branch_id != $user->staff->branch_id) {
            abort(403, 'You can only manage next of kin for staff in your branch.');
        }

        // IMPORTANT: Tell PostgreSQL the current user's role so the security trigger doesn't block it (if applicable to this table)
        \DB::statement("SELECT set_config('app.current_role', ?, false)", [$user->role]);

        if (isset($validated['next_of_kin_id'])) {
            $kin = \App\Models\NextOfKin::findOrFail($validated['next_of_kin_id']);
            $kin->update([
                'staff_id' => $validated['staff_id'],
                'name' => $validated['name'],
                'relationship' => $validated['relationship'],
                'telephone' => $validated['telephone'],
                'address' => $validated['address'],
            ]);
            $msg = 'Next of Kin updated successfully.';
        } else {
            \App\Models\NextOfKin::create([
                'staff_id' => $validated['staff_id'],
                'name' => $validated['name'],
                'relationship' => $validated['relationship'],
                'telephone' => $validated['telephone'],
                'address' => $validated['address'],
            ]);
            $msg = 'Next of Kin registered successfully.';
        }

        return back()->with('success', $msg);
    }
}