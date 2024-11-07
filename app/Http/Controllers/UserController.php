<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AuditTrail; 

class UserController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
        $users = User::where('id', '!=', Auth::id())->get(); // Exclude current admin user
        $menus = AuditTrail::where('user_id', $userId)
            ->select('menu_accessed')
            ->distinct()
            ->pluck('menu_accessed');
        return view('users.index', compact('users', 'menus'));
    }

    // Show the form to edit a user
    public function edit(User $user)
    {
        $userId = Auth::id();
        // Ensure the user is not editing themselves (admin can only edit other users)
        if (Auth::id() == $user->id) {
            return redirect()->route('user.index')->with('error', 'You cannot edit your own account.');
        }

        $menus = AuditTrail::where('user_id', $userId)
        ->select('menu_accessed')
        ->distinct()
        ->pluck('menu_accessed');
        return view('users.edit', compact('user', 'menus'));
    }

    // Update the user data
    public function update(Request $request, User $user)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update the user with the validated data
        $user->update($validatedData);

        // Redirect to the users list page with a success message
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }


}
