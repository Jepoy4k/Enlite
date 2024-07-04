<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AllUsers;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['Username' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            if ($user->RoleID == 2) {
                return redirect()->intended('/teacher/dashboard');
            } elseif ($user->RoleID == 3) {
                return redirect()->intended('/student/dashboard');
            }elseif ($user->RoleID == 1) {
                return redirect()->intended('/admin/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
