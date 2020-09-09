<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorSet extends Model
{
    protected $fillable = [
        'uuid',
        'color_id',
        'product_id',
        'qty',
        'current',
    ];

    public function info(){
        return $this->hasOne(Color::class, 'uuid', 'size_id');
    }
}
