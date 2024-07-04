<?php

namespace App\Http\Controllers\adminUI\CourseMasterlist;

use Illuminate\Http\Request;
use App\Models\CourseManagement;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class CourseManagementController extends Controller
{
    public function index()
    {
        $courses = CourseManagement::all();
        return view('admin.course_management.index', compact('courses'));
    }

    public function export(Request $request)
    {
        $courses = CourseManagement::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'CourseID');
        $sheet->setCellValue('B1', 'Description');
        $sheet->setCellValue('C1', 'Credits');

        $rowNumber = 2;
        foreach ($courses as $course) {
            $sheet->setCellValue('A' . $rowNumber, $course->CourseID);
            $sheet->setCellValue('B' . $rowNumber, $course->Description);
            $sheet->setCellValue('C' . $rowNumber, $course->Credits);
            $rowNumber++;
        }

        $writer = new Csv($spreadsheet);
        $filename = 'courses.csv';

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
