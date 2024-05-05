<?php

namespace App\Exports;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Style\Borders;

class DetailTransaksiExport implements FromCollection, WithHeadings, WithEvents, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaksi::with('detailTransaksi')->get();
    }

    public function headings(): array
    {
        return [
            'Id Transaksi',
            'Id Menu',
            'Harga',
            'Tanggal input',
            'Tanggal update'
        ];
    }

    public function map($row):array{
        $data = [$row->id];
        $data[1] = [];
        foreach($row->detailTransaksi as $item){
            array_push($data[1], ["Sama Menu: ".$item->menu->nama_menu,'Qty: '. $item->jumlah,'Subtotal: '. $item->subtotal]);
        };
        array_push($data, $row->total_harga);
        array_push($data, $row->created_at);
        array_push($data, $row->updated_at);
        return $data;
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

                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->setCellValue('A1', 'Data Transaksi');
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('A3:G' . $highestRow)->applyFromArray([
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
