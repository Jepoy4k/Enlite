<?php

namespace App\Http\Controllers\adminUI\CourseMasterlist;

use Illuminate\Http\Request;
use App\Models\CourseManagement;
use App\Models\CourseInstructor;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class ClassListController extends Controller
{
    public function index()
    {
        $courses = CourseManagement::all();
        return view('admin.classlist.index', compact('courses'));
    }

    public function fetchInstructors(Request $request)
{
    $courseID = $request->input('courseID');

    $instructors = DB::table('course_instructor as ci')
        ->join('instructors as i', 'ci.InstructorID', '=', 'i.InstructorID')
        ->where('ci.CourseID', $courseID)
        ->select('i.InstructorID', 'i.FirstName', 'i.LastName')
        ->get();

    return response()->json($instructors);
}

    public function show(Request $request)
    {
        $courseID = $request->input('courseID');
        $instructorID = $request->input('instructorID');

        $studentsQuery = DB::table('enrollments as e')
            ->join('students as s', 'e.StudentID', '=', 's.StudentID')
            ->join('course_instructor as ci', 'e.Course_InstructorID', '=', 'ci.Course_InstructorID')
            ->where('ci.CourseID', $courseID);

        if ($instructorID !== 'all') {
            $studentsQuery->where('ci.InstructorID', $instructorID);
        }

        $students = $studentsQuery->select('s.StudentID', 's.FirstName', 's.LastName', 's.Email')->get();

        $courses = DB::table('course_management')
            ->select('CourseID', 'Description')
            ->distinct()
            ->get();

        return view('admin.classlist.index', compact('students', 'courses', 'courseID', 'instructorID'));
    }

    public function export(Request $request)
{
    $courseID = $request->input('courseID');
    $instructorID = $request->input('instructorID');

    $courseDetails = DB::table('course_management as cm')
        ->where('cm.CourseID', $courseID)
        ->select('cm.CourseID', 'cm.Description')
        ->first();

    $instructors = DB::table('course_instructor as ci')
        ->join('instructors as i', 'ci.InstructorID', '=', 'i.InstructorID')
        ->where('ci.CourseID', $courseID)
        ->select('i.FirstName', 'i.LastName');

    if ($instructorID !== 'all') {
        $instructors->where('ci.InstructorID', $instructorID);
    }

    $instructorList = $instructors->get();

    $studentsQuery = DB::table('enrollments as e')
        ->join('students as s', 'e.StudentID', '=', 's.StudentID')
        ->join('course_instructor as ci', 'e.Course_InstructorID', '=', 'ci.Course_InstructorID')
        ->where('ci.CourseID', $courseID);

    if ($instructorID !== 'all') {
        $studentsQuery->where('ci.InstructorID', $instructorID);
    }

    $students = $studentsQuery->select('s.StudentID', 's.FirstName', 's.LastName', 's.Email')->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

 
    $sheet->setCellValue('A1', 'Course ID');
    $sheet->setCellValue('B1', $courseDetails->CourseID);
    $sheet->setCellValue('A2', 'Description');
    $sheet->setCellValue('B2', $courseDetails->Description);

    
    $instructorNames = $instructorList->map(fn($inst) => $inst->FirstName . ' ' . $inst->LastName)->join(', ');
    $sheet->setCellValue('A3', 'Instructor(s)');
    $sheet->setCellValue('B3', $instructorNames);

    
    $sheet->setCellValue('A5', 'Student ID');
    $sheet->setCellValue('B5', 'First Name');
    $sheet->setCellValue('C5', 'Last Name');
    $sheet->setCellValue('D5', 'Email');

    // spreadsheet 
    $rowNumber = 6;
    foreach ($students as $student) {
        $sheet->setCellValue('A' . $rowNumber, $student->StudentID);
        $sheet->setCellValue('B' . $rowNumber, $student->FirstName);
        $sheet->setCellValue('C' . $rowNumber, $student->LastName);
        $sheet->setCellValue('D' . $rowNumber, $student->Email);
        $rowNumber++;
    }

    $writer = new Csv($spreadsheet);
    $filename = 'classlist.csv';

    return response()->streamDownload(function() use ($writer) {
        $writer->save('php://output');
    }, $filename, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
}

}
