<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return view('home.client', [
                'featuredProperties' => \App\Models\Property::with(['owner', 'branch'])
                    ->where('is_active', true)
                    ->where('status', 'Available')
                    ->orderBy('date_added', 'desc')
                    ->take(6)
                    ->get(),
                'stats' => [
                    'properties' => \App\Models\Property::where('is_active', true)->count(),
                    'available'  => \App\Models\Property::where('is_active', true)->where('status', 'Available')->count(),
                    'owners'     => \App\Models\Owner::count(),
                    'avg_rent'   => (int) round(\App\Models\Property::where('is_active', true)->avg('monthly_rent') ?? 0),
                ],
            ]);
        }

        return match (auth()->user()->role) {
            'admin'  => redirect()->route('admin.home'),
            'staff'  => redirect()->route('staff.home'),
            default  => redirect()->route('client.home'),
        };
    }
}