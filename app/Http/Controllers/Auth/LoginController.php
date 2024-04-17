<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to home page or any other route
            return redirect()->route('home');
        }

        // Authentication failed, redirect back with error message
        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::logout();

        // Redirect to login page after logout
        return redirect()->route('login');
    }
}
