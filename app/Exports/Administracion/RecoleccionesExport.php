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
            'CANTIDAD'
        ];
    }
    
    /**
     * Mapea los datos para cada fila
     */
    public function map($recoleccion): array
    {
        return [
            $recoleccion->GENERADOR,
            $recoleccion->ESTABLECIMIENTO,
            $recoleccion->CLASIFICACION,
            \Carbon\Carbon::parse($recoleccion->FECHA_DE_RECOLECCION)->format('d/m/Y H:i'),
            $recoleccion->CANTIDAD
        ];
    }
    
    /**
     * Aplica estilos a la hoja de cálculo
     */
    public function styles(Worksheet $sheet)
    {
        // Estilo para los encabezados
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '176D4A'] // Verde de tu tema
            ]
        ]);
        
        // Autoajustar el ancho de las columnas
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(15);
        
        // Alineación de celdas
        $sheet->getStyle('A:E')->getAlignment()->setVertical('center');
        $sheet->getStyle('E')->getAlignment()->setHorizontal('right');
        
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