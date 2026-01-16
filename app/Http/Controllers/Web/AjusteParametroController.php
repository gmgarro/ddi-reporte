<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AjusteParametro;
use Illuminate\Http\Request;

class AjusteParametroController extends Controller
{
    public function index()
    {
        $ajusteParametros = AjusteParametro::all();
        return view('ajuste_parametros.index', compact('ajusteParametros'));
    }

    public function create()
    {
        return view('ajuste_parametros.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'primerValor' => 'required|numeric',
            'segundoValor' => 'numeric|nullable',
        ]);

        AjusteParametro::create($data);

        return redirect()->route('ajuste_parametros.index')
            ->with('success', 'Ajuste Parámetro creado correctamente');
    }

    public function edit(AjusteParametro $ajusteParametro)
    {
        return view('ajuste_parametros.edit', compact('ajusteParametro'));
    }

    public function update(Request $request, AjusteParametro $ajusteParametro)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'primerValor' => 'required|numeric',
            'segundoValor' => 'numeric|nullable',
        ]);

        $ajusteParametro->update($data);

        return redirect()->route('ajuste_parametros.index')
            ->with('success', 'Ajuste Parámetro actualizado correctamente');
    }

    public function destroy(AjusteParametro $ajusteParametro)
    {
        $ajusteParametro->delete();

        return redirect()->route('ajuste_parametros.index')
            ->with('success', 'Ajuste Parámetro eliminado correctamente');
    }

}
