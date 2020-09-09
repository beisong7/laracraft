<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeSet extends Model
{
    protected $fillable = [
        'uuid',
        'size_id',
        'product_id',
        'qty',
        'current',
    ];

    public function info(){
        return $this->hasOne(Size::class, 'uuid', 'size_id');
    }
}
