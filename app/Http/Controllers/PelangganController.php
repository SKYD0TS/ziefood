<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
use App\Exports\PelangganExport;
use App\Imports\PelangganImport;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // try {
        $data['pelanggan'] = Pelanggan::orderBy('created_at', 'DESC')->get();
        return view('pelanggan.index')->with($data);
        // } catch (QueryException | Exception | PDOException $error) {
        //     $this->failResponse($error->getCode());
        // }
    }

    public function store(StorePelangganRequest $request)
    {
        try {
            DB::beginTransaction();
            Pelanggan::create($request->all());
            DB::commit();
            return redirect('pelanggan')->with('success', 'Pelanggan berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function update(StorepelangganRequest $request, pelanggan $pelanggan)
    {
        try {
            DB::beginTransaction();
            $pelanggan->update($request->all());
            DB::commit();
            return redirect('pelanggan')->with('success', 'pelanggan berhasil diupdate!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function destroy(Pelanggan $pelanggan)
    {
        try {
            DB::beginTransaction();
            $pelanggan->delete();
            DB::commit();
            return redirect('pelanggan')->with('success', 'pelanggan berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return "Terjadi kesalahan :(" . $error->getMessage();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new PelangganExport, $date . '_pelanggan.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new PelangganImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import data berhasil');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }}

    public function exportPDF()
    {
        // Ambil data yang akan diekspor (contoh: dari database)
        $data = Pelanggan::all();

        // Render data ke dalam tampilan HTML
        $html = view('pelanggan.pdf', compact('data'))->render();
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
