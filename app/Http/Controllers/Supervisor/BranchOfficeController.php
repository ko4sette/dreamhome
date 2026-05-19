<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchOfficeController extends Controller
{
    public function index()
    {
        return view('supervisor.BranchOffice.index');
    }
}
