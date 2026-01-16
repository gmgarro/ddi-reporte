<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoEquipo;
use Illuminate\Http\Request;

class TipoEquipoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string'
        ]);

        $tipo = TipoEquipo::create([
            'nombre' => $request->nombre
        ]);
            
        return response()->json([
            'success' => true,
            'message' => 'Tipo de equipo creado correctamente',
            'data' => $tipo
        ], 201);
    }

    /**
     * Eliminar tipo de equipo
     */
    public function destroy(TipoEquipo $tipoEquipo)
    {
        if ($tipoEquipo->equipos()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar, tiene equipos asociados'
            ], 422);
        }

        $tipoEquipo->delete();

        return response()->json([
            'message' => 'Tipo de equipo eliminado correctamente'
        ]);
    }
}
