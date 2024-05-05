<?php

namespace App\Exports;

use App\Models\Menu;
use App\Models\Stok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class StokExport implements FromCollection, WithHeadings, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stok::all();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Stok',
            'Menu Id',
        ];
    }

    public function map($row):array{
        return [
            $row->id,
            $row->jumlah,
            $row->menu->id,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getColumnDimension('E')->setAutoSize(true);

                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:E1');
                $event->sheet->setCellValue('A1', 'Data Stok');
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('A3:E' . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'bordersStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['agrb' => '000000']
                        ]
                    ]
                ]);
            }
        ];
    }
}
