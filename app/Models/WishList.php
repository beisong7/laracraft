<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $fillable = [
        'active',
        'uuid',
        'product_key',
        'email',
        'customer_id',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'uuid', 'product_key');
    }


}
