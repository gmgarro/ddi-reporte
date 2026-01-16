<?php
namespace App\Http\Controllers\Web;

use App\Models\Tarea;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TareaOcurrencia;
use App\Models\PuntoVenta;

class CalendarioController extends Controller
{
    public function calendario()
    {
        return view('tareas.calendario');
    }

    public function calendarioByPuntoServicio(PuntoVenta $puntoVenta)
    {
        return view('tareas.calendarioPunto', [
            'puntoVenta' => $puntoVenta,
        ]);
    }
    public function calendarioData()
    {
        $ocurrencias = TareaOcurrencia::with([
            'tarea.puntoVenta.cliente',
            'tarea.proyecto',
            'usuarios' // Usuarios desde tarea_ocurrencia_usuarios
        ])->get();

        return response()->json(
            $ocurrencias->map(function ($o) {
                return [
                    'id' => $o->id,
                    'title' => $o->tarea->nombre,
                    'start' => $o->fecha,
                    'color' => match ($o->estado) {
                        'pendiente' => '#f59e0b',
                        'en_progreso' => '#3b82f6',
                        'completada' => '#10b981',
                        default => '#6b7280',
                    },
                    'extendedProps' => [
                        'tarea_id' => $o->tareaId,
                        'ocurrencia_id' => $o->id,
                        'estado' => $o->estado,
                        'descripcion' => $o->tarea->descripcion ?? '',
                        'punto_venta' => $o->tarea->puntoVenta ? $o->tarea->puntoVenta->nombre : null,
                        'cliente' => $o->tarea->puntoVenta && $o->tarea->puntoVenta->cliente 
                            ? $o->tarea->puntoVenta->cliente->nombre 
                            : null,
                        'proyecto' => $o->tarea->proyecto ? $o->tarea->proyecto->nombre : null,
                        'usuarios' => $o->usuarios->map(fn ($u) => [
                            'id' => $u->id,
                            'nombre' => $u->nombre,
                            'primerApellido' => $u->primerApellido,
                        ])->toArray(),

                    ],
                ];
            })
        );
    }

     public function calendarioDataByPuntoServicio(PuntoVenta $puntoVenta)
    {
            $ocurrencias = TareaOcurrencia::with([
        'tarea.puntoVenta.cliente',
        'tarea.proyecto',
        'usuarios'
    ])
    ->whereHas('tarea', function ($q) use ($puntoVenta) {
        $q->where('puntoVentaId', $puntoVenta->id);
    })
    ->get();


        return response()->json(
            $ocurrencias->map(function ($o) {
                return [
                    'id' => $o->id,
                    'title' => $o->tarea->nombre,
                    'start' => $o->fecha,
                    'color' => match ($o->estado) {
                        'pendiente' => '#f59e0b',
                        'en_progreso' => '#3b82f6',
                        'completada' => '#10b981',
                        default => '#6b7280',
                    },
                    'extendedProps' => [
                        'tarea_id' => $o->tareaId,
                        'ocurrencia_id' => $o->id,
                        'estado' => $o->estado,
                        'descripcion' => $o->tarea->descripcion ?? '',
                        'punto_venta' => $o->tarea->puntoVenta ? $o->tarea->puntoVenta->nombre : null,
                        'cliente' => $o->tarea->puntoVenta && $o->tarea->puntoVenta->cliente 
                            ? $o->tarea->puntoVenta->cliente->nombre 
                            : null,
                        'proyecto' => $o->tarea->proyecto ? $o->tarea->proyecto->nombre : null,
                        'usuarios' => $o->usuarios->map(fn ($u) => [
                            'id' => $u->id,
                            'nombre' => $u->nombre,
                            'primerApellido' => $u->primerApellido,
                        ])->toArray(),

                    ],
                ];
            })
        );
    }
}