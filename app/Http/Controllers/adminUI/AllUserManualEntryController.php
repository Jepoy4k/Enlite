<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllUsers;
use App\Models\Role;

class AllUserManualEntryController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $nextUserID = AllUsers::max('UserID') + 1;
        return view('admin.AllUserManualEntry', compact('roles', 'nextUserID'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'RoleID' => 'required|integer|exists:roles,RoleID',
            'Username' => 'required|string|max:255|unique:all_users,Username',
            'Password' => 'required|string|min:8|confirmed',
        ]);

        try {
            AllUsers::create($validated);
            return redirect()->route('admin.AllUserManualEntry')->with('success', 'User created successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.AllUserManualEntry')->with('error', 'Username already exists. Please choose a different username.');
        }
    }
}
