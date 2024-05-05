<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Http\Requests\StoreDetailTransaksiRequest;
use App\Http\Requests\UpdateDetailTransaksiRequest;
use App\Models\Jenis;
use App\Models\Transaksi;
use App\Exports\DetailTransaksiExport;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transaksi'] = Transaksi::with(['detailTransaksi'])->get();
        return view('det_transaksi.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetailTransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailTransaksi  $detailTransaksi
     * @return \Illuminate\Http\Response
     */
    public function show(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailTransaksi  $detailTransaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailTransaksiRequest  $request
     * @param  \App\Models\DetailTransaksi  $detailTransaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailTransaksiRequest $request, DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailTransaksi  $detailTransaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailTransaksi $detailTransaksi)
    {
        //
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new DetailTransaksiExport, $date . '_transaksi.xlsx');
    }

    public function exportPDF()
    {
        // Ambil data yang akan diekspor (contoh: dari database)
        $data = Transaksi::with('detailTransaksi', 'detailTransaksi.menu')->get();

        foreach ($data as $p) {
            foreach($p->detailTransaksi as $d){
                $imagePath = public_path('storage/menu-image/' . $d->menu->image);
                $imageData = base64_encode(file_get_contents($imagePath));
                $d->menu->imageData = $imageData;
            }
        }

        // Render data ke dalam tampilan HTML
        $html = view('det_transaksi.pdf', compact('data'))->render();
        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'potrait');

        // Render HTML menjadi PDF
        $dompdf->render();

        // Simpan atau kirimkan PDF ke browser
        return $dompdf->stream('laporan.pdf');
    }
}
