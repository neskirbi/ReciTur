<?php

namespace App\Exports\Clientes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class EstadoCuentaExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    private $data;
    private $totalGeneral;
    private $negocio;
    private $mes;
    private $anio;

    public function __construct($data, $totalGeneral, $negocio, $mes, $anio)
    {
        $this->data = $data;
        $this->totalGeneral = $totalGeneral;
        $this->negocio = $negocio;
        $this->mes = $mes;
        $this->anio = $anio;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'Fecha Recolección',
            'Negocio',
            'Tipo de Residuo',
            'Contenedor',
            'Cantidad',
            'Precio Unitario',
            'Multiplicador',
            'Subtotal'
        ];
    }

    public function title(): string
    {
        return "Estado de Cuenta {$this->mes} {$this->anio}";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Agregar total general al final
                $lastRow = count($this->data) + 2;
                $event->sheet->setCellValue("G{$lastRow}", "TOTAL GENERAL:");
                $event->sheet->setCellValue("H{$lastRow}", $this->totalGeneral);
                
                // Estilo para el total
                $event->sheet->getStyle("G{$lastRow}:H{$lastRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00']
                    ]
                ]);

                // Autoajustar columnas
                foreach(range('A','H') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            }
        ];
    }
}