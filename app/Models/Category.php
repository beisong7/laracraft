<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'group_id',
        'details',
        'banner',
        'active',
    ];

    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'uuid');
    }

    public function detail(){
        return $this->details;
    }

    public function group(){
        return $this->belongsTo(CategoryGroup::class, 'group_id', 'uuid');
    }

    public function status(){
        return $this->active?'Active':'In-active';
    }

}
