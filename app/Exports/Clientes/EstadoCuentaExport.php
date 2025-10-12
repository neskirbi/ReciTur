<?php

namespace App\Exports\Clientes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EstadoCuentaExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    private $data;
    private $totalGeneral;
    private $negocio;
    private $mes;
    private $anio;
    private $generador;

    public function __construct($data, $totalGeneral, $negocio, $mes, $anio, $generador = null)
    {
        $this->data = $data;
        $this->totalGeneral = $totalGeneral;
        $this->negocio = $negocio;
        $this->mes = $mes;
        $this->anio = $anio;
        $this->generador = $generador;
    }

    public function collection()
    {
        // Retornamos una colección vacía porque manejaremos los datos manualmente
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Residuos', 
            'Contenedor',
            'Cantidad',
            'Precio',
            'Subtotal'
        ];
    }

    public function title(): string
    {
        return "Estado de Cuenta";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                
                // Título principal centrado
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', 'ESTADO DE CUENTA MENSUAL');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
                ]);

                // Mes y año en la parte superior derecha
                $sheet->setCellValue('F2', 'MES: ' . strtoupper($this->mes));
                $sheet->getStyle('F2')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT]
                ]);

                // Generador y negocio en la parte superior izquierda
                $sheet->setCellValue('A3', 'GENERADOR: ' . ($this->generador ?: 'HILTON'));
                $sheet->setCellValue('A4', 'ESTABLECIMIENTO: ' . $this->negocio);
                $sheet->getStyle('A3:A4')->applyFromArray([
                    'font' => ['bold' => true]
                ]);

                // Título de la tabla de recolecciones
                $sheet->setCellValue('A6', 'RECOLECCIONES');
                $sheet->getStyle('A6')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12]
                ]);

                // Encabezados de la tabla (comienzan en la fila 7)
                $headings = $this->headings();
                $sheet->setCellValue('A7', $headings[0]);
                $sheet->setCellValue('B7', $headings[1]);
                $sheet->setCellValue('C7', $headings[2]);
                $sheet->setCellValue('D7', $headings[3]);
                $sheet->setCellValue('E7', $headings[4]);
                $sheet->setCellValue('F7', $headings[5]);
                
                // Insertar los datos de recolecciones manualmente (fila 8 en adelante)
                $row = 8;
                foreach ($this->data as $item) {
                    // Convertir a array si es objeto
                    $itemArray = is_object($item) ? (array) $item : $item;
                    
                    // Usar los nombres de campos exactos que vienen del controlador
                    $sheet->setCellValue('A' . $row, $itemArray['fecha'] ?? '');
                    $sheet->setCellValue('B' . $row, $itemArray['residuos'] ?? '');
                    $sheet->setCellValue('C' . $row, $itemArray['contenedor'] ?? '');
                    $sheet->setCellValue('D' . $row, $itemArray['cantidad_con_unidades'] ?? '');
                    $sheet->setCellValue('E' . $row, $itemArray['precio'] ?? '');
                    $sheet->setCellValue('F' . $row, $itemArray['subtotal'] ?? '');
                    $row++;
                }

                // Formato de moneda para precio y subtotal
                if (count($this->data) > 0) {
                    $lastDataRow = 7 + count($this->data);
                    $sheet->getStyle('E8:F' . $lastDataRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
                }

                // Estilo para los encabezados de la tabla
                $sheet->getStyle('A7:F7')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'E6E6E6']
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ]
                ]);

                // Estilo para los datos de la tabla (para todas las filas de datos)
                if (count($this->data) > 0) {
                    $lastDataRow = 7 + count($this->data);
                    $sheet->getStyle('A8:F' . $lastDataRow)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                            ]
                        ]
                    ]);
                }

                // Agregar total general al final
                $lastRow = 8 + count($this->data) + 2;
                $sheet->setCellValue("E{$lastRow}", "TOTAL GENERAL:");
                $sheet->setCellValue("F{$lastRow}", $this->totalGeneral);
                
                // Estilo para el total
                $sheet->getStyle("E{$lastRow}:F{$lastRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00']
                    ]
                ]);

                // Formato de moneda para el total
                $sheet->getStyle("F{$lastRow}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

                // Autoajustar columnas
                foreach(range('A','F') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Ajustar altura de filas
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(6)->setRowHeight(20);
                $sheet->getRowDimension(7)->setRowHeight(20);
            }
        ];
    }
}