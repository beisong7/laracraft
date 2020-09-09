<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    //
    protected $fillable=[
        'uuid',
        'name',
        'phone',
        'active',
    ];

    public function prdt(){
        return $this->hasMany(Product::class);
    }

    public function products(){
        return $this->hasMany(Product::class, 'maker_id', 'uuid');
    }





}
