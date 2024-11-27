<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(){
        return view('product.category-management');
    }
    public function add_category(){
        return view('product.add-category-management');
    }
    public function insert_category(Request $request){
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
        $category = Category::create([
            'category_name' => $request->category_name,
            'category_description' => $request->category_detail,
            'category_img' => $request->category_img,
            'is_active' => $is_active,
        ]);
        
        if ($category) {
            Session::flash('success', 'File has been saved successfully');
            return view('product.category-management');
        } else {
            Session::flash('error', 'Failed to save product. Please try again later.');
            return redirect()->back();
        }
        
    }
}