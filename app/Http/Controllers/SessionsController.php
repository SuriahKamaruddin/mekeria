<?php

namespace App\Http\Controllers;

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
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($attributes))
        {
            $auth = Auth::user()->role_code;
            session()->regenerate();
            if(Auth::user()->role_code == 'C'){
                return redirect('main-menus')->with(['success'=>'You are logged in.']);
            }else{
                return redirect('dashboard')->with(['success'=>'You are logged in.']);
            }
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }

    public function destroy()
    {
        session()->flush();
        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
