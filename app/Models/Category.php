<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mysql';
    protected $table = 'category';
    protected $fillable =
    [
        'category_name',
        'category_description',
        'category_img',
        'is_active',
        'is_enable'
    ];
    use HasFactory;
}