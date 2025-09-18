<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'youtube_id',
        'order',
        'module_id',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function getEmbedUrlAttribute()
    {
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }
}

