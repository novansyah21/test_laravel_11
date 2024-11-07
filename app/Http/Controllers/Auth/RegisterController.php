<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Use the RegistersUsers trait
    use RegistersUsers;

    // Define the redirect path after registration
    protected $redirectTo = '/login'; // Or wherever you want to redirect after registration

    public function __construct()
    {
        // Prevent authenticated users from accessing the registration page
        $this->middleware('guest');
    }
}
