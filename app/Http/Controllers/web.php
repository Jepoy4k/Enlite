<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardStudent;
use App\Http\Controllers\dashboardTeacher;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GradeEditController;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\CourseManagementController;
use App\Http\Controllers\CourseAssignmentController;
use App\Http\Middleware\EnsureTeacher;
use App\Http\Middleware\EnsureStudent;

Route::get('/import', function () {
    return view('import');
})->name('import.view');

Route::post('/import', [StudentController::class, 'import'])->name('import');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/changePassword', [ProfileController::class, 'showChangePasswordForm'])->name('profile.changePasswordForm');
    Route::post('/profile/changePassword', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
});

// HOME / LOGIN IF NOT AUTHENTICATED
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->RoleID == 2) {
            return redirect()->route('teacher.dashboardTeacher');
        } elseif ($user->RoleID == 3) {
            return redirect()->route('dashboardStudent');
        }
    }
    return view('auth.login');
})->name('login');

// LOGIN ROUTE
Route::get('/login', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->RoleID == 2) {
            return redirect()->route('teacher.dashboardTeacher');
        } elseif ($user->RoleID == 3) {
            return redirect()->route('dashboardStudent');
        }
    }
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('login.submit');

// LOGOUT ROUTE
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// TEACHER DASHBOARD ROUTE | ERROR IF TRY TO ACCESS AS TEACHER OR NO LOGIN
Route::get('/student/dashboard', function () {
    if (Auth::check() && Auth::user()->RoleID == 3) {
        return app(dashboardStudent::class)->index();
    }
    return redirect('/')->withErrors(['You are not authorized to access the student dashboard.']);
})->name('dashboardStudent');

// TEACHER DASHBOARD ROUTE | ERROR IF TRY TO ACCESS AS STUDENT OR NO LOGIN
Route::get('/teacher/dashboard', function () {
    if (Auth::check() && Auth::user()->RoleID == 2) {
        return app(dashboardTeacher::class)->index();
    }
    return redirect('/')->withErrors(['You are not authorized to access the teacher dashboard.']);
})->name('teacher.dashboardTeacher');

// TEACHER MIDDLEWARE GROUP FOR SECURING ROUTE FOR TEACHER
Route::middleware(['auth', EnsureTeacher::class])->group(function () {
    // COURSE MANAGEMENT ROUTES
    Route::get('/teacher/course-management', [CourseManagementController::class, 'index'])->name('teacher.courseManagement');
    
    // COURSE ASSIGNMENT ROUTES
    Route::get('/teacher/assignCourse', [CourseAssignmentController::class, 'create'])->name ('teacher.assignCourse');
    Route::post('/teacher', [CourseAssignmentController::class, 'store'])->name  ('teacher.store'); 
    Route::post('/teacher/delete-courses', [CourseManagementController::class, 'deleteSelectedCourses'])->name('teacher.deleteSelectedCourses');
    
    // ENROLLMENT ROUTES
    Route::get('/teacher/enrollments', [EnrollmentController::class, 'create'])->name('teacher/enrollments.create');
    Route::post('/teacher/enrollments', [EnrollmentController::class, 'store'])->name('teacher/enrollments.store');
    Route::get('/teacher/enrollments/search-students', [EnrollmentController::class, 'searchStudents'])->name('teacher/enrollments.searchStudents');
    Route::get('/get-enrolled-students/{courseInstructorID}', [EnrollmentController::class, 'getEnrolledStudents']);
    Route::post('/drop-students', [EnrollmentController::class, 'dropStudents'])->name('teacher.dropStudents');
    Route::get('/teacher/enrollments/search-students', [EnrollmentController::class, 'searchStudents'])->name('teacher/enrollments.searchStudents');
    Route::post('/teacher/enrollments/drop-students', [EnrollmentController::class, 'dropStudents'])->name('teacher/enrollments.dropStudents');
    Route::post('/teacher/enrollments/drop-students', [EnrollmentController::class, 'dropStudents'])->name('teacher.enrollments.drop');

    // GRADING ROUTES
    Route::get('/teacher/grades-management', [GradingController::class, 'view'])->name('teacher.grades.view');
    Route::get('/teacher/grades/get-grades', [GradingController::class, 'getGrades'])->name('teacher.grades.getGrades');
    Route::post('/teacher/grades/update', [GradingController::class, 'updateGrade'])->name('teacher.grades.updateGrade');
    Route::get('/teacher/grades/edit/{gradeID}', [GradingController::class, 'editGrade'])->name('teacher.grades.editGrade');
    Route::post('/teacher/grades/edit/{gradeID}', [GradingController::class, 'manageGrade'])->name('teacher.grades.manageGrade');
    Route::put('/teacher/grades/update/{gradeID}', [GradeEditController::class, 'update'])->name('teacher.grades.update');

    // NOTIFICATION ROUTES

});


Route::middleware(['auth', EnsureStudent::class])->group(function () {

    Route::get('/student/enrollments', [StudentController::class, 'enrollments'])->name('student.enrollments');
    Route::delete('/student/enrollment/drop/{id}', [StudentController::class, 'dropEnrollment'])->name('student.enrollment.drop');
    Route::get('/student/grades', [StudentController::class, 'grades'])->name('student.grades');
    

});