<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        return view('product.category-management');
    }
    public function add_category(){
        return view('product.add-category-management');
    }
}