<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UserManagement extends Controller
{
    public function index()
    {
        $users = User::with('role')->where('role_code', '!=', 'C')->get();
        return view('pages.user-management', compact('users'));
    }
    public function add_user_management(Request $request){
        $type = $request->type;
        $id = $request->id;
        $roles = Role::all();
        if ($type == 0) {
            $user = null;
        } else {
            $user = User::where('id', $id)->first();
        }
        return view('pages.add-user-management', compact('roles','user', 'type', 'id'));
    }
    public function insert_user_management(Request $request){
        $message = '';

        $type = $request->type;
        $id = $request->id;
        if($type == 0){
            $email = $request->email;
            $checkUserEmail = User::where('email', 'like', '%' . $email . '%')->get();
            if(!$checkUserEmail->isEmpty()){
                $message .= 'Email is already exists. Please try again!<br>';
            }

            if($message == ''){
                $role = Role::find($request->role);
                $user = User::factory()->create([
                    'name' => $request->name,
                    'email' => Str::lower($request->email),
                    'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'role_id' => $role->id,
                    'role_code' => $role->role_code,
                    'status' => 1,
                ]);

                if($user){
                    $message = 'Successfully add new user';
                    return redirect()->route('user-index')->with('success', $message);
                }else{
                    $message = 'Failed to add user. Please try again later.';
                    return redirect()->back()->with('error', $message);
                }

            }else{
                return redirect()->back()->with('error', $message);
            }
        }else{
            $email = $request->email;
            $checkUserEmail = User::where('email', 'like', '%' . $email . '%')->where('id', '!=', $id)->get();
            if(!$checkUserEmail->isEmpty()){
                $message .= 'Email is already exists. Please try again!<br>';
            }
            if($message == ''){$role = Role::find($request->role);
                $user = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => Str::lower($request->email),
                    // 'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'role_id' => $role->id,
                    'role_code' => $role->role_code,
                    'status' => 1,
                ]);
                if ($request->filled('password')) {
                    $user = User::where('id', $id)->update([
                        'password' => bcrypt($request->password),
                    ]);
                }
                if($user){
                    $message = 'Selected user have been updated';
                    return redirect()->route('user-index')->with('success', $message);
                }else{
                    $message = 'Failed to update user. Please try again later.';
                    return redirect()->back()->with('error', $message);
                }

            }else{
                return redirect()->back()->with('error', $message);
            }
        }



    }
    public function delete_user_management(Request $request){
        $user = User::where('id', $request->id)->delete();

        if($user){
            $message = 'Selected user have been deleted!';
            return redirect()->route('user-index')->with('success', $message);
        }else{
            $message = 'Failed to delete user. Please try again later.';
            return redirect()->route('user-index')->with('error', $message);
        }
    }

    public function customer_index()
    {
        $users = User::with('role')->where('role_code', '=', 'C')->get();
        return view('pages.customer-management', compact('users'));
    }
}
