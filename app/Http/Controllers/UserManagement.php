<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserManagement extends Controller
{
    public function index()
    {
        $staffs = User::with('role')->get();
        $roles = Role::all();
        return view('pages.user-management', compact('roles','staffs'));
        // return view('pages.user-management')->with('roles', $roles);
    }

    // public function dropdown_role(){
    //     $roles = Role::all();
    //     return view('content.laravel-examples.user-management', compact('roles'));
    // }
    public function add_staff(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required',
            'phone' => 'required|numeric',
            'role' => 'required',
        ]);
        if ($request->password !== $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'The password confirmation does not match.'])->withInput();
        };

        try {
            User::factory()->create([
                'name' => $request->name,
                'email' => Str::lower($request->email),
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'role_id' => $request->role,
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }
    // public function get_roles_user(){

    //     $roles = Role::all();
    //     return view('pages.user-management', compact('roles'));
    // }
    // public function staff_table_view(){
    //     $staffs = User::all();

    //     dd($staffs);
    //     return view('content.laravel-examples.user-management', compact('staffs'));
    // }
    // public function changePassword(Request $request)
    // {
        
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|min:8|confirmed',
    //     ]);
    
    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password)
    //             ])->setRememberToken(Str::random(60));
    
    //             $user->save();
    
    //             event(new PasswordReset($user));
    //         }
    //     );
    
    //     return $status === Password::PASSWORD_RESET
    //                 ? redirect('/login')->with('success', __($status))
    //                 : back()->withErrors(['email' => [__($status)]]);
    // }
}
