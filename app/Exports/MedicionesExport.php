<?php

namespace App\Exports;

use App\Models\Reporte;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MedicionesExport implements FromArray, WithColumnWidths, WithStyles
{
    protected $inicio;
    protected $fin;
    protected $puntoId;

    public function __construct($inicio, $fin, $puntoId)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
        $this->puntoId = $puntoId;
    }

    public function array(): array
    {
        $reportes = Reporte::with(['mediciones.ajusteParametro', 'puntoVenta'])
            ->where('puntoVentaId', $this->puntoId)
            ->whereBetween('fecha', [$this->inicio, $this->fin])
            ->orderBy('fecha')
            ->get();

        if ($reportes->isEmpty()) {
            return [['No hay datos en este rango']];
        }

        $punto = $reportes->first()->puntoVenta->nombre;

        $parametros = [];

        foreach ($reportes as $reporte) {
            $fecha = $reporte->fecha->format('d/m/Y');

            foreach ($reporte->mediciones as $medicion) {

                $nombre = $medicion->ajusteParametro->nombre ?? 'Sin nombre';

                $parametros[$nombre]['fechas'][$fecha] =
                    $medicion->medicionFinal;
            }
        }

        $fechas = $reportes->pluck('fecha')
            ->map(fn($f) => $f->format('d/m/Y'))
            ->unique()
            ->values();

        $excel = [];

        // ===== ENCABEZADO GENERAL =====
        $excel[] = ["Punto de Servicio:", $punto];
        $excel[] = ["Rango:", "$this->inicio a $this->fin"];
        $excel[] = [];

        // ===== CABECERA DE TABLA =====
        $header = array_merge(
            ["Nombre del Parámetro"],
            $fechas->toArray(),
            ["Promedio", "Más Alto", "Más Bajo"]
        );

        $excel[] = $header;

        // ===== FILAS DE DATOS =====
        foreach ($parametros as $nombre => $data) {

            $fila = [$nombre];
            $valores = [];

            foreach ($fechas as $fecha) {
                $valor = $data['fechas'][$fecha] ?? '';
                $fila[] = $valor;

                if (is_numeric($valor)) {
                    $valores[] = $valor;
                }
            }

            $prom = count($valores)
                ? round(array_sum($valores) / count($valores), 2)
                : '';

            $max = count($valores) ? max($valores) : '';
            $min = count($valores) ? min($valores) : '';

            $fila[] = $prom;
            $fila[] = $max;
            $fila[] = $min;

            $excel[] = $fila;
        }

        return $excel;
    }

    // ===== ANCHO DE COLUMNAS =====
    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 15,
        ];
    }

    // ===== ESTILOS =====
    public function styles(Worksheet $sheet)
{
    $totalFilas = $sheet->getHighestRow();
    $totalColumnas = $sheet->getHighestColumn();

    // Título y rango
    $sheet->getStyle('A1:A2')->getFont()->setBold(true);

    // ===== ENCABEZADO EN FILA 3 =====
    $sheet->getStyle("A3:{$totalColumnas}3")->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '2F75B5'],
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ]);

    // ===== PARÁMETROS DESDE FILA 4 EN ADELANTE =====
    $sheet->getStyle("A4:A{$totalFilas}")
        ->getAlignment()
        ->setHorizontal(Alignment::HORIZONTAL_LEFT);

    // Valores centrados
    $sheet->getStyle("B4:{$totalColumnas}{$totalFilas}")
        ->getAlignment()
        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Bordes generales
    $sheet->getStyle("A3:{$totalColumnas}{$totalFilas}")
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);

    return [];
}

}
