<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllUsers;
use App\Models\Role;
use App\Models\Student;

class studentManualEntryController extends Controller
{
    public function index()
    {
        // Fetch users who have RoleID of 3 (student) and are not yet associated with a StudentID in the Student table
        $studentsRoleID = Role::where('RoleName', 'Student')->first()->RoleID;

        $users = AllUsers::where('RoleID', $studentsRoleID)
                     ->whereDoesntHave('student')
                     ->get();

        // Fetch the next StudentID
        $nextStudentID = Student::max('StudentID') + 1;

        return view('admin.studentManualEntry', compact('users', 'nextStudentID'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'UserID' => 'required|string|max:255',
            'FirstName' => 'required|string|max:255',
            'MiddleName' => 'nullable|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255',
            'Address' => 'nullable|string|max:255',
            'Birthdate' => 'required|date',
            'ContactNumber' => 'nullable|string|max:255',
            'EnrollmentStatus' => 'nullable|string|max:255',
        ]);

        // Check for unique combination of FirstName and LastName
        $existingStudent = Student::where('FirstName', $request->input('FirstName'))
            ->where('LastName', $request->input('LastName'))
            ->first();

        if ($existingStudent) {
            return redirect()->back()->withErrors(['FirstName' => "A student with the name {$existingStudent->FirstName} {$existingStudent->LastName} already exists."]);
        }

        Student::create($validated);

        return redirect()->route('admin.studentManualEntry')->with('success', 'New Student Added.');
    }
}
