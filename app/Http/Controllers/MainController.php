<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menus;
use App\Models\MenusAddon;
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
                $order->discount += $menu->discount * $quantity;
                // Calculate the total discount (apply the discount to subtotal)
                $order->total = $order->subtotal - $order->discount;

                // Add addon prices to total
                $addonTotal = 0;
                if ($addons) {
                    foreach ($addons as $addon) {
                        $addonItem = MenusAddon::find($addon); // Assuming you have an AddOn model to fetch the addon price
                        $addonTotal += $addonItem->price; // Sum up the prices of the addons
                    }
                }

                // Update the total by adding the addon price
                $order->total += ($addonTotal * $quantity);

                $order->save();
            } else {
                // No existing order found, create a new order
                $createNewOrder = true;
            }
        } else {
            // No existing order found, create a new order
            $createNewOrder = true;
        }

            if ($createNewOrder) {
                // Calculate the price for addons
                $addonTotal = 0;
                if ($addons) {
                    foreach ($addons as $addon) {
                        $addonItem = MenusAddon::find($addon); // Assuming you have an AddOn model to fetch the addon price
                        $addonTotal += $addonItem->price; // Sum up the prices of the addons
                    }
                }

                // Create a new order
                $order = Order::create([
                    'customer_id' => $user->id,
                    'menus_id' => $menuId,
                    'quantity' => $quantity,
                    'price' => $menu->price,
                    'subtotal' => $menu->price * $quantity,
                    'discount' => $menu->discount * $quantity,
                    'total' => (($menu->price - ($menu->price * $menu->discount / 100)) * $quantity) + ($addonTotal * $quantity), // Add addon price to total
                    'status' => 0
                ]);
            }

            if ($addons) {
                foreach ($addons as $addon) {
                    OrderAddOn::create([
                        'order_id' => $order->id,
                        'addon_id' => $addon,
                    ]);
                }
            }


            if ($order) {
                return response()->json(['success' => true, 'message' => 'Item added to cart successfully']);
            } else {
                return response()->json(['error' => true, 'message' => 'Error! Please try again later.']);
            }
        }
        
    
    // public function order_qty(Request $request){

    //     $orderID = $request->id;
    //     $quantity = $request->qty;
    //     $order = Order::where('id', $orderID)->first();
    //     $menu = Menus::find($order->menus_id);
    //     $order->quantity = $quantity;
    //     $order->subtotal += $order->price * $quantity;
    //     $order->total = ($order->price-($order->price * $menu->discount / 100)) * $quantity;
    //     $order->save();
    // }
    public function remove_order(Request $request)
    {
        $order = Order::where('id', $request->id)->first()->delete();
        $addons = OrderAddOn::where('order_id', $request->id)->delete();
    }
    public function display_cart()
    {

        if (auth()->check() == true) {
            $cart = Order::with('menus', 'order_addons.menusAddon')
                ->where('customer_id', auth()->user()->id)
                ->where('status', 0)
                ->get();

            $cartarray = [];

            foreach ($cart as $key => $value) {
                $cartarray[] = [
                    'id' => $value->id,
                    'menus_img' => $value->menus->menus_img,
                    'menus' => $value->menus->menus_name,
                    'quantity' => $value->quantity,
                    'price' => number_format($value->price, 2),        // Format to 2 decimal places
                    'subtotal' => number_format($value->subtotal, 2),  // Format to 2 decimal places
                    'discount' => number_format($value->discount, 2),  // Format to 2 decimal places
                    'total' => number_format($value->total, 2),        // Format to 2 decimal places
                    'add_ons' => $value->order_addons->map(function ($addon) {
                        return [
                            'name' => $addon->menusAddon->name,
                            'price' => number_format($addon->menusAddon->price, 2) // Format add-on price
                        ];
                    })
                ];
            }
        }
        return response()->json($cartarray);
    }

    public function updateQuantity(Request $request)
    {
        $cart = Order::with('menus')->where('id', $request->cart_id)->first();
        $addons = OrderAddOn::where('order_id', $request->cart_id)->get();
        $addonTotal = 0;
        if ($addons) {
            foreach ($addons as $addon) {
                $addonItem = MenusAddon::find($addon->addon_id); // Assuming you have an AddOn model to fetch the addon price
                $addonTotal += $addonItem->price; // Sum up the prices of the addons
            }
        }
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->subtotal = $cart->price * $cart->quantity;
            $cart->discount = $cart->menus->discount * $cart->quantity;
            $cart->total = ($cart->subtotal - $cart->discount) + ($addonTotal * $cart->quantity); // Add addon price to total
            $cart->save();

            return response()->json(['message' => 'Quantity updated successfully.']);
        }

        return response()->json(['message' => 'Cart item not found.'], 404);
    }

    public function removeItem(Request $request)
    {
        $cart = Order::find($request->cart_id);
        if ($cart) {
            $cart->delete();

            return response()->json(['message' => 'Item removed successfully.']);
        }

        return response()->json(['message' => 'Cart item not found.'], 404);
    }


    public function add_payment()
    {
        $user = auth()->user();
        $orders = Order::with('menus', 'order_addons.menusAddon')->where('customer_id', $user->id)->where('status', '0')->get();
        return view('payment', compact('user', 'orders'));
    }
}
