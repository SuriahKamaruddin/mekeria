<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('product.category-management',compact('categories'));
    }
    public function add_category(Request $request){
        $type = $request->type;
        $id = $request->id;
        if ($type == 0) {
            $category = null;
        } else {
            $category = Category::where('id', $id)->first();
        }
        return view('product.add-category-management', compact('category', 'type', 'id'));
    }
    public function insert_category(Request $request){
        $type = $request->type;
        $id = $request->id;

        if($type == 0){
            $category = Category::create([
                'category_name' => $request->category_name,
                'category_description' => $request->category_detail,
                //'category_img' => $fileNameToStore,
                'is_active' => $request->status,
            ]);
            if($request->hasFile('category_img')){
                $attachment = $request->file('category_img');
                $att_name = $attachment->getClientOriginalName();
                $filename = pathinfo($att_name, PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . rand() . '.' . $extension;
                $path = $attachment->move(storage_path('app/public/mekeria/category'), $fileNameToStore);

                $category= Category::where('id', $category->$id)->update([
                    'category_img' => $fileNameToStore,
                ]);
            }
        }else{
            $category = Category::where('id', $id)->update([
                'category_name' => $request->category_name,
                'category_description' => $request->category_detail,
                'is_active' => $request->status,
            ]);
            if($request->hasFile('category_img')){
                $category = Category::where('id', $id)->first();
                $file_path = storage_path('app/public/makeria/category/'.$request->category_img);
                if(File::exists($file_path)){
                    File::delete(($file_path));
                }
                $attachment = $request->file('category_img');
                $att_name = $attachment->getClientOriginalName();
                $filename = pathinfo($att_name, PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . rand() . '.' . $extension;
                $path = $attachment->move(storage_path('app/public/mekeria/category/'), $fileNameToStore);
                $category = Category::where('id', $id)->update([
                    'category_img' => $fileNameToStore,
                ]);
            }
        }
        
        if ($category) {
            if($type == 0){
                $message = 'New category have been added!';
            }else{
                $message = 'Selected category have been updated!';
            }
            return redirect()->route('category-index')->with('success', $message);
        } else {
            $message = 'Failed to save menu. Please try again later.';
            return redirect()->route('category-index')->with('error', $message); 
        }
        
    }

    public function delete_category(Request $request){
        $category = Category::where('id', $request->id)->first();
        $attach = $category->category_img;
        $file_path = storage_path('app/public/mekeria/category/' . $attach);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $category = Category::where('id', $request->id)->delete();

        if ($category) {
            $message = 'Selected category have been delected!';
            return redirect()->route('category-index')->with('success', $message);
        } else {
            $message = 'Failed to delete category. Please try again later.';
            return redirect()->route('category-index')->with('error', $message);
        }
    }
}