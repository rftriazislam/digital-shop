<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellOrder extends Model
{

    protected $fillable = [
        'document_image', 'status', 'updated_at'
    ];


    public function user_info()
    {
        return $this->hasOne('App\User', 'id', 'buyer_id');
    }
    public function seller_user_info()
    {
        return $this->hasOne('App\User', 'id', 'seller_id');
    }

    public function  buyer_info()
    {
        return $this->hasOne('App\User', 'id', 'buyer_id');
    }
    public function category_info()
    {
        return $this->hasOne('App\Category', 'form_name', 'form_name');
    }


    public function social_media_info()
    {
        return $this->hasOne('App\SocialMedia', 'id', 'product_id');
    }
    public function make_payment_info()
    {
        return $this->hasOne('App\MakePayment', 'id', 'product_id');
    }
    public function influence_marketing_info()
    {
        return $this->hasOne('App\InluenceMarketing', 'id', 'product_id');
    }
    public function commission_info()
    {
        return $this->hasMany('App\Commission', 'order_id', 'id');
    }


    public function transanction_affiliate()
    {
        return $this->hasOne('App\TransanctionHistory', 'tx_id', 'tx_id');
    }
}