<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenusAddonMaps extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'menus_addon_map';
    protected $fillable =
    [
        'menus_id',
        'menus_addon_id',
        'is_active',
    ];
    
    public function menus()
    {
        return $this->hasMany(Menus::class);
    }
    public function addons()
    {
        return $this->hasMany(MenusAddon::class);
    }
    
}
