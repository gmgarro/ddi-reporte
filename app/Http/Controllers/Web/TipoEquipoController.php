<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoEquipo;

class TipoEquipoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tipo_equipos,nombre'
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

    public function destroy(TipoEquipo $tipoEquipo)
    {
        if ($tipoEquipo->equipos()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar, tiene equipos asociados'
            ], 422);
        }

        $tipoEquipo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tipo de equipo eliminado correctamente'
        ]);
    }
}

