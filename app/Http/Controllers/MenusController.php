<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenusController extends Controller
{
    public function index(){
        return view('product.menus-management');
    }
    public function add_product(){
        $categorys = Category::all();
        return view('product.add-menus-management', compact('categorys'));
    }
    public function insert_product(Request $request){
        //dd($request);
        //dd($request);
        // $request->validate([
        //     'category_name' => 'required|unique:category,category_name',
        //     'category_description' => 'required',
        //     'is_active' => 'required',
        // ]);
        $is_active = 0;
        //dd('aa');
        if($request->chkStatus == 'ON')
        {
            $is_active = 1;
        }
        $is_salesItem = 0;
        if($request->chkSalesItem == 'ON')
        {
            $is_salesItem = 1;
        }
        $is_sold_out = 0;
        if($request->chkSoldOut == 'ON')
        {
            $is_sold_out = 1;
        }
        $menus = Menus::create([
            'category_id' => $request->category,
            'menus_name' => $request->menus_name,
            'menus_description' => $request->menus_name,
            'menus_img' => $request->menus_img,
            'price' => $request->unit_price,
            'is_active' => $is_active,
            'is_sale' => $is_salesItem,
            'is_sold_out' => $is_sold_out,
        ]);
        
        if ($menus) {
            Session::flash('success', 'File has been saved successfully');
            return view('product.menus-management');
        } else {
            Session::flash('error', 'Failed to save product. Please try again later.');
            return redirect()->back();
        }
        
    }
}
