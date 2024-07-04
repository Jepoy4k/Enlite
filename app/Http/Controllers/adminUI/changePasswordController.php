<?php

namespace App\Http\Controllers\adminUI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use App\Models\AllUsers;

class changePasswordController extends Controller
{

    public function showChangePasswordForm()
{
    return view('admin.changePassword');
}

public function changePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'current_password' => 'required|min:8',
        'new_password' => 'required|confirmed|min:8',
    ]);

    if (Hash::check($request->current_password, $user->Password)) {
        $user->password = $request->new_password; // Use the setPasswordAttribute method
        $user->save();

        session()->flash('success', 'Password changed successfully.');
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('profile.changePasswordForm')->withErrors(['current_password' => 'Current password is incorrect.']); // Redirect to profile with error
    }
}

}
