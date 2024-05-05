<?php

namespace App\Http\Controllers;

use App\Models\Titipan;
use App\Models\Jenis;
use App\Http\Requests\StoreTitipanRequest;
use App\Http\Requests\UpdateTitipanRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Exception;
use PDOException;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TitipanExport;
use App\Imports\TitipanImport;
use App\Models\Kategori;
use Dompdf\Dompdf;

class TitipanController extends Controller
{
    public function index()
    {
        try {
            $data['titipan'] = DB::table('titipans')
                ->join('kategoris', 'titipans.kategori_id', '=', 'kategoris.id')
                ->select('Titipans.*', 'kategoris.nama_kategori', 'kategoris.id as idKategori')->orderBy('created_at', 'DESC')->get();
            $kategori = Kategori::get();
            return view('titipan.index', [
                'page' => 'Titipan',
                'section' => 'Kelola data',
            ], compact('kategori'))->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            return $error->getMessage();
            // $this->failResponse($error->getCode());
        }
    }

    public function store(StoreTitipanRequest $request)
    {
        $data['kategori_id'] = $request->kategori_id;
        $data['nama_produk'] = $request->nama_produk;
        $data['nama_supplier'] = $request->nama_supplier;
        $data['harga_beli'] = $request->harga_beli;
        $data['harga_jual'] = $request->harga_jual;
        $data['stok'] = $request->stok;

        Titipan::create($data);
        return redirect('titipan')->with('succes', 'Data Titipan berhasil ditambahkan');
    }



    public function update(UpdateTitipanRequest $request, Titipan $titipan)
    {

        $data['kategori_id'] = $request->kategori_id;
        $data['nama_produk'] = $request->nama_produk;
        $data['nama_supplier'] = $request->nama_supplier;
        $data['harga_beli'] = $request->harga_beli;
        $data['harga_jual'] = $request->harga_jual;
        $data['stok'] = $request->stok;
        $titipan->update($data);
        return redirect('titipan')->with('succes', 'Data Titipan berhasil di edit.');
    }

    public function destroy(titipan $titipan)
    {
        try {
            DB::beginTransaction();
            $titipan->delete();
            DB::commit();
            return redirect('titipan')->with('success', 'Data Titipan berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return "Terjadi kesalahan: " . $error->getMessage();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new TitipanExport, $date . '_Titipan.xlsx');
    }

    public function importData()
    {
        Excel::import(new TitipanImport, request()->file('import'));
        return redirect('titipan')->with('success', 'Import data Titipan berhasil');
    }
    public function exportPDF()
    {
        // Ambil data yang akan diekspor (contoh: dari database)
        $data = Titipan::all();

        // Render data ke dalam tampilan HTML
        $html = view('titipan.pdf', compact('data'))->render();
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
