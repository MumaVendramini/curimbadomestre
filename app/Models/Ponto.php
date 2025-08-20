<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    protected $fillable = [
        'title',
        'lyrics_preview',
        'audio_url',
        'toque_image_url',
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
}

