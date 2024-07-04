<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\dashboardTeacher;
use App\Http\Controllers\dashboardStudent;
use App\Http\Controllers\teachercourseManagement;
use App\Http\Controllers\courseportalteacher;
use App\Http\Controllers\studentGrades;
use App\Http\Controllers\studentCoursemanagement;
use App\Http\Controllers\teacherprofile;
use App\Http\Controllers\studentProfile;
use App\Http\Controllers\studentNotification;
use App\Http\Controllers\teachernotification;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminUI\changePasswordController;

use App\Http\Controllers\adminUI\adminDashboardController;
use App\Http\Controllers\adminUI\enrollmentDashboardController;
use App\Http\Controllers\adminUI\AdminEnrollmentManualController;
use App\Http\Controllers\adminUI\AdminEnrollmentCSVController;
use App\Http\Controllers\adminUI\UserDashboardController;
use App\Http\Controllers\adminUI\manualEntryDashboardController;
use App\Http\Controllers\adminUI\studentManualEntryController;
use App\Http\Controllers\adminUI\instructorManualEntryController;
use App\Http\Controllers\adminUI\AllUserManualEntryController;
use App\Http\Controllers\adminUI\allUserCSVController;
use App\Http\Controllers\adminUI\masterlistDashboardController;
use App\Http\Controllers\adminUI\studentMasterlistController;

use App\Http\Controllers\adminUI\instructorMasterlistController;


use App\Http\Controllers\adminUI\CourseMasterlist\ClassListController;
use App\Http\Controllers\adminUI\CourseMasterlist\CourseManagementController;


Route::get('/', function () {
    return view('login');
});

// Define the welcome route
Route::get('/login', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->RoleID == 2) {
            return redirect()->route('teacher.dashboardTeacher');
        } elseif ($user->RoleID == 3) {
            return redirect()->route('dashboardStudent');
        }elseif ($user->RoleID == 1) {
            return redirect()->route('/admin/dashboard');
        }
    }
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('login.submit');

// LOGOUT ROUTE
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//teacher side
Route::get('/dashboardteacher', [dashboardTeacher::class, 'index'])->name('dashboardTeacher');
Route::get('/teachercoursemanagement', [teachercourseManagement::class, 'index'])->name('teachercourseManagement');
Route::get('/courseportalteacher', [courseportalteacher::class, 'index'])->name('courseportalteacher');
Route::get('/teacherprofile', [teacherprofile::class, 'index'])->name('teacherprofile');
Route::get('/teachernotification', [teachernotification::class, 'index'])->name('teachernotification');



//student side
Route::get('/dashboardstudent', [dashboardStudent::class, 'index'])->name('dashboardStudent');
Route::get('/studentgrades', [studentGrades::class, 'index'])->name('studentGrades');
Route::get('/studentcoursemanagement', [studentCoursemanagement::class, 'index'])->name('studentCoursemanagement');
Route::get('/studentprofile', [studentProfile::class, 'index'])->name('studentProfile');
Route::get('/studentnotification', [studentNotification::class, 'index'])->name('studentNotification');

//admin dashboard 

Route::get('/admin/dashboard', [adminDashboardController::class, 'index'])->name('admin.dashboard');

//enrollment dashboard
Route::get('/admin/enrollmentDashboard', [enrollmentDashboardController::class, 'index'])->name('enrollment.dashboard');

//enrollment manual
Route::get('/admin/enrollmentManual', [AdminEnrollmentManualController::class, 'create'])->name('admin.enrollmentManual');
Route::post('/admin', [AdminEnrollmentManualController::class, 'store'])->name('enrollments.store');

//enrollment manual add ons
Route::get('students/filter', [AdminEnrollmentManualController::class, 'filterStudents'])->name('students.filter');
Route::get('courses/filter', [AdminEnrollmentManualController::class, 'filterCourses'])->name('courses.filter');
Route::get('course_instructors/filter_by_course', [AdminEnrollmentManualController::class, 'filterCourseInstructorsByCourse'])->name('course_instructors.filter_by_course');
Route::get('course_instructors/filter', [AdminEnrollmentManualController::class, 'filterCourseInstructors'])->name('course_instructors.filter');
Route::post('enrollments/store', [AdminEnrollmentManualController::class, 'store'])->name('enrollments.store');
Route::delete('enrollments/{id}', [AdminEnrollmentManualController::class, 'destroy'])->name('enrollments.destroy');
Route::get('/course/instructors', [AdminEnrollmentManualController::class, 'fetchInstructorsByCourse'])->name('course.instructors');
Route::get('/course/instructor/by/course/instructor', [AdminEnrollmentManualController::class, 'fetchCourseInstructorByCourseInstructor'])->name('course.instructor.by.course.instructor');

// enrollment CSV
Route::get('/admin/enrollmentCSV', [AdminEnrollmentCSVController::class, 'index'])->name('admin.enrollmentCSV');
Route::post('/import', [AdminEnrollmentCSVController::class, 'create'])->name('import.studentEnrollment');


//User Dashboard
Route::get('/admin/userDashboard', [UserDashboardController::class, 'index'])->name('admin.userDashboard');

//Manual Entry User Dashboard
Route::get('/admin/manualEntryDashboard', [manualEntryDashboardController::class, 'index'])->name('admin.manualEntryDashboard');

//Student User Manual Entry 

Route::get('/admin/studentManualEntry', [studentManualEntryController::class, 'index'])->name('admin.studentManualEntry');
Route::post('/admin/studentManualEntry', [studentManualEntryController::class, 'store'])->name('admin.studentManualEntry.store');

//Instructor Manual Entry
Route::get('/admin/instructorManualEntry', [instructorManualEntryController::class, 'index'])->name('admin.instructorManualEntry');
Route::post('/admin/instructorManualEntry', [instructorManualEntryController::class, 'store'])->name('admin.instructorManualEntry');

//Admin All User Manual Entry
Route::get('/admin/AllUserManualEntry', [AllUserManualEntryController::class, 'create'])->name('admin.AllUserManualEntry');
Route::post('/admin/AllUserManualEntry', [AllUserManualEntryController::class, 'store'])->name('admin.AllUserManualEntry');

//admin Import CSV File for User
// Route::get('/admin/create-users', function () {
//     return view('admin.createUsers.UserCSV');
// })->name('createUsers.view');

// Route::post('/admin/import-users', [AdminCSVUserController::class, 'import'])->name('import.users');

//USERS (instructorss and Teachers) CSV IMPORT
//Student
Route::get('/admin/allUsersCSV', [allUserCSVController::class, 'indexStudent'])->name('admin.UsersCSV');
Route::post('/admin/studentCSV', [allUserCSVController::class, 'createStudent'])->name('admin.studentCSV');
Route::post('/admin/usersCSV', [allUserCSVController::class, 'createUsers'])->name('admin.usersCSV');
Route::post('/admin/instructorCSV', [allUserCSVController::class, 'createInstructor'])->name('admin.instructorCSV');

//admin masterlist dashbaord
Route::get('/admin/masterlistDashboard', [masterlistDashboardController::class, 'index'])->name('admin.masterlistDashboard');

//student Masterlist
// Route::get('/admin/students/index', [studentMasterlistController::class, 'index'])->name('admin.studentMasterlist');
Route::get('/admin/students', [studentMasterlistController::class, 'index'])->name('students.index');
Route::get('/admin/students/search', [studentMasterlistController::class, 'search'])->name('students.search');
Route::get('/admin/students/create', [studentMasterlistController::class, 'create'])->name('students.create');
Route::post('/admin/students', [studentMasterlistController::class, 'store'])->name('students.store');
Route::get('/admin/students/{id}/edit', [studentMasterlistController::class, 'edit'])->name('students.edit');
Route::put('/admin/students/{id}', [studentMasterlistController::class, 'update'])->name('students.update');
Route::delete('/admin/students/{id}', [studentMasterlistController::class, 'destroy'])->name('students.destroy');
Route::get('/admin/grades/{id}/grades', [studentMasterlistController::class, 'grades'])->name('admin.grades.grades');



Route::get('/admin/grades/{id}/edit', [studentMasterlistController::class, 'editGrade'])->name('grades.edit');
Route::put('/admin/grades/{id}', [studentMasterlistController::class, 'updateGrade'])->name('grades.update');


//routes masterlist instructor

Route::get('admin/instructors', [instructorMasterlistController::class, 'index'])->name('instructors.index');
Route::get('admin/instructors/{id}/edit', [instructorMasterlistController::class, 'edit'])->name('instructors.edit');
Route::put('admin/instructors/{id}', [instructorMasterlistController::class, 'update'])->name('instructors.update');
Route::get('admin/instructors/{id}/courses', [instructorMasterlistController::class, 'showCourses'])->name('instructors.courses');
Route::post('admin/instructors/{id}/courses/{courseId}/add', [instructorMasterlistController::class, 'addCourse'])->name('instructors.courses.add');
Route::put('admin/instructors/{id}/courses/{courseId}/drop', [instructorMasterlistController::class, 'dropCourse'])->name('instructors.courses.drop');
Route::post('/search-courses', [instructorMasterlistController::class, 'searchCourses'])->name('search.courses');
Route::post('admin/instructors/{id}/courses/search', [instructorMasterlistController::class, 'searchCourses'])->name('instructors.courses.search');

//masterlist Course

Route::get('admin/course-management', [CourseManagementController::class, 'index'])->name('course_management.index');
Route::post('admin/course-management/export', [CourseManagementController::class, 'export'])->name('course_management.export');


Route::get('admin/classlist', [ClassListController::class, 'index'])->name('classlist.index');
Route::get('admin/classlist/fetch-instructors', [ClassListController::class, 'fetchInstructors'])->name('classlist.fetchInstructors');
Route::get('admin/classlist/show', [ClassListController::class, 'show'])->name('classlist.show');
Route::post('admin/classlist/export', [ClassListController::class, 'export'])->name('classlist.export');

//change passwordaccount
Route::get('admin/profile/change-password', [changePasswordController::class, 'showChangePasswordForm'])->name('profile.changePasswordForm');
Route::post('admin/profile/change-password', [changePasswordController::class,  'changePassword'])->name('profile.changePassword');