<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $fillable = [
        'url',
        'uuid',
        'model_id',
        'time',
        'name',
        'valid',
    ];

    public function photo(){
        return url($this->url);
    }
}
