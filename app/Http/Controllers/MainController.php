<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menus;

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
}
