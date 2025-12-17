<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'description',
        'toque_type',
        'toque_origin',
        'toque_characteristics',
        'toque_application',
        'order',
        'is_active',
        'apostila_url',
        'audio_url',
        'image_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function pontos()
    {
        return $this->hasMany(Ponto::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_modules', 'module_id', 'user_id');
    }

    public function audios()
    {
        return $this->hasMany(ModuleAudio::class);
    }

    public function moduleVideos()
    {
        return $this->hasMany(ModuleVideo::class);
    }

    public function images()
    {
        return $this->hasMany(ModuleImage::class);
    }
}

