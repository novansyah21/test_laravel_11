<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        // Only guests (not logged in users) should access login, except for logout
        $this->middleware('guest')->except('logout');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login'); // Your login view
    }

    // Handle login attempt
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the intended page
            return redirect()->intended('dashboard'); // Or wherever you want to send them after login
        }

        // Authentication failed, return to login with error message
        return redirect()->back()->withErrors(['username' => 'Invalid credentials.']);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect to login page after logout
    }
}
