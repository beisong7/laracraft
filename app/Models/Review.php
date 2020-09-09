<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'active',
        'uuid',
        'product_key',
        'email',
        'customer_id',
        'name',
        'info',
        'time',
        'flags',
    ];

    public function getproductNameAttribute(){
        $product = Product::where('uuid', $this->product_key)->first();
        return !empty($product)?$product->name:'Item Not Found';
    }

    public function getproductPicAttribute(){
        $product = Product::where('uuid', $this->product_key)->first();
        return !empty($product)?$product->onePic:'Item Not Found';
    }
}
