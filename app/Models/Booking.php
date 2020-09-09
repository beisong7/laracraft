<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'seen',
        'handled',
        'replied',
        'email',
        'customer_id',
        'phone',
        'name',
        'canceled',
        'uuid',
    ];

    public function details(){
        return $this->name . " has made an Order.";
    }

    public function cartItems(){
        return $this->hasMany(Cart::class, 'book_uuid', 'uuid');
    }
}
