<?php

namespace App\Http\Controllers;

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
        $role_id = Role::where('name', $request->role)->value('id');
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            //'agreement' => ['accepted'],
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );
        $attributes['role_id'] = $role_id;
        $attributes['email_verified_at'] = now();
        $attributes['status'] = '0';
        
        session()->flash('success', 'Your account has been created.');
        $user = User::factory()->create($attributes);
        //$tac = $this->generateTAC($user->id);
        ///dd($tac);
        //Mail::to($user->email)->send();
        if($user){
            Auth::login($user); 
            return redirect('/dashboard');
        }else{
            
        }
    }
    public function generateTAC($id){
        return rand(100000, 999999); // Generate a 6-digit random code
    }
}
