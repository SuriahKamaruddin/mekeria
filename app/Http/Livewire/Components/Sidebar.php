<?php

namespace App\Http\Livewire\Components;

use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    protected $items;

    public function render()
    {

        if (Auth::user()->role_id == User::IS_ADMIN) {
            $this->items = Module::with('submodule')->get();
        } else {
            $this->items = Module::with(['submodule' => function ($query) {
                $query->where('is_enable_all', 1); 
            }])->where('is_enable_all', 1) 
            ->get();
        }

        return view('livewire.components.sidebar', ['items' => $this->items]);
    }
}
