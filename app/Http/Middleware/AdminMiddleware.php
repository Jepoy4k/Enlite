<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Define the routes that require authentication
        $authRoutes = [
            'login',
            'logout',
            'dashboardTeacher',
            'teachercourseManagement',
            'courseportalteacher',
            'teacherprofile',
            'teachernotification',
            'dashboardStudent',
            'tudentgrades',
            'tudentcoursemanagement',
            'tudentprofile',
            'tudentnotification',
            'admin.dashboard',
            'enrollment.dashboard',
            'admin.enrollmentManual',
            'admin.enrollmentCSV',
            'admin.userDashboard',
            'admin.manualEntryDashboard',
            'admin.studentManualEntry',
            'admin.instructorManualEntry',
            'admin.AllUserManualEntry',
            'admin.masterlistDashboard',
            'tudents.index',
            'tudents.search',
            'tudents.create',
            'tudents.store',
            'tudents.edit',
            'tudents.update',
            'tudents.destroy',
            'admin.grades.grades',
            'grades.edit',
            'grades.update',
            'instructors.index',
            'instructors.edit',
            'instructors.update',
            'instructors.courses',
            'instructors.courses.add',
            'instructors.courses.drop',
            'earch.courses',
            'course_management.index',
            'course_management.export',
            'classlist.index',
            'classlist.fetchInstructors',
            'classlist.show',
            'classlist.export',
            'profile.changePasswordForm',
            'profile.changePassword',
        ];

        // Check if the current route is in the auth routes array
        if (in_array(Route::currentRouteName(), $authRoutes)) {
            // Check if the user is authenticated
            if (!Auth::check()) {
                // Redirect to the login page if not authenticated
                return redirect()->route('login');
            }
        }

        // Allow the request to proceed
        return $next($request);
    }
}