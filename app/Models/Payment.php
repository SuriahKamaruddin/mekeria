<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'mysql';
    protected $table = 'payment';
    protected $fillable =
    [
        'customer_id',
        'method',
        'address1',
        'address2',
        'address3',
    ];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function paymentorder(){
        return $this->hasMany(PaymentOrderMap::class, 'payment_id');
    }
}
