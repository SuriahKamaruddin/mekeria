<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenusAddon extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'menus_addon';
    protected $fillable =
    [
        'menus_id',
        'name',
        'description',
        'price',
        'is_active',
    ];
    public function menus() {
        return $this->belongsToMany(Menus::class, 'menus_addon_map', 'menus_id', 'menus_addon_id');
    }
}
