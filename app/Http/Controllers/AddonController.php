<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenusAddon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AddonController extends Controller
{
    public function index(){
        $menusaddons = MenusAddon::all();
        return view('product.menusaddon-management', compact('menusaddons'));
    }
    public function add_menusaddon(Request $request){
        $type = $request->type;
        $id = $request->id;
        $menusaddon = MenusAddon::all();
        if($type == 0){
            $menusaddon = null;
        }else{
            $menusaddon = MenusAddon::where('id', $id)->first();
        }
        return view('product.add-menusaddon-management', compact('menusaddon', 'type', 'id'));
    }
    public function insert_menusaddon(Request $request){
        $type = $request->type;
        $id = $request->id;
        if($type== 0){
            $menusaddon = MenusAddon::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price ?? 0,
                'is_active' => $request->status,
            ]);
        }else{
            $menusaddon = MenusAddon::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price ?? 0,
                'is_active' => $request->status,
            ]);
        }
        if ($menusaddon) {
            if($type == 0){
                $message = 'New Addon have been added!';
            }else{
                $message = 'Selected Addon have been updated!';
            }
            return redirect()->route('menusaddon-index')->with('success', $message);
        } else {
            $message = 'Failed to save addon. Please try again later.';
            return redirect()->route('menusaddon-index')->with('error', $message); 
        }
    }
    public function delete_menusaddon(Request $request){
        $MenusAddon = MenusAddon::where('id', $request->id)->delete();

        if ($MenusAddon) {
            $message = 'Selected addon have been delected!';
            return redirect()->route('menusaddon-index')->with('success', $message);
        } else {
            $message = 'Failed to delete addon. Please try again later.';
            return redirect()->route('menusaddon-index')->with('error', $message);
        }
    }
}