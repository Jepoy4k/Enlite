<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentGrades extends Controller
{
    public function index()
    {
        return view('studentGrades');
    }
}
