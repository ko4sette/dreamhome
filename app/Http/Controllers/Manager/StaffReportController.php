<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class StaffReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->staff && $user->staff->branch_id) {
            $staffList = Staff::where('branch_id', $user->staff->branch_id)->get();
        } else {
            $staffList = Staff::all();
        }
        
        return view('manager.StaffReport.index', compact('staffList'));
    }

    public function updateFinancials(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|integer|exists:staff,staff_id',
            'salary' => 'required|numeric|min:0',
            'car_allowance' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
        ]);

        $staff = Staff::findOrFail($validated['staff_id']);
        
        $user = auth()->user();
        if ($user->staff && $user->staff->branch_id && $staff->branch_id != $user->staff->branch_id) {
            abort(403, 'You can only update financials for staff in your branch.');
        }

        \DB::statement("SELECT set_config('app.current_role', ?, false)", [$user->role]);

        $staff->update([
            'salary' => $validated['salary'],
            'car_allowance' => $validated['car_allowance'],
            'bonus' => $validated['bonus'],
        ]);

        return back()->with('success', 'Staff financial records updated successfully.');
    }
}
