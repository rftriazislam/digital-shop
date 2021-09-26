<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawMoney extends Model
{
    protected $fillable = [
        'status', 'image1', 'image2', 'image3'
    ];


    public function user_info()
    {
        return $this->hasOne('App\User', 'id', 'post_id');
    }
}