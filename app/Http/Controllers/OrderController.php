<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Role;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $staff = User::where('role_code', 'S')->get();
        $confirmorder = Payment::with('paymentorder.order.menus','paymentorder.order.addOn.menusAddon','users')
        ->whereNot('status',4)->orderBy('id', 'desc')->get();
        return view('pages/order-management', compact('confirmorder','staff'));
    }
  
    public function update_prepare_order_management(Request $request){
        $id = $request->id;
        $order = Payment::where('id', $id)->update([
            'status' => '2',
            'updated_by' => auth()->user()->name,
        ]);
        if($order){
            $message = 'Selected order have update status to preparing!';
            return redirect()->route('order-management-index')->with('success', $message);
        }else{
            $message = 'Failed to update Order. Please try again later!';
            return redirect()->route('order-management-index')->with('error', $message);
        }
        
    }
    public function update_deliver_order_management(Request $request){
        $id = $request->id;
        $order = Payment::where('id', $id)->update([
            'status' => '3',
            'updated_by' => auth()->user()->name,
            'deliver_by' => $request->staff,
        ]);
        if($order){
            $message = 'Selected order have update status to delivered!';
            return redirect()->route('order-management-index')->with('success', $message);
        }else{
            $message = 'Failed to update Order. Please try again later!';
            return redirect()->route('order-management-index')->with('error', $message);
        }
    }
    public function update_complete_order_management(Request $request){
        $id = $request->id;
        $order = Payment::where('id', $id)->update([
            'status' => '4',
            'updated_by' => auth()->user()->name,

        ]);
        if($order){
            $message = 'Selected order have update status to completed!';
            return redirect()->route('order-management-index')->with('success', $message);
        }else{
            $message = 'Failed to update Order. Please try again later!';
            return redirect()->route('order-management-index')->with('error', $message);
        }
    }

    public function history_index()
    {
        $confirmorder = Payment::with('paymentorder.order.menus','paymentorder.order.addOn.menusAddon','users')
        ->where('status',4)->orderBy('id', 'desc')->get();
        return view('pages/history-management', compact('confirmorder'));
    }
    
}