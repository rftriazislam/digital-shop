<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfluenceMarketing extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id', 'social_name',
        'social_link', 'hiring_time', 'last_engagement',
        'social_type', 'country',
        'price', 'description', 'status', 'updated_at'
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