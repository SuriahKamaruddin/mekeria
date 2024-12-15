<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menus;
use App\Models\Order;
use App\Models\OrderAddOn;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $salesItems = Menus::where('is_sale', 1)->get();
        foreach ($category as $cat) {
            // Fetch the first 5 menus for each category
            $cat->menus = $cat->menus()->take(5)->get();
        }


        return view('main', compact('category', 'salesItems'));
    }

    public function main_menus()
    {

        $category = Category::with('menus')->get();
        return view('main_menus', compact('category'));
    }
    public function add_cart(Request $request)
    {
        $user = auth()->user();
        $menuId = $request->id;
        $quantity = $request->quantity;
        $addons = $request->addons;

        $menu = Menus::find($menuId);

        $order = Order::create([
            'customer_id' => $user->id,
            'menus_id' => $menuId,
            'quantity' => $quantity,
            'price' => $menu->price,
            'subtotal' => $menu->price * $quantity,
            'discount' => $menu->discount,
            'total' => $menu->price * $quantity * $menu->discount / 100,
            'status' => 0
        ]);
        if ($order) {

            foreach ($addons as $addon) {
                $order = OrderAddOn::create([
                    'order_id' => $order->id,
                    'addon_id' => $addon,
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Item added to cart successfully']);
        }else{
            return response()->json(['error' => true, 'message' => 'Error! Please try again later.']);

        }

    }
}
