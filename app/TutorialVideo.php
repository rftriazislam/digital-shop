<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorialVideo extends Model
{
    protected $fillable = [
        'youtube_embed_link', 'youtube_title', 'youtube_link', 'youtube_id', 'status', 'updated_at'
    ];
}