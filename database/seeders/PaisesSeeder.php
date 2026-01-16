<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paise;

class PaisesSeeder extends Seeder
{
    public function run(): void
    {
        $paises = [
            'Costa Rica',
            'Nicaragua',
            'Honduras',
            'El Salvador',
            'Guatemala',
            'Panamá'
        ];

        foreach ($paises as $nombre) {
            Paise::create(['nombre' => $nombre]);
        }
    }
}
