<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PuntoVenta;
use Illuminate\Http\Request;

class PuntoVentaController extends Controller
{
    public function index()
    {
        return PuntoVenta::with(['cliente', 'provincia'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'        => 'required|string|max:255',
            'latitud'       => 'required|numeric|between:-90,90',
            'longitud'      => 'required|numeric|between:-180,180',
            'direccion'     => 'nullable|string',
            'clienteId'    => 'required|exists:clientes,id',
            'provinciaId'  => 'required|exists:provincias,id',
        ]);

        $puntoVenta = PuntoVenta::create($data);

        return response()->json($puntoVenta, 201);
    }

    public function show(PuntoVenta $puntoVenta)
    {
        return $puntoVenta->load(['cliente', 'provincia']);
    }


    public function update(Request $request, PuntoVenta $puntoVenta)
    {
        $data = $request->validate([
            'nombre'        => 'sometimes|required|string|max:255',
            'latitud'       => 'sometimes|required|numeric|between:-90,90',
            'longitud'      => 'sometimes|required|numeric|between:-180,180',
            'direccion'     => 'sometimes|nullable|string',
            'clienteId'    => 'sometimes|required|exists:clientes,id',
            'provinciaId'  => 'sometimes|required|exists:provincias,id',
        ]);

        $puntoVenta->update($data);

        return response()->json($puntoVenta);
    }

    public function destroy(PuntoVenta $puntoVenta)
    {
        $puntoVenta->delete();
        return response()->json(['message' => 'Punto de venta eliminado']);
    }
}
