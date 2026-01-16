<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PuntoVenta;
use Illuminate\Http\Request;
use App\Models\EncargadoPuntoVenta;

class EncargadoPuntoVentaController extends Controller
{
    public function index(PuntoVenta $puntoVenta)
    {
        $puntoVenta->load('encargados');

        return view('encargado_punto_venta.index', compact('puntoVenta'));
    }

    public function create(PuntoVenta $puntoVenta)
    {
        $puntoVenta->load('encargados');
        return view('encargado_punto_venta.create', compact('puntoVenta'));
    }

    public function store(Request $request, PuntoVenta $puntoVenta)
        {
            $data = $request->validate([
                'nombre' => 'required',
                'correo' => 'required|email',
                'telefono' => 'required',
                'puntoVentaId' => 'required|exists:puntos_venta,id'
            ]);

            EncargadoPuntoVenta::create($data);

            return redirect()->route('puntos-venta.encargados.index', $puntoVenta)
                ->with('success', 'Encargado creado correctamente');
        }


    public function edit(PuntoVenta $puntoVenta, EncargadoPuntoVenta $encargadoPuntoVenta)
    {
        return view('encargado_punto_venta.edit', compact('puntoVenta', 'encargadoPuntoVenta'));
    }

    public function update(Request $request, PuntoVenta $puntoVenta, EncargadoPuntoVenta $encargadoPuntoVenta)
        {
            $encargadoPuntoVenta->update($request->validate([
                'nombre' => 'required',
                'correo' => 'required|email',
                'telefono' => 'required',
                'puntoVentaId' => 'required|exists:puntos_venta,id'
            ]));

            return redirect()->route('puntos-venta.encargados.index', $puntoVenta)
                ->with('success', 'Encargado actualizado correctamente');
        }


    public function destroy(PuntoVenta $puntoVenta, EncargadoPuntoVenta $encargadoPuntoVenta)
    {
        $encargadoPuntoVenta->delete();
        return back()->with('success', 'Encargado eliminado');
    }

}
