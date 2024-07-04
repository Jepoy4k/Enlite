<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Grade;
use App\Models\CourseManagement;


class studentMasterlistController extends Controller
{
    public function index()
    {
        
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }
    
    public function search(Request $request)
    {
        $studentID = $request->input('student_id');

        if ($studentID) {
            $students = Student::where('StudentID', $studentID)->get();
        } else {
            $students = Student::all();
        }

        return view('admin.students.index', compact('students'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'MiddleName' => 'nullable|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Address' => 'required|string|max:255',
            'Birthdate' => 'required|date',
            'ContactNumber' => 'required|string|max:20',
            'EnrollmentStatus' => 'required|string|max:255',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'MiddleName' => 'nullable|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Address' => 'required|string|max:255',
            'Birthdate' => 'required|date',
            'ContactNumber' => 'required|string|max:20',
            'EnrollmentStatus' => 'required|string|max:255',
        ]);

        $student = new Student($request->all());
        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully');
    }
    public function grades($id)
    {
        // Fetch the student
        $student = Student::findOrFail($id);

        // Fetch the grades for the student
        $grades = \DB::table('grade')
                    ->join('course_instructor', 'grade.Course_InstructorID', '=', 'course_instructor.Course_InstructorID')
                    ->join('course_management', 'course_instructor.CourseID', '=', 'course_management.CourseID')
                    ->where('grade.StudentID', $id)
                    ->select('course_management.Description as CourseDescription', 'grade.Midterm', 'grade.Final', 'grade.GradeID')
                    ->get();

        // Calculate GPA
        $totalGrades = $grades->sum('Final');
        $numberOfCourses = $grades->count();
        $gpa = $numberOfCourses > 0? $totalGrades / $numberOfCourses : 0;

        return view('admin.grades.grades', compact('student', 'grades', 'gpa'));
    }
    
    public function editGrade($id)

    {
        $grade = \DB::table('grade')
                    ->join('course_instructor', 'grade.Course_InstructorID', '=', 'course_instructor.Course_InstructorID')
                    ->join('course_management', 'course_instructor.CourseID', '=', 'course_management.CourseID')
                    ->where('grade.GradeID', $id)
                    ->select('grade.*', 'course_management.Description as CourseDescription')
                    ->first();
        return view('admin.grades.edit', compact('grade'));

    }


public function updateGrade(Request $request, $id)

    {
        $request->validate([
            'Midterm' => 'required|numeric|between:0,5',
            'Final' => 'required|numeric|between:0,5',
        ]);
        // Find the grade record by its primary key
        $grade = Grade::findOrFail($id);
        $grade->Midterm = $request->input('Midterm');
        $grade->Final = $request->input('Final');
        $grade->save();
        return redirect()->route('admin.grades.grades', $grade->StudentID)->with('success', 'Grade updated successfully');
    }

    public function showGrades($studentID)
    {
        $student = Student::findOrFail($studentID);
        $grades = Grade::where('StudentID', $studentID)->get();

        $grades = $grades->map(function ($grade) {
            $course = CourseManagement::where('CourseID', $grade->course_instructor->CourseID)->first();
            $grade->CourseDescription = $course->Description;
            $grade->Remarks = ($grade->Midterm + $grade->Final) / 2 > 3.00 ? 'Passed' : 'Failed';
            return $grade;
        });

        return view('admin.grades.grades', compact('student', 'grades'));
    }
    

}