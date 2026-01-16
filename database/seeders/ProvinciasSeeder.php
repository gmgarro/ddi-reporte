<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paise;
use App\Models\Provincia;

class ProvinciasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Costa Rica' => ['San José', 'Alajuela', 'Cartago', 'Heredia', 'Guanacaste', 'Puntarenas', 'Limón'],
            'Nicaragua' => ['Managua', 'León', 'Masaya', 'Granada', 'Chinandega', 'Matagalpa', 'Jinotega', 'Estelí', 'Boaco', 'Carazo', 'Rivas', 'Chontales', 'Nueva Segovia', 'Madriz', 'RAAN', 'RAAS'],
            'Honduras' => ['Francisco Morazán', 'Cortés', 'Atlántida', 'Colón', 'Comayagua', 'Copán', 'Choluteca', 'El Paraíso', 'Gracias a Dios', 'Intibucá', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho', 'Santa Bárbara', 'Valle', 'Yoro'],
            'El Salvador' => ['Ahuachapán', 'Santa Ana', 'Sonsonate', 'Chalatenango', 'La Libertad', 'San Salvador', 'Cuscatlán', 'Cabañas', 'San Vicente', 'La Paz', 'Usulután', 'San Miguel', 'Morazán', 'La Unión'],
            'Guatemala' => ['Guatemala', 'Alta Verapaz', 'Baja Verapaz', 'Chimaltenango', 'Chiquimula', 'El Progreso', 'Escuintla', 'Huehuetenango', 'Izabal', 'Jalapa', 'Jutiapa', 'Petén', 'Quetzaltenango', 'Quiché', 'Retalhuleu', 'Sacatepéquez', 'San Marcos', 'Santa Rosa', 'Sololá', 'Suchitepéquez', 'Totonicapán', 'Zacapa'],
            'Panamá' => ['Bocas del Toro', 'Chiriquí', 'Coclé', 'Colón', 'Darién', 'Herrera', 'Los Santos', 'Panamá', 'Veraguas', 'Panamá Oeste']
        ];

        foreach ($data as $paisNombre => $provincias) {
            $pais = Paise::where('nombre', $paisNombre)->first();
            foreach ($provincias as $provincia) {
                Provincia::create([
                    'nombre' => $provincia,
                    'paisId' => $pais->id
                ]);
            }
        }
    }
}
