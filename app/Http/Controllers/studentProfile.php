<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentProfile extends Controller
{
  
    public function index()
    {
        return view('studentProfile');
    }
}
