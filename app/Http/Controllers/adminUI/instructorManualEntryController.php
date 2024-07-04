<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllUsers;
use App\Models\Role;
use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Validation\Rule;


class instructorManualEntryController extends Controller
{
    public function index()
    {
        $role = Role::where('RoleName', 'Teacher')->first();
        $users = AllUsers::where('RoleID', $role->RoleID)
                        ->whereDoesntHave('instructor')
                        ->get();
        $nextInstructorID = Instructor::max('InstructorID') + 1;
        return view('admin.instructorManualEntry', compact('users', 'nextInstructorID'));
    }

    public function create()
    {
        // Fetch users who have RoleID of 2 (instructor) and are not yet associated with an InstructorID in the Instructor table
        $role = Role::where('RoleName', 'Teacher')->first();

        // if (!$role) {
        //     // Handle case where 'Instructor' role does not exist
        //     return redirect()->back()->with('error', 'Role "Instructor" not found.');
        // }

        $users = AllUsers::where('RoleID', $role->RoleID)
                        ->whereDoesntHave('instructor')
                        ->get();

        // Fetch the next InstructorID
        $nextInstructorID = Instructor::max('InstructorID') + 1;

        return view('admin.instructorManualEntry', compact('users', 'nextInstructorID'));
    }


    public function store(Request $request)
{
    $request->validate([
        'UserID' => 'required|string|max:255',
        'FirstName' => 'required|string|max:255',
        'MiddleName' => 'nullable|string|max:255',
        'LastName' => 'required|string|max:255',
        'Email' => 'required|string|email|max:255',
        'Address' => 'nullable|string|max:255',
    ]);

    // Check for unique combination of FirstName and LastName
    $existingInstructor = Instructor::where('FirstName', $request->input('FirstName'))
        ->where('LastName', $request->input('LastName'))
        ->first();

    if ($existingInstructor) {
        return redirect()->back()->withErrors(['FirstName' => "You already have an account {$existingInstructor->FirstName} {$existingInstructor->LastName}."]);
    }

    Instructor::create($request->all());

    return redirect()->route('admin.instructorManualEntry')->with('success', 'Instructor created successfully.');
}
}
