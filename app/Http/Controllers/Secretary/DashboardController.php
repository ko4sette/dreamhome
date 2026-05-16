<?php

namespace App\Http\Controllers\Secretary;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('secretary.dashboard');
    }
}