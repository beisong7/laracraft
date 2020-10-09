<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'client_key',
        'uuid',
        'reference',
        'transaction_id',
        'email',
        'order_id',
        'kobo',
        'details',
        'success',
        'amount',
        'status',
        'gateway_message',
        'start',
        'ends',
    ];

    public function transaction(){
        return $this->hasOne(Transaction::class, 'uuid', 'transaction_id');
    }
}
