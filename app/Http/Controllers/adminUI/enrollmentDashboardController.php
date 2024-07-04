<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class enrollmentDashboardController extends Controller
{
    public function index()
    {
        return view('admin.enrollmentDashboard');
    }
}
