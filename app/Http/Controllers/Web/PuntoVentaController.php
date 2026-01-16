<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PuntoVenta;
use App\Models\Cliente;
use App\Models\Provincia;

class PuntoVentaController extends Controller
{
    public function index(Cliente $cliente)
    {
        $cliente->load('puntosVenta.provincia');
        return view('puntos_venta.index', compact('cliente'));
    }

    public function create(Cliente $cliente)
    {
        $provincias = Provincia::where('paisId', $cliente->paisId)->get();

        $paises = [
            1 => 'CR', // Costa Rica
            2 => 'NI', // Nicaragua
            3 => 'HN', // Honduras
            4 => 'SV', // El Salvador
            5 => 'GT', // Guatemala
            6 => 'PA', // Panamá
        ];

        $paisCodigo = $paises[$cliente->paisId] ?? ''; 
        return view('puntos_venta.create', compact('cliente', 'provincias', 'paisCodigo'));
    }

    public function store(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'provinciaId' => 'required|exists:provincias,id',
        ]);

        $cliente->puntosVenta()->create($data);

        return redirect()->route('clientes.puntos-venta.index', $cliente)
            ->with('success', 'Punto de venta creado correctamente');
    }

    public function edit(Cliente $cliente, PuntoVenta $puntoVenta)
    {
        $provincias = Provincia::where('paisId', $cliente->paisId)->get();

        $paises = [
            1 => 'CR', // Costa Rica
            2 => 'NI', // Nicaragua
            3 => 'HN', // Honduras
            4 => 'SV', // El Salvador
            5 => 'GT', // Guatemala
            6 => 'PA', // Panamá
        ];

        $paisCodigo = $paises[$cliente->paisId] ?? ''; 

        return view('puntos_venta.edit', compact('cliente', 'puntoVenta', 'provincias', 'paisCodigo'));
    }

    public function update(Request $request, Cliente $cliente, PuntoVenta $puntoVenta)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'provinciaId' => 'required|exists:provincias,id',
        ]);

        $puntoVenta->update($data);

        return redirect()->route('clientes.puntos-venta.index', $cliente)
            ->with('success', 'Punto de venta actualizado correctamente');
    }

    public function destroy(Cliente $cliente, PuntoVenta $puntoVenta)
    {
        $puntoVenta->delete();
        return redirect()->route('clientes.puntos-venta.index', $cliente)
            ->with('success', 'Punto de venta eliminado');
    }
}
