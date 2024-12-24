<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrderMap extends Model
{
    protected $connection = 'mysql';
    protected $table = 'payment_order_map';
    protected $fillable =
    [
        'payment_id',
        'order_id',
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(order::class,'order_id');
    }

    public function order_addon()
    {
        return $this->belongsTo(MenusAddon::class, 'addon_id'); // Replace `Addon` with the actual model for your addons
    }
}
