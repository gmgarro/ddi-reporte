<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['correo' => 'admin@test.com'],
            [
                'nombre' => 'Gabriel',
                'primerApellido' => 'Montero',
                'segundoApellido' => 'Garro',
                'contrasena' => Hash::make('123456'),
                'rolId' => 1
            ]
        );
    }
}
