<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // For now, we will pass mock data to the dashboard
        $teamSize = 7; // Mock data for a supervisor's team size (min 5, max 10)
        $managedProperties = 14; // Mock data
        $activeLeases = 10; // Mock data
        $pendingInspections = 3; // Mock data

        return view('supervisor.dashboard', compact(
            'teamSize', 
            'managedProperties', 
            'activeLeases', 
            'pendingInspections'
        ));
    }
}