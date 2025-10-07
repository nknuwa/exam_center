<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate input fields
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:10' // At least 6 characters, max 20
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.exists' => 'This email is not registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.max' => 'Password cannot exceed 10 characters.'
        ]);

        // Attempt authentication with "remember me"
        $remember = $request->has('remember'); // Check if checkbox is checked

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            return redirect()->route('home'); // Redirect on success
        }


        // If authentication fails, return an error
        return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
    }

    public function destroy(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been successfully logout'); // Redirect to login page
    }
}
