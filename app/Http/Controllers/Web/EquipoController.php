<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\TipoEquipo;
use App\Models\User;
use App\Models\PuntoVenta;

class EquipoController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'equipos' => Equipo::with(['tipo', 'users', 'puntoVenta'])->get(),
                'tipos' => TipoEquipo::all(),
                'usuarios' => User::select('id', 'name', 'email')->get(),
                'puntosVenta' => PuntoVenta::all(),
            ]
        ]);
    }


    public function store(Request $request)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'estado' => 'required|string',
        'tipoEquipoId' => 'required|exists:tipos_equipos,id',
        'usuarioId' => 'required|exists:users,id',
        'puntoVentaId' => 'nullable|exists:puntos_venta,id',
    ]);

    $data['fechaCambio'] = now();

    $equipo = Equipo::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Equipo creado correctamente',
        'data' => $equipo
    ], 201);
}


    public function update(Request $request, Equipo $equipo)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
            'tipoEquipoId' => 'required|exists:tipos_equipos,id',
            'usuarioId' => 'required|exists:users,id',
            'puntoVentaId' => 'nullable|exists:puntos_venta,id',
        ]);

        if ($data['estado'] !== $equipo->estado) {
        $data['fechaCambio'] = now();
        }

        $equipo->update($data);

        return back()->with('success', 'Equipo actualizado');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return back()->with('success', 'Equipo eliminado');
    }
}
