<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PuntoVenta;
use App\Models\Reporte;
use App\Models\ReporteFirma;
use App\Models\ReporteImagen;
use App\Models\MedicionReporte;
use App\Models\AjusteParametro;
use App\Models\TipoMantenimiento;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Exports\MedicionesExport;
use Maatwebsite\Excel\Facades\Excel;
class ReporteController extends Controller
{
    public function index(PuntoVenta $puntoVenta)
    {
        $puntoVenta->load([
            'reportes' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
            'reportes.usuarios'
        ]);

        return view('reportes.index', compact('puntoVenta'));
    }

    public function create(PuntoVenta $puntoVenta)
    {
        return view('reportes.create', [
            'puntoVenta' => $puntoVenta,
            'tiposMantenimiento' => TipoMantenimiento::all(),
            'ajustesParametros' => AjusteParametro::all(),
            'usuarios' => User::where('rolId', 2)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $checksConfig  = config('reportes.checks');
        $checksRequest = $request->input('checks', []);

        $checksFinales = [];
        foreach ($checksConfig as $grupo => $checks) {
            foreach ($checks as $key => $label) {
                if (isset($checksRequest[$grupo][$key]) && $checksRequest[$grupo][$key] == 1) {
                    $checksFinales[$grupo][$key] = 1;
                } else {
                    $checksFinales[$grupo][$key] = 0;
                }
            }
        }

        $reporte = DB::transaction(function () use ($request, $checksFinales) {


            $reporte = Reporte::create([
                'contrato'            => $request->contrato,
                'fecha'               => $request->fecha,
                'tipoMantenimientoId' => $request->tipoMantenimientoId,
                'descripcion'         => $request->descripcion,
                'marca'               => $request->marca,
                'modelo'              => $request->modelo,
                'serie'               => $request->serie,
                'tipoPlanta'          => $request->tipoPlanta,
                'checks'              => $checksFinales,
                'horaInicial'         => $request->horaInicial,
                'horaFinal'           => $request->horaFinal,
                'referencia'          => $request->referencia,
                'costoTotal'          => $request->costoTotal ?? 0,
                'recomendaciones'     => $request->recomendaciones,
                'observaciones'       => $request->observaciones,
                'puntoVentaId'        => $request->puntoVentaId,
            ]);

            // Usuarios
            if ($request->has('usuarios')) {
                $reporte->usuarios()->sync($request->usuarios);
            }

            // Firmas
            if ($request->has('firmas')) {
                foreach ($request->firmas as $firma) {
                    ReporteFirma::create([
                        'reporteId'      => $reporte->id,
                        'firmaRuta'      => $firma['firmaRuta'],
                        'nombreFirmante' => $firma['nombreFirmante'],
                        'cedulaFirmante' => $firma['cedulaFirmante'],
                        'firmadoEn'      => now(),
                    ]);
                }
            }

            // Imágenes
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    $ruta = $imagen->store('reportes', 'public');

                    ReporteImagen::create([
                        'reporteId'  => $reporte->id,
                        'imagenRuta' => $ruta,
                    ]);
                }
            }


            if ($reporte->tipoMantenimiento->nombre === 'Preventivo') {
                // Mediciones
                if ($request->has('mediciones')) {
                    foreach ($request->mediciones as $medicion) {
                        MedicionReporte::create([
                            'reporteId'         => $reporte->id,
                            'ajusteParametroId' => $medicion['ajusteParametroId'],
                            'medicionInicial'   => $medicion['medicionInicial'],
                            'medicionFinal'     => $medicion['medicionFinal'],
                        ]);
                    }
                }
            }
            return $reporte;
        });

        return redirect()
            ->route('puntos-venta.reportes.index', $reporte->puntoVenta)
            ->with('success', 'Reporte creado correctamente');
    }

    public function show($id)
    {
        $reporte = Reporte::with([
            'puntoVenta',
            'tipoMantenimiento',
            'usuarios',
            'mediciones.ajusteParametro',
            'firmas',
            'imagenes'
        ])->findOrFail($id);


        return view('reportes.show', compact('reporte'));
    }

   public function pdf($id)
    {
        $reporte = Reporte::with([
            'puntoVenta',
            'tipoMantenimiento',
            'usuarios',
            'mediciones.ajusteParametro',
            'firmas',
            'imagenes'
        ])->findOrFail($id);

        $pdf = PDF::loadView('reportes.pdf', compact('reporte'));
        $pdf->setPaper('letter', 'portrait');
        
        $filename = 'Reporte_Mantenimiento_' . $reporte->id . '_' . date('YmdHis') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function excelMediciones(Request $request, $puntoId)
    {
        return Excel::download(
            new MedicionesExport(
                $request->fechaInicio,
                $request->fechaFin,
                $puntoId
            ),
            'Mediciones.xlsx'
        );
    }
}
