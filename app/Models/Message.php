<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'email',
        'subject',
        'names',
        'info',
        'seen',
        'replied',
        'phone',
    ];
}
