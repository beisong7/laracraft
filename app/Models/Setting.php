<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable=[
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'google',
        'youtube',
        'address1',
        'address2',
        'mail1',
        'mail2',
        'boss_email',
        'copyright',
        'powered',
        'logo1',
        'logo2',
        'phone',
    ];
}
