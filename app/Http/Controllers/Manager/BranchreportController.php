<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Property;
use App\Models\Branch;

class BranchreportController extends Controller
{
    public function index()
    {
        // Global KPIs
        $totalBranches = Branch::count();
        $totalCompanyStaff = Staff::count();
        $totalCompanyProperties = Property::count();
        
        // Fetch all branches with their properties (and assigned staff) and branch staff
        $branches = Branch::with(['properties.staff', 'staff'])->get();

        return view('manager.Branchreport.index', compact(
            'totalBranches', 'totalCompanyStaff', 'totalCompanyProperties', 'branches'
        ));
    }
}
