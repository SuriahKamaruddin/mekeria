<?php

namespace App\Http\Livewire\Components;

use App\Models\AppLocale;
use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Locale extends Component
{

    //$locale = App::currentLocale();
    // protected $bahasa;
    public $bahasa;
    // public $isActive = 1;

    public $lang;

    // public function mount(Request $request){

    //     if ($request->session()->has('locale')) {
    //         //session('locale')
    //         //dd(session('locale'));
    //         App::setLocale(session('locale'));
    //     }
        
    // }

    public function setLanguage($locale)
    {
        // $this->bahasa = AppLocale::where('language', $locale)->select('language')->first();

        AppLocale::where('language', $locale)->update(['is_active' => 1]);
        AppLocale::where('language', '!=', $locale)->update(['is_active' => 0]);

        $this->bahasa = $locale;

        App::setLocale($this->bahasa);

        // dd($this->bahasa);

        // App::setLocale($this->bahasa);
        // session()->put('locale', $locale);
        
        // dd($locale);
    }

    // public function updated($locale)
    // {
    //     AppLocale::where('language', $locale)->update(['is_active' => 1]);
    //     AppLocale::where('language', '!=', $locale)->update(['is_active' => 0]);

    //     $this->bahasa = $locale;

    //     App::setLocale($this->bahasa);

    //     dd($this->bahasa);

    //     return view('livewire.components.locale', ['bahasa' => $this->bahasa]);
    // }

    public function render()
    {
        
        // $this->bahasa = App::currentLocale();

        // $activeLocale = AppLocale::where('is_active', 1)->first();

        // $this->bahasa = AppLocale::where('is_active', 1)->first();

        // // dd($activeLocale);

        // if ($this->bahasa){
        //     App::setLocale($this->bahasa->language);
        //     return view('livewire.components.locale', ['bahasa' => $this->bahasa]);
        // }
        
        // return view('livewire.components.locale', ['bahasa'=> $this->bahasa]);
        return view('livewire.components.locale', ['bahasa' => 'en']);
    }
}
