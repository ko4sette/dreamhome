<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class StaffManagementController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Ensure managers only see staff within their assigned branch
        if ($user->staff && $user->staff->branch_id) {
            $staffList = Staff::with(['supervisor', 'branch'])
                ->where('branch_id', $user->staff->branch_id)
                ->get();
        } else {
            // Fallback if the manager is not explicitly tied to a branch
            $staffList = Staff::with(['supervisor', 'branch'])->get();
        }

        return view('manager.StaffManagement.index', compact('staffList'));
    }
}
