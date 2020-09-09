<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'book_uuid',
        'product_id',
        'qty',
        'price',
        'total_price',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'uuid', 'product_id');
    }
}
