<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tarea;
use App\Models\TareaOcurrencia;

class TareaController extends Controller
{
    public function hoy(Request $request)
    {
    $user = $request->user();
    $hoy = Carbon::today();

    $tareas = TareaOcurrencia::with('tarea')
        ->whereDate('fecha', $hoy)
        ->whereHas('usuarios', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        })
        ->get()
        ->map(function ($oc) {
            return [
                'id' => $oc->id,
                'tareaId' => $oc->tarea->id,
                'nombre' => $oc->tarea->nombre,
                'descripcion' => $oc->tarea->descripcion,
                'fecha' => $oc->fecha,
                'estado' => $oc->estado,
            ];
        });

    return response()->json($tareas);
}

}
