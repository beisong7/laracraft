<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
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

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getimageAttribute(){
        if(file_exists($this->passport)){
            return url($this->passport);
        }else{
            return url('img/user.png');
        }
    }

    public function getordersAttribute(){
        return Booking::where('email', $this->email)->orWhere('customer_id', $this->uuid)->get();
    }

    public function getreviewsAttribute(){
        return Review::where('email', $this->email)->orWhere('customer_id', $this->uuid)->get();
    }

    public function getwishlistAttribute(){
        return WishList::where('email', $this->email)->orWhere('customer_id', $this->uuid)->get();
    }
}
