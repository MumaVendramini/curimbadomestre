<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Criar usuário admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@curimbadomestre.com',
            'password' => bcrypt('password'),
            'firebase_uid' => 'admin_uid',
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Criar usuário aluno de exemplo
        User::create([
            'name' => 'Aluno Exemplo',
            'email' => 'aluno@exemplo.com',
            'password' => bcrypt('password'),
            'firebase_uid' => 'aluno_uid',
            'role' => 'student',
            'is_active' => true,
        ]);
    }
}
