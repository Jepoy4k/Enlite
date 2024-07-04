<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminEnrollmentCSVController extends Controller
{
    public function index()
    {
        return view('admin.enrollmentCSV');
    }

    public function create(Request $request)
{
    if (!$request->hasFile('file')) {
        return redirect()->back()->with('error', 'No file uploaded.');
    }

    $file = $request->file('file');
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
                // Assuming CSV columns: Year_SemID, StudentID, Course_InstructorID

                // Check if the combination already exists
                $existingRecord = Enrollment::where('Year_SemID', $data[0])
                                            ->where('StudentID', $data[1])
                                            ->where('Course_InstructorID', $data[2])
                                            ->first();

                if ($existingRecord) {
                    // If record exists, add a warning message
                    $warnings[] = "Record with Year_SemID: {$data[0]}, StudentID: {$data[1]} and Course_InstructorID: {$data[2]} already exists.";
                    continue;
                }

                // Check if the student exists
                $student = Student::where('StudentID', $data[1])->first();

                if (!$student) {
                    // If student does not exist, add a warning message
                    $warnings[] = "StudentID: {$data[1]} does not exist in the students table.";
                    continue;
                }

                // Create enrollment
                Enrollment::create([
                    'Year_SemID' => $data[0],
                    'StudentID' => $data[1],
                    'Course_InstructorID' => $data[2],
                ]);

                // Update student's enrollment status
                $student->EnrollmentStatus = 'Enrolled';
                $student->save();

                $successfulInsertions++;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $errors[] = 'Error importing CSV: ' . $e->getMessage();
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

    return redirect()->back()->with('success', $successMessage)->with('warnings', $warningMessages)->with('errors', $errorMessages);
    }
}