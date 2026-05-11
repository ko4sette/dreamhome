<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Staff;

class AdminHomeController extends Controller
{
    public function index()
    {
        return view('admin.home', [
            'totalProperties' => Property::count(),
            'availableProperties' => Property::where('status', 'Available')->count(),
            'rentedProperties' => Property::where('status', 'Rented')->count(),
            'owners' => Owner::count(),
            'branches' => Branch::count(),
            'staffCount' => Staff::count(),
            'avgRent' => (int) round(Property::avg('monthly_rent') ?? 0),
            'recentProperties' => Property::with('owner')
                ->latest('date_added')
                ->take(6)
                ->get(),
        ]);
    }
}