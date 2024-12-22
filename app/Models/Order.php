<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql';
    protected $table = 'order';
    protected $fillable =
    [
        'customer_id',
        'menus_id',
        'quantity',
        'price',
        'subtotal',
        'discount',
        'total',
        'status'
    ];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function menus()
    {
        return $this->belongsTo(Menus::class,'menus_id');
    }
    public function order_addons(){
        return $this->hasMany(OrderAddOn::class, 'order_id');
    }
}