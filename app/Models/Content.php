<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'name',
        'info',
        'active',
    ];

    public function blogs(){
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}
