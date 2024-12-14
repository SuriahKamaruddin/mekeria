<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Role;
use App\Models\Order;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['users', 'menus'])->get();
        return view('pages/order-management', compact('orders'));
    }
    public function update_prepare_order_management(Request $request){
        $id = $request->id;
        $order = Order::where('id', $id)->update([
            'status' => '2',
        ]);
        if($order){
            $message = 'Selected order have update status to preparing have been updated!';
            return redirect()->route('order-management-index')->with('success', $message);
        }else{
            $message = 'Failed to update Order. Please try again later!';
            return redirect()->route('order-management-index')->with('error', $message);
        }
        
    }
    public function update_deliver_order_management(Request $request){
        $id = $request->id;
        $order = Order::where('id', $id)->update([
            'status' => '3',
        ]);
        if($order){
            $message = 'Selected order have update status to delivered have been updated!';
            return redirect()->route('order-management-index')->with('success', $message);
        }else{
            $message = 'Failed to update Order. Please try again later!';
            return redirect()->route('order-management-index')->with('error', $message);
        }
    }
    
}