<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    //

    protected $fillable = [
        'uuid',
        'name',
        'type',
        'details',
        'active',
        'maker_id',
    ];

    public function categories(){
        return $this->hasMany(Category::class, 'group_id', 'uuid');
    }

    public function getSingleChildAttribute() {
        return Category::where('group_id', $this->uuid)->first();
    }

    public function maker(){
        return $this->hasOne(Maker::class, 'uuid', 'maker_id');
    }
}
