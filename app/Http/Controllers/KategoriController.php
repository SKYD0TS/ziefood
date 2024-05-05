<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;
use App\Models\Jenis;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['kategori'] = DB::table('kategoris')
                ->join('jenis', 'kategoris.jenis_id', '=', 'jenis.id')
                ->select('kategoris.*', 'jenis.nama_jenis', 'jenis.id as idJenis')->orderBy('created_at', 'DESC')->get();;
            $jenis = Jenis::get();
            return view('Kategori.index', [
                'page' => 'kategori',
                'section' => 'Kelola data',
            ], compact('jenis'))->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            return $error->getMessage();
            // $this->failResponse($error->getCode());
        } // Meneruskan variabel $kategori ke view
    }


    public function store(StoreKategoriRequest $request)
    {
        $data['kategori_id'] = $request->kategori_id;
        try {
            DB::beginTransaction();
            Kategori::create($request->all());
            DB::commit();
            return redirect('kategori')->with('success', 'Kategori berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return $error->getMessage();
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function update(StoreKategoriRequest $request, Kategori $kategori)
    {
        try {
            DB::beginTransaction();
            $kategori->update($request->all());
            DB::commit();
            return redirect('kategori')->with('success', 'Kategori berhasil diupdate!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function destroy(Kategori $kategori)
    {
        try {
            DB::beginTransaction();
            $kategori->delete();
            DB::commit();
            return redirect('kategori')->with('success', 'Kategori berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return "Terjadi kesalahan :(" . $error->getMessage();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new kategoriExport, $date . '_kategori.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new KategoriImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import data berhasil');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Gagal mengimpor data : ' . $e->getMessage());
        }
    }

    public function exportPDF()
    {
        // Ambil data yang akan diekspor (contoh: dari database)
        $data = Kategori::all();

        // Render data ke dalam tampilan HTML
        $html = view('kategori.pdf', compact('data'))->render();
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
