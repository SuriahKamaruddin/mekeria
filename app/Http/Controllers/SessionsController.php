<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if the email exists in the database
        $user = User::where('email', $attributes['email'])->first();

        if ($user) {
            // Check if the user has exceeded the login attempts
            $attempts = session()->get('login_attempts_' . $attributes['email'], 0);

            if ($attempts >= 3) {
                // If the user has tried 3 times, block them and allow password reset
                return back()->withErrors([
                    'email' => 'Your account has been temporarily blocked due to too many failed login attempts. '
                        . 'Please reset your password.'
                ]);
            }

            // Attempt to authenticate the user
            if (Auth::attempt($attributes)) {
                session()->forget('login_attempts_' . $attributes['email']);

                $user = Auth::user();
                session()->regenerate();

                // Check user status
                if ($user->status == 0) {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Your account is inactive. Please contact support.']);
                }

                // Redirect based on the role
                if ($user->role_code == 'C') {
                    return redirect('main-menus')->with(['success' => 'You are logged in.']);
                } else {
                    return redirect('dashboard')->with(['success' => 'You are logged in.']);
                }
            } else {
                // If login fails, increment the attempt counter
                session()->put('login_attempts_' . $attributes['email'], $attempts + 1);

                return back()->withErrors(['email' => 'Email or password is invalid.']);
            }
        } else {
            // If the email does not exist, just return the generic error
            return back()->withErrors(['email' => 'Email or password is invalid.']);
        }
    }


    public function destroy()
    {
        session()->flush();
        Auth::logout();

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
