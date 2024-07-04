<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\AllUsers;
use App\Models\Instructor;

class allUserCSVController extends Controller
{
    public function indexStudent()
    {
        return view('admin.allUsersCSV');
    }

    public function createStudent(Request $request)
    {
        if (!$request->hasFile('csv_file')) {
        return redirect()->back()->with('student_error', 'No file uploaded.');
    }

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $successfulInsertions = 0;
        $warnings = [];
        $errors = [];

        // Open the CSV file
        if (($handle = fopen($file->getPathname(), 'r')) !== false) {
            // Skip the header row
            fgetcsv($handle, 1000, ',');

            DB::beginTransaction();
            try {
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    // Assuming CSV columns: UserID, FirstName, MiddleName, LastName, Email, Address, Birthdate, ContactNumber, EnrollmentStatus

                    // Check if the student already exists
                    $existingStudent = Student::where('UserID', $data[0])->first();

                    if ($existingStudent) {
                        // If student exists, add a warning message
                        $warnings[] = "Student with UserID: {$data[0]} already exists.";
                        continue;
                    }

                    // Create student
                    Student::create([
                        'UserID' => $data[0],
                        'FirstName' => $data[1],
                        'MiddleName' => $data[2],
                        'LastName' => $data[3],
                        'Email' => $data[4],
                        'Address' => $data[5],
                        'Birthdate' => $data[6],
                        'ContactNumber' => $data[7],
                        'EnrollmentStatus' => $data[8],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $successfulInsertions++;
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $errors[] = 'Error importing CSV: ' . $e->getMessage();
                Log::error($e->getMessage()); // Log the error message
            }
        }

        // Prepare appropriate messages
        $message = "$successfulInsertions records were successfully inserted.";
        $successMessage = $message;
        $warningMessages = [];
        $errorMessages = [];

        if (!empty($warnings)) {
            $warningMessages = $warnings;
        }

        if (!empty($errors)) {
            $errorMessages = $errors;
        }

        return redirect()->back()->with('student_success', $successMessage)
                        ->with('student_warnings', $warningMessages) 
                        ->with('student_error', count($errors) > 0 ? $errors : null);
    }

    public function createUsers(Request $request)
{
    if (!$request->hasFile('csv_file')) {
        return redirect()->back()->with('user_error', 'No file uploaded.');
    }

    

    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
    ]);

    $file = $request->file('csv_file');
    $successfulInsertions = 0;
    $warnings = [];
    $errors = [];

    // Check file size
    if ($file->getSize() > 1024 * 1024) { // 1MB
        return redirect()->back()->with('user_error', 'File size exceeds 1MB.');
    }

    // Check MIME type
    $mimeType = $file->getMimeType();
    if (!in_array($mimeType, ['text/csv', 'text/plain'])) {
        return redirect()->back()->with('user_error', 'Invalid file type. Only CSV and TXT files are allowed.');
    }

    // Open the CSV file
    if (($handle = fopen($file->getPathname(), 'r')) !== false) {
        // Skip the header row
        fgetcsv($handle, 1000, ',');

        DB::beginTransaction();
        try {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // Assuming CSV columns: RoleID, Username, Password

                // Check if the username already exists
                $existingUser = AllUsers::where('Username', $data[1])->first();

                if ($existingUser) {
                    // If user exists, prepare a message
                    $warnings[] = "Username: {$data[1]} already exists.";
                    continue;
                }

                // Create user
                AllUsers::create([
                    'RoleID' => $data[0],
                    'Username' => $data[1],
                    'Password' => Hash::make($data[2]),
                ]);
                $successfulInsertions++;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $errors[] = 'Error importing CSV: ' . $e->getMessage();
            Log::error($e->getMessage()); // Log the error message
        }
    } else {
        $errors[] = 'Error opening CSV file.';
    }

    // Prepare appropriate messages
    $message = "$successfulInsertions records were successfully inserted.";
    $successMessage = $message;

    return redirect()->back()->with('user_success', $successMessage)
                    ->with('user_warnings', $warnings) 
                    ->with('user_error', count($errors) > 0 ? $errors : null);
}
public function createInstructor(Request $request)
    {
        if (!$request->hasFile('csv_file')) {
            return redirect()->back()->with('instructor_error', 'No file uploaded.');
        }

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $successfulInsertions = 0;
        $warnings = [];
        $errors = [];

        // Open the CSV file
        if (($handle = fopen($file->getPathname(), 'r')) !== false) {
            // Skip the header row
            fgetcsv($handle, 1000, ',');

            DB::beginTransaction();
            try {
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    // Assuming CSV columns: UserID, FirstName, MiddleName, LastName, Email, Address

                    // Check if the instructor already exists
                    $existingInstructor = Instructor::where('UserID', $data[0])->first();

                    if ($existingInstructor) {
                        // If instructor exists, add a warning message
                        $warnings[] = "Instructor with UserID: {$data[0]} already exists.";
                        continue;
                    }

                    // Create instructor
                    Instructor::create([
                        'UserID' => $data[0],
                        'FirstName' => $data[1],
                        'MiddleName' => $data[2],
                        'LastName' => $data[3],
                        'Email' => $data[4],
                        'Address' => $data[5],
                        
                    ]);

                    $successfulInsertions++;
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $errors[] = 'Error importing CSV: ' . $e->getMessage();
                Log::error($e->getMessage()); // Log the error message
            }
        }

        // Prepare appropriate messages
        $message = "$successfulInsertions records were successfully inserted.";
        $successMessage = $message;
        $warningMessages = [];
        $errorMessages = [];

        if (!empty($warnings)) {
            $warningMessages = $warnings;
        }

        if (!empty($errors)) {
            $errorMessages = $errors;
        }

        return redirect()->back()->with('instructor_success', $successMessage)
                        ->with('instructor_warnings', $warningMessages) 
                        ->with('instructor_error', count($errors) > 0 ? $errors : null);
    }
}
