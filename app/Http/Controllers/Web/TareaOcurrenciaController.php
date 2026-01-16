<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TareaOcurrencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaOcurrenciaController extends Controller
{
    public function edit(TareaOcurrencia $ocurrencia)
    {
        // CARGA CORRECTA PARA EDITAR
        $ocurrencia->load('usuarios', 'tarea');

        return view('ocurrencias.edit', [
            'ocurrencia' => $ocurrencia,
            'usuarios' => User::where('rolId', 2)
                ->orderBy('nombre')
                ->orderBy('primerApellido')
                ->get(),

        ]);
    }

    public function update(Request $request, TareaOcurrencia $ocurrencia)
    {
        $data = $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|in:pendiente,en_progreso,pausada,completada,cancelada',
            'usuarios' => 'nullable|array',
            'usuarios.*' => 'exists:users,id',
        ]);

        DB::transaction(function () use ($ocurrencia, $data) {

            // Actualizar datos base
            $ocurrencia->update([
                'fecha' => $data['fecha'],
                'estado' => $data['estado'],
            ]);

            // Usuarios SOLO para esta ocurrencia
            if (array_key_exists('usuarios', $data)) {
                $ocurrencia->usuarios()->sync($data['usuarios']);
            }
        });

        return redirect()
            ->route('tareas.calendario')
            ->with('success', 'Ocurrencia actualizada correctamente');
    }
}
