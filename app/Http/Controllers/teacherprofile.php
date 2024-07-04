<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class teacherprofile extends Controller
{
  
    public function index()
    {
        return view('teacherprofile');
    }
}