<?php

namespace App\Http\Controllers\adminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Enrollment;
use App\Models\YearSemester;
use App\Models\Student;
use App\Models\CourseInstructor;
use App\Models\CourseManagement;

use Illuminate\Support\Facades\Log;

class AdminEnrollmentManualController extends Controller
{
    public function index()
    {
        return view('admin.enrollmentManual');
    }

    public function create()
    {
        $yearSemesters = YearSemester::all();
        $students = Student::all();
        $courseInstructors = CourseInstructor::all();

        return view('admin.enrollmentManual', compact('yearSemesters', 'students', 'courseInstructors'));
    }

    public function filterStudents(Request $request)
    {
        $studentID = $request->input('StudentID');
        $students = Student::where('StudentID', 'LIKE', "%{$studentID}%")->get();

        return response()->json($students);
    }


    public function filterCourses(Request $request)
    {
        $courseID = $request->input('CourseID');
        $courses = CourseManagement::where('CourseID', 'LIKE', "%{$courseID}%")->get(['CourseID', 'Description']);

        return response()->json($courses);
    }


    public function filterCourseInstructorsByCourse(Request $request)
    {
        $courseID = $request->input('CourseID');
        $instructors = CourseInstructor::with('instructor')
                        ->where('CourseID', $courseID)
                        ->get()
                        ->pluck('instructor');

        return response()->json($instructors);
    }

    public function fetchInstructorsByCourse(Request $request)
    {
        $courseID = $request->input('CourseID');
        $instructors = CourseInstructor::with('instructor')
                        ->where('CourseID', $courseID)
                        ->get()
                        ->pluck('instructor');

        return response()->json($instructors);
    }

    public function fetchCourseInstructorByCourseInstructor(Request $request)
    {
        $courseID = $request->input('CourseID');
        $instructorID = $request->input('InstructorID');

        $courseInstructor = CourseInstructor::where('CourseID', $courseID)
                            ->where('InstructorID', $instructorID)
                            ->first();

        if ($courseInstructor) {
            return response()->json(['Course_InstructorID' => $courseInstructor->Course_InstructorID]);
        } else {
            return response()->json(['error' => 'Course Instructor not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'Year_SemID' => 'required|exists:year_semester,Year_SemID',
            'StudentID' => 'required|exists:students,StudentID',
            'CourseID' => 'required|exists:course_management,CourseID',
            'InstructorID' => 'required|exists:instructors,InstructorID',
            'Course_InstructorID' => 'required|exists:course_instructor,Course_InstructorID',
        ]);

        // Check if the student is already enrolled in the specified course with the given instructor for the selected semester
        $existingEnrollment = Enrollment::where('StudentID', $request->input('StudentID'))
            ->where('Year_SemID', $request->input('Year_SemID'))
            ->where('Course_InstructorID', $request->input('Course_InstructorID'))
            ->exists();

        if ($existingEnrollment) {
            return redirect()->route('admin.enrollmentManual')->with('error', 'Student is already enrolled in this course with the selected instructor for the chosen semester.');
        }

        // Create the enrollment
        Enrollment::create($request->all());

        // Update the student's enrollment status to 'Enrolled'
        $student = Student::find($request->input('StudentID'));
        if ($student) {
            $student->EnrollmentStatus = 'Enrolled';
            $student->updated_at = now(); // Set updated_at to the current timestamp
            $student->save();

            // Debugging information
            Log::info('Student updated:', ['StudentID' => $student->StudentID, 'updated_at' => $student->updated_at]);
        }

        return redirect()->route('admin.enrollmentManual')->with('success', 'Student enrolled successfully.');
    }


    public function destroy($id)
    {
        // Find the enrollment and delete it
        $enrollment = Enrollment::findOrFail($id);
        $studentID = $enrollment->StudentID;
        $enrollment->delete();

        // Check if the student is still enrolled in any courses
        $remainingEnrollments = Enrollment::where('StudentID', $studentID)->count();
        if ($remainingEnrollments == 0) {
            $student = Student::find($studentID);
            if ($student) {
                $student->EnrollmentStatus = 'Unenrolled';
                $student->updated_at = now(); // Set updated_at to the current timestamp
                $student->save();

                // Debugging information
                Log::info('Student updated:', ['StudentID' => $student->StudentID, 'updated_at' => $student->updated_at]);
            }
        }

        return redirect()->route('enrollments.index')->with('success', 'Enrollment removed successfully.');
    }
}
