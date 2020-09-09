<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'slug', //
        'title', //
        'desc', //
        'detail',
        'category_id',// this referenced content id
        'tags',//
        'type',//
        'keywords',
        'banner', //
        'user_id', //
        'status', //
        'hits'

    ];

    public function status(){
        return $this->status?'Published':'Unpublished';
    }

    public function banner(){
        return url( is_file($this->banner)?$this->banner:'img/blog_default.png');
    }

    public function contents(){
        return $this->belongsTo(Content::class);
    }
}
