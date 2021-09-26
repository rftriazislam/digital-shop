<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MakePayment extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id',
        'send_currency', 'send_wallet',
        'send_account', 'get_currency', 'get_wallet',
        'get_account', 'get_amount', 'unit_price',
        'description', 'send_amount', 'status', 'updated_at'
    ];
    public function user_info()
    {
        return $this->hasOne('App\User', 'id', 'post_id');
    }
    public function category_info()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
    public function subcategory_info()
    {
        return $this->hasOne('App\Subcategory', 'id', 'subcategory_id');
    }
    public function seller_info()
    {
        return $this->hasOne('App\User', 'id', 'post_id');
    }
    public function mk_sellorder_info()
    {
        return $this->hasMany('App\SellOrder', 'product_id', 'id')->where('form_name', 'make_payment');
    }
}