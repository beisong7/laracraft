<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'uuid',
        'email',
        'password',
        'username',
        'phone',
        'address',
        'dob',
        'active',
        'photo',
        'reset_token',
        'reset_timer',
    ];
}
