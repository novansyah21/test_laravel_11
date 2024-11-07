<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Fetch user ID
            $userId = Auth::id();

            // Fetch unique menu access for the logged-in user
            $menus = AuditTrail::where('user_id', $userId)
                ->select('menu_accessed')
                ->distinct()
                ->pluck('menu_accessed');

            // Store menu access in session
            Session::put('user_menus', $menus);

            $isAdmin = Auth::user()->role->id == 1;
            // Redirect based on role
            if ($isAdmin) {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('sales.index');
            }
        } else {
            return redirect()->back()->withErrors(['username' => 'Invalid credentials'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('user_menus'); // Clear menu access from session
        return redirect()->route('login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);        

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 2, // Optional role assignment
        ]);

        // Log the user in and redirect
        auth()->login($user);
        return redirect()->route('dashboard.index');
    }

}
