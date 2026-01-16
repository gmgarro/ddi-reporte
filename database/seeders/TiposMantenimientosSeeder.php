<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoMantenimiento;
class TiposMantenimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            'Preventivo',
            'Correctivo',
            'Reemplazo',
            'Mejora infraestructura'
        ];

        foreach ($tipos as $nombre) {
            TipoMantenimiento::create(['nombre' => $nombre]);
        }
    }
}
