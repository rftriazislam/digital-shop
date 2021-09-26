<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function category_info()
    {
        return $this->hasOne('App\Category', 'id', 'category_id')->where('status', 1);
    }
    public function social_media_info()
    {
        return $this->hasMany('App\SocialMedia', 'subcategory_id', 'id')->where('status', 1);
    }
    public function  make_payment_info()
    {
        return $this->hasMany('App\MakePayment', 'subcategory_id', 'id')->where('status', 1);
    }
}