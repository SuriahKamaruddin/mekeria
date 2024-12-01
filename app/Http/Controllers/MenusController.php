<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
//use File;

class MenusController extends Controller
{
    public function index()
    {
        $menus = Menus::with('category')->get();
        return view('product.menus-management', compact('menus'));
    }
    public function add_product(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $categorys = Category::all();
        if ($type == 0) {
            $menus = null;
        } else {
            $menus = Menus::where('id', $id)->first();
        }
        return view('product.add-menus-management', compact('categorys', 'menus', 'type', 'id'));
    }
    public function insert_product(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        if ($type == 0) {
            
            $menus = Menus::create([
                'category_id' => $request->category,
                'menus_name' => $request->menus_name,
                'menus_description' => $request->menus_name,
                // 'menus_img' => $fileNameToStore,
                'price' => $request->unit_price,
                'is_active' => $request->status,
                'is_sale' =>  $request->sale,
                'is_sold_out' =>  $request->sold_out,
            ]);
            if ($request->hasFile('menus_img')) {
                $attachment = $request->file('menus_img');
                $att_name = $attachment->getClientOriginalName();
                $filename = pathinfo($att_name, PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . rand() . '.' . $extension;
                $path = $attachment->move(storage_path('app/public/mekeria/menus'), $fileNameToStore);

                $menus = Menus::where('id', $menus->id)->update([
                    'menus_img' => $fileNameToStore,
                ]);
            }
        } else {
            $menus = Menus::where('id', $id)->update([
                'category_id' => $request->category,
                'menus_name' => $request->menus_name,
                'menus_description' => $request->menus_name,
                'price' => $request->unit_price,
                'is_active' => $request->status,
                'is_sale' =>  $request->sale,
                'is_sold_out' =>  $request->sold_out,
            ]);

            if ($request->hasFile('menus_img')) {

                $menus = Menus::where('id', $id)->first();
                $file_path = storage_path('app/public/mekeria/menus/' . $menus->menus_img);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }

                $attachment = $request->file('menus_img');
                $att_name = $attachment->getClientOriginalName();
                $filename = pathinfo($att_name, PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . rand() . '.' . $extension;
                $path = $attachment->move(storage_path('app/public/mekeria/menus/'), $fileNameToStore);
                $menus = Menus::where('id', $id)->update([
                    'menus_img' => $fileNameToStore,
                ]);
            }
        }

        if ($menus) {
            if ($type == 0) {
                $message = 'New menu have been added!';
            } else {
                $message = 'Selected menu have been updated!';
            }
            return redirect()->route('menus-index')->with('success', $message);
        } else {
            $message = 'Failed to save menu. Please try again later.';
            return redirect()->route('menus-index')->with('error', $message);
        }
    }

    public function delete_product(Request $request)
    {
        $menus = Menus::where('id', $request->id)->first();
        $attach = $menus->menus_img;
        $file_path = storage_path('app/public/mekeria/menus/' . $attach);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $menus = Menus::where('id', $request->id)->delete();

        if ($menus) {
            $message = 'Selected menu have been delected!';
            return redirect()->route('menus-index')->with('success', $message);
        } else {
            $message = 'Failed to delete menu. Please try again later.';
            return redirect()->route('menus-index')->with('error', $message);
        }
    }

    public function update_on_sales_product(Request $request){
        $id = $request->id;
        $is_on_sales = $request->is_on_sales;
        $menus = Menus::where('id', $id)->update([
            'is_sale' =>  $request->is_on_sales == "1" ? 0 : 1,
        ]);
        if ($menus) {
            $message = 'Selected menu have been updated!';
            return redirect()->route('menus-index')->with('success', $message);
        } else {
            $message = 'Failed to save menu. Please try again later.';
            return redirect()->route('menus-index')->with('error', $message);
        }

    }
    public function update_sales_out_product(Request $request){
        $id = $request->id;
        $is_sold_out = $request->is_sold_out;
        
        $menus = Menus::where('id', $id)->update([
            'is_sold_out' =>  $request->is_sold_out == "1" ? 0 : 1,
        ]);
        if ($menus) {
            $message = 'Selected menu have been updated!';
            return redirect()->route('menus-index')->with('success', $message);
        } else {
            $message = 'Failed to save menu. Please try again later.';
            return redirect()->route('menus-index')->with('error', $message);
        }
    }
}
