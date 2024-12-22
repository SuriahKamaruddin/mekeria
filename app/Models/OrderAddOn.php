<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddOn extends Model
{
    protected $connection = 'mysql';
    protected $table = 'order_addon';
    protected $fillable =
    [
        'order_id',
        'addon_id',
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    public function menusAddon()
    {
        return $this->belongsTo(MenusAddon::class,'addon_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function order_addon()
    {
        return $this->belongsTo(MenusAddon::class, 'addon_id'); // Replace `Addon` with the actual model for your addons
    }
}
