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
    // Remover antigo módulo de exemplo, se existir
    Module::where('name', 'Módulo 1: Introdução ao Curimba')->delete();

    // Garantir que os 5 módulos do curso existam (idempotente)
        $modules = [
            [
                'name' => 'Ijexá',
                'description' => 'Toque Ijexá: fundamentos e prática.',
                'toque_type' => 'ijexa',
                'order' => 1,
                'apostila_url' => null,
            ],
            [
                'name' => 'Nagô',
                'description' => 'Toque Nagô: história e técnicas.',
                'toque_type' => 'nago',
                'order' => 2,
                'apostila_url' => null,
            ],
            [
                'name' => 'Samba',
                'description' => 'Samba de roda / Samba Angola: ritmos e variações.',
                'toque_type' => 'samba_angola',
                'order' => 3,
                'apostila_url' => null,
            ],
            [
                'name' => 'Congo',
                'description' => 'Toque Congo: estruturas e toques característicos.',
                'toque_type' => 'congo',
                'order' => 4,
                'apostila_url' => null,
            ],
            [
                'name' => 'Barravento',
                'description' => 'Barravento: estudo dos toques tradicionais.',
                'toque_type' => 'barravento',
                'order' => 5,
                'apostila_url' => null,
            ],
        ];

        foreach ($modules as $m) {
            Module::updateOrCreate(
                ['name' => $m['name']],
                [
                    'description' => $m['description'],
                    'toque_type' => $m['toque_type'],
                    'order' => $m['order'],
                    'is_active' => true,
                    'apostila_url' => $m['apostila_url'],
                ]
            );
        }
    }
}

