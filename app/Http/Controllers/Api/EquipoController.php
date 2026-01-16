<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Listar equipos
     */
    public function index()
    {
        $equipos = Equipo::with(['tipo', 'users', 'puntoVenta'])->get();

        return response()->json($equipos);
    }

    /**
     * Crear equipo
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
            'tipoEquipoId' => 'required|exists:tipos_equipos,id',
            'usuarioId' => 'required|exists:users,id',
            'puntoVentaId' => 'nullable|exists:puntos_venta,id',
        ]);

        $data['fechaCambio'] = now();

        $equipo = Equipo::create($data);

        return response()->json([
            'message' => 'Equipo creado correctamente',
            'equipo' => $equipo->load(['tipo', 'users', 'puntoVenta'])
        ], 201);
    }

    /**
     * Actualizar equipo
     */
   public function update(Request $request, Equipo $equipo)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'estado' => 'required|string',
        'tipoEquipoId' => 'required|exists:tipos_equipos,id',
        'puntoVentaId' => 'nullable|exists:puntos_venta,id',
    ]);

    // Usuario autenticado (API segura)
    $data['usuarioId'] = $request->user()->id;

    // Solo cambia fechaCambio si cambia el estado
    if ($data['estado'] !== $equipo->estado) {
        $data['fechaCambio'] = now();
    }

    $equipo->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Equipo actualizado correctamente',
        'data' => $equipo->fresh([
            'tipo',
            'users',
            'puntoVenta'
        ])
    ], 200);
}

    /**
     * Eliminar equipo
     */
    public function destroy(Equipo $equipo)
{
    $equipo->delete();

    return response()->json([
        'success' => true,
        'message' => 'Equipo eliminado correctamente'
    ], 200);
}

}
