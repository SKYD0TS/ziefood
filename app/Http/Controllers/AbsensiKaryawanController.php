<?php

namespace App\Http\Controllers;

use App\Exports\absensiKaryawan as ExportsAbsensiKaryawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
use App\Exports\AbsensiKaryawanExport;
use App\Http\Requests\StoreAbsensiKaryawanRequest;
use App\Imports\absensiKaryawan as ImportsAbsensiKaryawan;
use App\Imports\AbsensiKaryawanImport;
use App\Models\AbsensiKaryawan;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $absensiKaryawan = AbsensiKaryawan::orderBy('created_at', 'DESC')->get();
    return view('absensiKaryawan.index')->with('absensiKaryawan', $absensiKaryawan);
}


    public function store(StoreAbsensiKaryawanRequest $request)
    {
        try {
            DB::beginTransaction();
            AbsensiKaryawan::create($request->all());
            DB::commit();
            return redirect('absensi')->with('success', 'absensi berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return [$error->getMessage(), $error->getCode()];
        }
    }

    public function update(StoreAbsensiKaryawanRequest $request, AbsensiKaryawan $absensi)
    {
        try {
            DB::beginTransaction();
            $absensi->update($request->all());
            DB::commit();
            return redirect('absensi')->with('success', 'absensi berhasil diupdate!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return $error->getMessage();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function destroy(AbsensiKaryawan $absensi)
    {
        try {
            DB::beginTransaction();
            $absensi->delete();
            DB::commit();
            return redirect('absensi')->with('success', 'absensi berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return "Terjadi kesalahan :(" . $error->getMessage();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new AbsensiKaryawanExport, $date . '_absensi.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new AbsensiKaryawanImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import data berhasil');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }}

    public function exportPDF()
    {
        // Ambil data yang akan diekspor (contoh: dari database)
        $data = AbsensiKaryawan::all();

        // Render data ke dalam tampilan HTML
        $html = view('absensiKaryawan.pdf', compact('data'))->render();
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

    public function updateStatus(Request $request, string $id){
        $absensi = AbsensiKaryawan::find($id);
        $absensi->status = $request->status;
        $absensi->save();
        return response(['success'=>'berhasil']);
    }
    
}
