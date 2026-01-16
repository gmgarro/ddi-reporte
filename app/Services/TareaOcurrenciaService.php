<?php

namespace App\Services;

use App\Models\Tarea;
use App\Models\TareaOcurrencia;
use Carbon\Carbon;

class TareaOcurrenciaService
{
    /**
     * Genera ocurrencias desde fecha_inicio hasta el límite real
     */
    public function generar(Tarea $tarea, Carbon $hasta)
    {

        $inicio = Carbon::parse($tarea->fecha_inicio);

        $limite = $tarea->fecha_fin
            ? Carbon::parse($tarea->fecha_fin)->min($hasta)
            : $hasta;

        $fecha = $inicio->copy();

        $usuariosIds = $tarea->usuarios()->pluck('users.id')->toArray();

        while ($fecha->lte($limite)) {

            if ($this->debeGenerarse($tarea, $fecha, $inicio)) {

                $ocurrencia = $tarea->ocurrencias()->firstOrCreate([
                    'fecha' => $fecha->toDateString(),
                ], [
                    'estado' => 'pendiente',
                ]);

                if ($ocurrencia->wasRecentlyCreated) {
                    $ocurrencia->usuarios()->sync($usuariosIds);
                }
            }

            $fecha->addDay();
        }
    }

    public function regenerar(Tarea $tarea, Carbon $hasta)
    {

        $inicio = Carbon::parse($tarea->fecha_inicio);
        $hoy = now()->startOfDay();

        $fecha = $hoy->copy();

        $limite = $tarea->fecha_fin
            ? Carbon::parse($tarea->fecha_fin)->min($hasta)
            : $hasta;

        $usuariosIds = $tarea->usuarios()->pluck('users.id')->toArray();

        while ($fecha->lte($limite)) {

            if ($this->debeGenerarse($tarea, $fecha, $inicio)) {

                $ocurrencia = $tarea->ocurrencias()->firstOrCreate(
                    ['fecha' => $fecha->toDateString()],
                    ['estado' => 'pendiente']
                );

                if ($ocurrencia->wasRecentlyCreated) {
                    $ocurrencia->usuarios()->sync($usuariosIds);
                }
            }

            $fecha->addDay();
        }
    }



    /**
     * Determina si una tarea ocurre en una fecha
     */
    private function debeGenerarse(Tarea $tarea, Carbon $fecha, Carbon $inicio): bool
    {
        if ($fecha->lt($inicio)) {
            return false;
        }


        return match ($tarea->frecuencia) {

            'unica' =>
            $fecha->isSameDay($inicio),

            'diaria' =>
            true,

            'semanal' =>
            in_array($fecha->dayOfWeekIso, $tarea->dias_semana ?? []),

            'quincenal' =>
            $inicio->diffInDays($fecha) % 14 === 0,
            'mensual' =>
            $fecha->day === $inicio->day,

            default => false,
        };
    }

    /**
     * Elimina ocurrencias futuras (para regenerar)
     */
    public function eliminarFuturas(Tarea $tarea): void
    {
        TareaOcurrencia::where('tareaId', $tarea->id)
            ->where('fecha', '>=', now()->toDateString())
            ->delete();
    }
}
