<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MenusController extends Controller
{
    public function index(){
        return view('product.menus-management');
    }
    public function add_product(){
        return view('product.add-menus-management');
    }
}
