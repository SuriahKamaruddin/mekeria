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
        $carts = Order::all();
        return view('main_menus', compact('category', 'carts'));
    }
    public function add_cart(Request $request)
    {
        $user = auth()->user();
        $menuId = $request->id;
        $quantity = $request->quantity;
        $addons = $request->addons;

        $menu = Menus::find($menuId);
        $order = Order::where('customer_id', $user->id)
        ->where('menus_id', $menuId)
        ->where('status', 0)
        ->first();

    // Flag to determine if we need to create a new order or not
    $createNewOrder = false;

    if ($order) {
        // Check if addons match
        $existingAddons = OrderAddOn::where('order_id', $order->id)
            ->pluck('addon_id')
            ->toArray();

        // Compare existing addons with the requested addons
        if (!empty($addons)) {
            $addonsMatch = count($addons) === count($existingAddons) && !array_diff($addons, $existingAddons);
        } else {
            $addonsMatch = empty($existingAddons);
        }

        if ($addonsMatch) {
            // Add to the existing order
            $order->quantity += $quantity;
            $order->subtotal += $menu->price * $quantity;
            $order->total = $order->subtotal * $menu->discount / 100;
            $order->save();
        } else {
            // Addons are different, so create a new order
            $createNewOrder = true;
        }
    } else {
        // No existing order found, create a new order
        $createNewOrder = true;
    }

    if ($createNewOrder) {
        // Create a new order
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

       if($addons){
           foreach ($addons as $addon) {
               OrderAddOn::create([
                   'order_id' => $order->id,
                   'addon_id' => $addon,
               ]);
           }
       }
    }

    if($order){

            return response()->json(['success' => true, 'message' => 'Item added to cart successfully']);
        }else{
            return response()->json(['error' => true, 'message' => 'Error! Please try again later.']);

        }

    }
}
