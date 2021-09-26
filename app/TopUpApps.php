<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopUpApps extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id',
        'product_name', 'top_up', 'total_top_up', 'unit_price',
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
    public function top_sellorder_info()
    {
        return $this->hasMany('App\SellOrder', 'product_id', 'id')->where('form_name', 'top_up_apps');
    }
}