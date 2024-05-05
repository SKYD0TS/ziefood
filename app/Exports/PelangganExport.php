<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Style\Borders;

class PelangganExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pelanggan::all();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama',
            'Email',
            'No Telepon',
            'Alamat',
            'Tanggal input',
            'Tanggal update'
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
                $event->sheet->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);

                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:H1');
                $event->sheet->setCellValue('A1', 'Data Pelanggan');
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('A3:H' . $highestRow)->applyFromArray([
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
