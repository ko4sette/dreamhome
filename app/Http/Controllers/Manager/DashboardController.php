<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Branch;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isBranchRestricted = $user->staff && $user->staff->branch_id;

        if ($isBranchRestricted) {
            $branchId = $user->staff->branch_id;
            
            $totalStaff = Staff::where('branch_id', $branchId)->count();
            $totalBranches = 1; // Manager is restricted to their own branch
            $totalSupervisors = Staff::where('branch_id', $branchId)->where('position', 'Supervisor')->count();
            $totalProperties = Property::where('branch_id', $branchId)->count();
            
        } else {
            // Global view for unrestrained managers
            $totalStaff = Staff::count();
            $totalBranches = Branch::count();
            $totalSupervisors = Staff::where('position', 'Supervisor')->count();
            $totalProperties = Property::count();
        }

        return view('Manager.dashboard', compact(
            'totalStaff',
            'totalBranches',
            'totalSupervisors',
            'totalProperties'
        ));
    }
}