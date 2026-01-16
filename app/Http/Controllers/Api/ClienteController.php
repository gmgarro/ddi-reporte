<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Listar todos los clientes con su país
    public function index()
    {
        return Cliente::with('paise')->get();
    }

    // Crear un cliente
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'paisId' => 'required|exists:paises,id',
        ]);

        $cliente = Cliente::create($data);

        return response()->json($cliente, 201);
    }

    // Mostrar un cliente
    public function show(Cliente $cliente)
    {
        return $cliente->load('paise');
    }

    // Actualizar cliente
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'paisId' => 'sometimes|required|exists:paises,id',
        ]);

        $cliente->update($data);

        return response()->json($cliente);
    }

    // Eliminar cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado']);
    }
}
