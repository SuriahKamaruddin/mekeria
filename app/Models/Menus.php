<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'menus';
    protected $fillable =
    [
        'category_id',
        'menus_name',
        'menus_description',
        'menus_img',
        'stock',
        'price',
        'is_active',
        'is_enable',
        'is_sale',
        'is_sold_out',
        
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); 
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}