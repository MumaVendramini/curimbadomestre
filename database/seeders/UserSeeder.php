<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Criar ou atualizar usuário admin (senha de demonstração: @1234abcd)
        User::updateOrCreate(
            ['email' => 'admin@curimbadomestre.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('@1234abcd'),
                'firebase_uid' => 'admin_uid',
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // Criar ou atualizar usuário aluno de exemplo (senha de demonstração: @1234abcd)
        User::updateOrCreate(
            ['email' => 'aluno@exemplo.com'],
            [
                'name' => 'Aluno Exemplo',
                'password' => bcrypt('@1234abcd'),
                'firebase_uid' => 'aluno_uid',
                'role' => 'student',
                'is_active' => true,
            ]
        );
    }
}
