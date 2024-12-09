<?php

namespace App\Http\Controllers;

use App\Models\Category;

class MainController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function main_menus()
    {
        $category = Category::with('menus')->get();
        return view('main_menus',compact('category'));
    }
}
