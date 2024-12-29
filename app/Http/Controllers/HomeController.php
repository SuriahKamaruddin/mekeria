<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $monthlySales = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlySales[] = Payment::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total');
        }

        $menuIds = Order::where('status',1)->distinct()->pluck('menus_id'); // Get all unique menu IDs
        $monthlySalesByMenu = [];

        foreach ($menuIds as $menuId) {
            $menus = Menus::find($menuId);
            $monthlySales = [];
            for ($month = 1; $month <= 12; $month++) {
                $monthlySales[] = Order::where('menus_id', $menuId) // Filter by menu ID
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->sum('subtotal');
            }
            $monthlySalesByMenu[$menus->menus_name] = $monthlySales;
        }
        $customer = User::where('role_code', 'C')->where('status', 1)->count();
        $orderCount = Order::whereNot('status', 0)
            ->whereDate('created_at', Carbon::today())
            ->count();
        $sales = Payment::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');
        $dailySales = Payment::whereDate('created_at', Carbon::today())
            ->sum('total');

        $cart = Order::where('status', 0)
            ->whereDate('created_at', Carbon::today())
            ->count();
        $new = Payment::where('status', 1)
            ->whereDate('created_at', Carbon::today())
            ->count();
        $preparing = Payment::whereIn('status', [2,3])
            ->whereDate('created_at', Carbon::today())
            ->count();
        $completed = Payment::where('status', 4)
            ->whereDate('created_at', Carbon::today())
            ->count();

            $menus = Menus::all();


        return view('dashboard', [
            'customer' => $customer,
            'orderCount' => $orderCount,
           'sales' => number_format($sales, 2),
            'dailySales' => number_format($dailySales, 2),
            'monthlySales' => $monthlySales,
            'monthlySalesByMenu' => $monthlySalesByMenu,
            'cart' => $cart,
            'new' => $new,
            'preparing' => $preparing,
            'completed' => $completed,
            'menus' => $menus,
        ]);
    }
}
