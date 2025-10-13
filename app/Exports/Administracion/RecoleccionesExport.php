<?php

namespace App\Exports\Administracion;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RecoleccionesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $recolecciones;
    
    public function __construct($recolecciones)
    {
        $this->recolecciones = $recolecciones;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->recolecciones;
    }
    
    /**
     * Define los encabezados de las columnas
     */
    public function headings(): array
    {
        return [
            'GENERADOR',
            'ESTABLECIMIENTO', 
            'CLASIFICACIÓN',
            'FECHA DE RECOLECCIÓN',
            'RESIDUO',
            'DETALLE DE CANTIDAD',
            'SUBTOTAL'
        ];
    }
    
    /**
     * Mapea los datos para cada fila
     */
    public function map($recoleccion): array
    {
        // Formatear el subtotal como moneda
        $subtotalFormateado = '$' . number_format($recoleccion->SUBTOTAL, 2);
        
        return [
            $recoleccion->GENERADOR,
            $recoleccion->ESTABLECIMIENTO,
            $recoleccion->CLASIFICACION,
            \Carbon\Carbon::parse($recoleccion->FECHA_DE_RECOLECCION)->format('d/m/Y H:i'),
            $recoleccion->RECIDUO ?? 'N/A',
            $recoleccion->CANTIDAD ?? 'N/A',
            $subtotalFormateado
        ];
    }
    
    /**
     * Aplica estilos a la hoja de cálculo
     */
    public function styles(Worksheet $sheet)
    {
        // Obtener el número total de filas (datos + encabezado)
        $totalRows = count($this->recolecciones) + 1;
        
        // Estilo para los encabezados
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '176D4A'] // Verde de tu tema
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
        ]);
        
        // Autoajustar el ancho de las columnas
        $sheet->getColumnDimension('A')->setWidth(25); // GENERADOR
        $sheet->getColumnDimension('B')->setWidth(25); // ESTABLECIMIENTO
        $sheet->getColumnDimension('C')->setWidth(20); // CLASIFICACIÓN
        $sheet->getColumnDimension('D')->setWidth(20); // FECHA
        $sheet->getColumnDimension('E')->setWidth(20); // RESIDUO
        $sheet->getColumnDimension('F')->setWidth(25); // DETALLE DE CANTIDAD
        $sheet->getColumnDimension('G')->setWidth(15); // SUBTOTAL
        
        // Estilo para los datos
        if ($totalRows > 1) {
            $sheet->getStyle('A2:G' . $totalRows)->applyFromArray([
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'DDDDDD']
                    ]
                ]
            ]);
            
            // Alineación específica por columnas
            $sheet->getStyle('D2:D' . $totalRows)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('F2:F' . $totalRows)->getAlignment()->setHorizontal('right');
            $sheet->getStyle('G2:G' . $totalRows)->getAlignment()->setHorizontal('right');
            
            // Formato de moneda para SUBTOTAL
            $sheet->getStyle('G2:G' . $totalRows)
                  ->getNumberFormat()
                  ->setFormatCode('"$"#,##0.00');
        }
        
        // Congelar paneles (fijar encabezados)
        $sheet->freezePane('A2');
        
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
    
    /**
     * Define el título de la hoja
     */
    public function title(): string
    {
        return 'Reporte de Recolecciones';
    }
}