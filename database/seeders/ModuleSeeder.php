<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Ponto;
use App\Models\Video;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        // Criar módulo de exemplo
        $module = Module::create([
            'name' => 'Módulo 1: Introdução ao Curimba',
            'description' => 'Primeiros passos no aprendizado do Curimba, conceitos básicos e fundamentos.',
            'order' => 1,
            'is_active' => true,
            'apostila_url' => 'https://storage.googleapis.com/curimba-apostilas/modulo1.pdf',
        ]);

        // Criar pontos de exemplo
        Ponto::create([
            'title' => 'Ponto de Abertura',
            'lyrics_preview' => 'Salve a força, salve a luz...',
            'audio_url' => 'https://storage.googleapis.com/curimba-audios/ponto-abertura.mp3',
            'toque_image_url' => 'https://storage.googleapis.com/curimba-imagens/toque-abertura.jpg',
            'order' => 1,
            'module_id' => $module->id,
        ]);

        // Criar vídeos de exemplo
        Video::create([
            'title' => 'Introdução ao Curimba',
            'description' => 'Vídeo explicativo sobre os fundamentos do Curimba',
            'youtube_id' => 'dQw4w9WgXcQ',
            'order' => 1,
            'module_id' => $module->id,
        ]);
    }
}

