<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'uuid',
        'txref',
        'payment_id',
        'cart_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'value',
        'amount',
        'status',
        'completed',
        'gateway_message',
        'start',
        'ends',
        'details',
    ];

    public function book(){
        return $this->hasOne(Booking::class, 'transaction_id', 'uuid');
    }
}
