<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationEmail;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Role;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
        ],[
            'password.regex' => 'The password must be at least 8 characters long and include at least one letter, one number, and one special character.',
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );
        $attributes['role_id'] = 3;
        $attributes['role_code'] = 'C';
        $attributes['email_verified_at'] = now();
        $attributes['status'] = '0';
        $attributes['activation_token'] = Str::random(60);
        $user = User::factory()->create($attributes);
        $activationLink = route('activation', ['token' => $user->activation_token]);

        // Send activation email
        Mail::to($user->email)->send(new RegistrationEmail($user, $activationLink));

        return redirect()->route('login')->with('success', 'Registration successful! Please check your email to activate your account.');
    }
    public function generateTAC($id){
        return rand(100000, 999999); // Generate a 6-digit random code
    }
}
