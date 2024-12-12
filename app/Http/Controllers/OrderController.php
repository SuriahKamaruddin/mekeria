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
}