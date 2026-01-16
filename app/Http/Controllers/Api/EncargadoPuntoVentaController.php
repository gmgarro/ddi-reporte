<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EncargadoPuntoVenta;

class EncargadoPuntoVentaController extends Controller
{
      // Listar todos los clientes con su país
    public function index()
    {
        return EncargadoPuntoVenta::with('puntoVenta')->get();
    }

    // Crear un cliente
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'puntoVentaId' => 'required|exists:puntos_venta,id',
        ]);

        $encargado = EncargadoPuntoVenta::create($data);

        return response()->json($encargado, 201);
    }

    // Mostrar un encargado
    public function show(EncargadoPuntoVenta $encargado)
    {
        return $encargado->load('puntoVenta');
    }

    // Actualizar encargado
    public function update(Request $request, EncargadoPuntoVenta $encargado)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'correo' => 'sometimes|required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'puntoVentaId' => 'sometimes|required|exists:puntos_venta,id',
        ]);

        $encargado->update($data);

        return response()->json($encargado);
    }

    // Eliminar encargado
    public function destroy(EncargadoPuntoVenta $encargado)
    {
        $encargado->delete();

        return response()->json(['message' => 'Encargado eliminado']);
    }
}
