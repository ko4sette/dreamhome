<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Staff;

class StaffHomeController extends Controller
{
    public function index()
    {
        return view('staff.home', [
            'totalProperties' => Property::count(),
            'availableProperties' => Property::where('status', 'Available')->count(),
            'rentedProperties' => Property::where('status', 'Rented')->count(),
            'owners' => Owner::count(),
            'staffMember' => auth()->user()->name,
            'recentProperties' => Property::with('owner')
                ->latest('date_added')
                ->take(5)
                ->get(),
        ]);
    }
}