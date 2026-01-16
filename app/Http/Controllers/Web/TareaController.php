<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PuntoVenta;
use App\Models\Tarea;
use App\Models\TareaOcurrencia;
use App\Services\TareaOcurrenciaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class TareaController extends Controller
{

    public function index(PuntoVenta $puntoVenta)
    {
        $puntoVenta->load([
            'tareas' => function ($q) {
                $q->where('activa', true);
            },
            'tareas.usuarios',
            'tareas.proyecto'
        ]);

        return view('tareas.index', compact('puntoVenta'));
    }

    public function create(PuntoVenta $puntoVenta)
    {
        $usuarios = User::where('rolId', 2)
            ->orderBy('nombre')
            ->orderBy('primerApellido')
            ->get();

        return view('tareas.create', [
            'usuarios' => $usuarios,
            'puntoVenta' => $puntoVenta,
        ]);
    }

    public function store(Request $request, TareaOcurrenciaService $service)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'frecuencia' => 'required|in:unica,diaria,semanal,quincenal,mensual',
            'dias_semana' => 'nullable|array',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'puntoVentaId' => 'required|exists:puntos_venta,id',
            'usuarios' => 'nullable|array'
        ]);

        DB::transaction(function () use ($data, $service) {

            $tarea = Tarea::create($data);

            // Usuarios base
            if (!empty($data['usuarios'])) {
                $tarea->usuarios()->sync($data['usuarios']);
            }

            // Generar ocurrencias (ej: 3 meses)
            $service->generar($tarea, now()->addMonths(3));
        });

        $puntoVenta = PuntoVenta::find($data['puntoVentaId']);

        return redirect()->route('puntos-venta.tareas.index', $puntoVenta)
            ->with('success', 'Tarea creada correctamente');
    }

     public function edit(PuntoVenta $puntoVenta, Tarea $tarea)
    {
        $usuarios = User::where('rolId', 2)
            ->orderBy('nombre')
            ->orderBy('primerApellido')
            ->get();

        return view('tareas.edit', [
            'usuarios' => $usuarios,
            'puntoVenta' => $puntoVenta,
            'tarea' => $tarea,
        ]);

    }

    public function update(Request $request,Tarea $tarea, TareaOcurrenciaService $service) {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'frecuencia' => 'required|in:unica,diaria,semanal,quincenal,mensual',
            'dias_semana' => 'nullable|array',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'usuarios' => 'nullable|array'
        ]);

        if ($data['frecuencia'] !== 'semanal') {
            $data['dias_semana'] = null;
        }

        DB::transaction(function () use ($tarea, $data, $service) {

            // 1. Actualizar la tarea
            $tarea->update($data);

            // 2. Usuarios base
            if (isset($data['usuarios'])) {
                $tarea->usuarios()->sync($data['usuarios']);
            }

            // 3. Eliminar SOLO ocurrencias futuras
            $service->eliminarFuturas($tarea);

            // 4. Regenerar SOLO desde hoy
            $service->regenerar($tarea, now()->addMonths(3));
        });

         return redirect()->route('puntos-venta.tareas.index', $tarea->puntoVenta)
            ->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy( PuntoVenta $puntoVenta, Tarea $tarea, TareaOcurrenciaService $service) {
    DB::transaction(function () use ($tarea, $service) {

        $tarea->update([
            'activa' => false,
        ]);

        $service->eliminarFuturas($tarea);
    });

    return redirect()
        ->route('puntos-venta.tareas.index', $puntoVenta)
        ->with('success', 'Tarea desactivada correctamente');
}

    

}
