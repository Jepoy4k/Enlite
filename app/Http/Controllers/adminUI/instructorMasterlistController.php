<?php

// app/Http/Controllers/InstructorController.php


namespace App\Http\Controllers\adminUI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\CourseInstructor;
use App\Models\CourseManagement;
use Illuminate\Support\Facades\DB;

class instructorMasterlistController extends Controller
{

public function index()
    {
        $instructors = Instructor::all();
        return view('admin.instructors.index', compact('instructors'));
    }

    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('admin.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, $id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->update($request->all());

        session()->flash('success', 'Instructor updated successfully!');
        
        return redirect()->route('instructors.index');
    }

        // app/Http/Controllers/InstructorController.php

        public function showCourses($id)
        {
            $instructor = Instructor::findOrFail($id);
        
            // Fetch added courses for the instructor
            $addedCourses = DB::table('course_instructor')
                             ->where('InstructorID', $id)
                             ->where('Drop', 0)
                             ->select('CourseID')
                             ->get()
                             ->map(function ($course) {
                                 $courseDetails = CourseManagement::find($course->CourseID);
                                 return (object) [
                                     'CourseID' => $course->CourseID,
                                     'Description' => $courseDetails->Description,
                                 ];
                             });
        
            $addedCourseIDs = $addedCourses->pluck('CourseID')->toArray();  // Convert to array of IDs
            $courses = CourseManagement::all();
        
            return view('admin.instructors.courses', compact('instructor', 'courses', 'addedCourses', 'addedCourseIDs'));
        }

        public function addCourse($instructorId, $courseId)
        {
            $instructor = Instructor::findOrFail($instructorId);
        
            // Check if the instructor already has the course with Drop = 1
            $existingCourseInstructor = CourseInstructor::where('InstructorID', $instructorId)
                ->where('CourseID', $courseId)
                ->where('Drop', 1)
                ->first();
        
            if ($existingCourseInstructor) {
                // Update the existing record to set Drop = 0
                $existingCourseInstructor->Drop = 0;
                $existingCourseInstructor->save();
            } else {
                // Create a new course_instructor record
                $instructor->courses()->attach($courseId);
            }
        
            return redirect()->route('instructors.courses', $instructor->InstructorID)
                             ->with('success', 'Course added successfully.');
        }
        
        public function dropCourse($instructorId, $courseId)
        {
            $instructor = Instructor::findOrFail($instructorId);
        
            // Find the course_instructor record and mark it as deleted
            $courseInstructor = CourseInstructor::where('InstructorID', $instructorId)
                ->where('CourseID', $courseId)
                ->first();
        
            if ($courseInstructor) {
                $courseInstructor->Drop = 1;
                $courseInstructor->save();
            }
        
            return redirect()->route('instructors.courses', $instructor->InstructorID)
                             ->with('success', 'Course dropped successfully.');
        }

        public function searchCourses(Request $request, $id) {
            $searchTerm = $request->input('searchTerm');
            $courses = CourseManagement::where('CourseID', 'LIKE', "%{$searchTerm}%")
                ->orWhere('Description', 'LIKE', "%{$searchTerm}%")
                ->get();
            
            $instructor = Instructor::findOrFail($id);
            $addedCourses = DB::table('course_instructor')
                                 ->where('InstructorID', $id)
                                 ->where('Drop', 0)
                                 ->select('CourseID')
                                 ->get()
                                 ->map(function ($course) {
                                     $courseDetails = CourseManagement::find($course->CourseID);
                                     return (object) [
                                         'CourseID' => $course->CourseID,
                                         'Description' => $courseDetails->Description,
                                     ];
                                 });
            $addedCourseIDs = $addedCourses->pluck('CourseID')->toArray();  // Convert to array of IDs
        
            return view('admin.instructors.courses', compact('instructor', 'courses', 'addedCourses', 'addedCourseIDs'));
        }
}


//     public function index()
//     {
//         $instructors = Instructor::all();
//         $courses = CourseManagement::all(); 
    
//         foreach ($instructors as $instructor) {
//             $instructor->addedCourses = $instructor->courses;
//             $instructor->addedCourseIDs = $instructor->courses->pluck('CourseID')->toArray();
//             $instructor->addedCoursesList = $instructor->courses->pluck('CourseID'); // Add this line
//         }
    
//         return view('admin.instructors.instructorMasterlist', compact('instructors', 'courses'));
//     }

//     public function edit($id)
//     {
//         $instructor = Instructor::findOrFail($id);
//         return view('instructors.edit', compact('instructor'));
//     }

//     public function update(Request $request, $id)
//     {
//         $instructor = Instructor::findOrFail($id);
//         $instructor->update($request->all());
//         return redirect()->route('instructors.index');
//     }

//         // app/Http/Controllers/InstructorController.php

// // public function showCourses($id)
// // {
// //     $instructor = Instructor::findOrFail($id);

// //     // Fetch added courses for the instructor
// //     $addedCourses = DB::table('course_instructor')
// //                      ->where('InstructorID', $id)
// //                      ->where('Drop', 0)
// //                      ->select('CourseID')
// //                      ->get();

// //     $addedCourseIDs = $addedCourses->pluck('CourseID')->toArray();  // Convert to array of IDs
// //     $courses = CourseManagement::all();

// //     return view('instructors.courses', compact('instructor', 'courses', 'addedCourses', 'addedCourseIDs'));
// // }
// public function showCourses($id)
// {
//     $instructor = Instructor::find($id);
//     $courses = Course::all();
//     $addedCourses = $instructor->courses;
//     $addedCourseIDs = $addedCourses->pluck('CourseID')->toArray();

//     return view('admin.instructors.courses', compact('instructor', 'courses', 'addedCourses', 'addedCourseIDs'));
// }

// public function addCourse($instructorId, $courseId)
// {
//     $instructor = Instructor::findOrFail($instructorId);

//     // Attach the course to the instructor
//     $instructor->courses()->attach($courseId);

//     return redirect()->route('instructors.courses', $instructor->InstructorID)
//                      ->with('success', 'Course added successfully.');
// }
// public function dropCourse($instructorId, $courseId)
// {
//     $instructor = Instructor::findOrFail($instructorId);

//     // Find the course_instructor record and mark it as deleted
//     $courseInstructor = DB::table('course_instructor')
//                          ->where('InstructorID', $instructorId)
//                          ->where('CourseID', $courseId)
//                          ->update(['Drop' => 1]);

//     return redirect()->route('instructors.courses', $instructor->InstructorID)
//                      ->with('success', 'Course dropped successfully.');
// }

// public function courses(Instructor $instructor)
// {
//     $instructor = Instructor::findOrFail($instructor->InstructorID);

//     // Fetch added courses for the instructor
//     $addedCourses = DB::table('course_instructor')
//                      ->where('InstructorID', $instructor->InstructorID)
//                      ->where('Drop', 0)
//                      ->select('CourseID')
//                      ->get();

//     $addedCourseIDs = $addedCourses->pluck('CourseID')->toArray();  // Convert to array of IDs
//     $courses = CourseManagement::all();

//     return view('instructors.courses', compact('instructor', 'courses', 'addedCourses', 'addedCourseIDs'));
// }

// public function showInstructorDetails($id)
// {
//     $instructor = Instructor::findOrFail($id);
//     $courses = CourseManagement::all();
//     $addedCourses = $instructor->courses;
//     $addedCourseIDs = $addedCourses->pluck('CourseID')->toArray();

//     return view('admin.instructors.instructor-details', compact('instructor', 'courses', 'addedCourses', 'addedCourseIDs'));
// }
