<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\Herramienta;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    public function index(Cliente $cliente)
    {
        $cliente->load('proyectos.herramientas');
        return view('proyectos.index', compact('cliente'));
    }

    public function create(Cliente $cliente)
    {
        return view('proyectos.create', compact('cliente'));
    }

    public function store(Request $request, Cliente $cliente)
    {
        DB::transaction(function () use ($request, $cliente) {

            $data = $request->validate([
                'nombre' => 'required|string',
                'comentario' => 'required|string',
                'herramientas' => 'nullable|array',
                'herramientas.*.nombre' => 'required|string',
                'herramientas.*.cantidad' => 'required|integer|min:1',
                'herramientas.*.descripcion' => 'nullable|string',
            ]);

            $proyecto = $cliente->proyectos()->create([
                'nombre' => $data['nombre'],
                'comentario' => $data['comentario'],
            ]);

            foreach ($data['herramientas'] ?? [] as $item) {
                $proyecto->herramientas()->create($item);
            }
        });

        return redirect()
            ->route('clientes.proyectos.index', $cliente)
            ->with('success', 'Proyecto creado correctamente');
    }

    public function edit(Cliente $cliente, Proyecto $proyecto)
    {
        $proyecto->load('herramientas');
        return view('proyectos.edit', compact('cliente', 'proyecto'));
    }

    public function update(Request $request, Cliente $cliente, Proyecto $proyecto)
    {
        DB::transaction(function () use ($request, $proyecto) {

            $data = $request->validate([
                'nombre' => 'required|string',
                'comentario' => 'required|string',
                'herramientas' => 'nullable|array',
                'herramientas.*.id' => 'nullable|exists:herramientas,id',
                'herramientas.*.nombre' => 'required|string',
                'herramientas.*.cantidad' => 'required|integer|min:1',
                'herramientas.*.descripcion' => 'nullable|string',
            ]);

            $proyecto->update([
                'nombre' => $data['nombre'],
                'comentario' => $data['comentario'],
            ]);

            $ids = [];

            foreach ($data['herramientas'] ?? [] as $item) {

                if (isset($item['id'])) {
                    $herramienta = $proyecto->herramientas()
                        ->where('id', $item['id'])
                        ->first();

                    if ($herramienta) {
                        $herramienta->update([
                            'nombre' => $item['nombre'],
                            'cantidad' => $item['cantidad'],
                            'descripcion' => $item['descripcion'] ?? null,
                        ]);
                        $ids[] = $herramienta->id;
                    }

                } else {
                    $nueva = $proyecto->herramientas()->create([
                        'nombre' => $item['nombre'],
                        'cantidad' => $item['cantidad'],
                        'descripcion' => $item['descripcion'] ?? null,
                    ]);
                    $ids[] = $nueva->id;
                }
            }

            // eliminar las que ya no vienen
            $proyecto->herramientas()
                ->whereNotIn('id', $ids)
                ->delete();
        });

        return redirect()
            ->route('clientes.proyectos.index', $cliente)
            ->with('success', 'Proyecto actualizado correctamente');
    }

    public function destroy(Cliente $cliente, Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()
            ->route('clientes.proyectos.index', $cliente)
            ->with('success', 'Proyecto eliminado');
    }

    public function destroyHerramienta(Herramienta $herramienta)
    {
        $herramienta->delete();
        return response()->json(['ok' => true]);
    }
}
