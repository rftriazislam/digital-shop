<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $fillable = [
        'id', 'rates', 'money',
        'updated_at'
    ];
}