<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class masterlistDashboardController extends Controller
{
    public function index()
    {
        return view('admin.masterlistDashboard');
    }
}