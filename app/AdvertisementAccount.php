<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementAccount extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id',
        'country', 'account_name', 'opening_year', 'balance',
        'account_currency', 'is_verified', 'price',
        'description', 'status', 'updated_at'
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
}