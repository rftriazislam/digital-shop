<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable

{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'country', 'country_code', 'state', 'refered_id', 'address', 'balance', 'verifycode', 'currency',
        'flag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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



    public function sell_info()
    {
        return $this->hasMany('App\SellOrder', 'seller_id', 'id')->where('status', 2);
    }
    public function buy_info()
    {

        return $this->hasMany('App\SellOrder', 'buyer_id', 'id')->where('status', 2);
    }
}