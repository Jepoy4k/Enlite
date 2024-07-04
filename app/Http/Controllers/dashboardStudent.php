<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardStudent extends Controller
{
    public function index()
    {
        return view('dashboardStudent');
    }
}
