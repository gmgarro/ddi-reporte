<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Paise;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('paise')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $cliente = new Cliente();
        $paises = Paise::all();
        return view('clientes.create', compact('cliente', 'paises'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'paisId' => 'required|exists:paises,id'
        ]);

        Cliente::create($data);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado correctamente');
    }

    public function edit(Cliente $cliente)
    {
        $paises = Paise::all();
        return view('clientes.edit', compact('cliente', 'paises'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $cliente->update(
            $request->validate([
                'nombre' => 'required',
                'paisId' => 'required|exists:paises,id'
            ])
        );

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return back()->with('success', 'Cliente eliminado');
    }
}
