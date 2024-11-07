<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the user profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the 'role' relationship is loaded
        $user->load('role');

        // Return the view with the user data
        return view('profile.show', compact('user'));
    }

    /**
     * Update the user profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user data
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
        ]);

        // Redirect back with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
