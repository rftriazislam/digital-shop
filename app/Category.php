<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $fillable = [
        'name', 'form_name', 'status', 'updated_at'
    ];

    public function subcategory()
    {
        return $this->hasMany('App\Subcategory', 'category_id', 'id')->where('status', 1);
    }
    public function subcategory_info()
    {
        return $this->hasMany('App\Subcategory', 'category_id', 'id');
    }
}