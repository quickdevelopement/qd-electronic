<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
        'payment_status',
    ];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addresses(){
        return $this->hasOne(ShippingAddress::class);
    }
}
