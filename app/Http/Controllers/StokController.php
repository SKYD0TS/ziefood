<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
use App\Exports\StokExport;
use App\Imports\StokImport;
use App\Models\Menu;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;


class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $data['stok'] = Stok::all();
            // DB::table('stoks')
            //     ->join('menus', 'stoks.menu_id', '=', 'menus.id')
            //     ->select('stoks.*', 'menus.nama_menu', 'menus.id as idMenu')->orderBy('created_at', 'DESC')->get();;
            $menu = Menu::get();
            return view('stok.index', [
                'page' => 'stok',
                'section' => 'Kelola data',
            ], compact('menu'))->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            return $error->getMessage();
            $this->failResponse($error->getCode());
        }
    }

    public function store(StoreStokRequest $request)
    {
        try {
            DB::beginTransaction();
            Stok::create($request->all());
            DB::commit();
            return redirect('stok')->with('success', 'Stok berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function update(StoreStokRequest $request, Stok $stok)
    {
        try {
            DB::beginTransaction();
            $stok->update($request->all());
            DB::commit();
            return redirect('stok')->with('success', 'Stok berhasil diupdate!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function destroy(Stok $stok)
    {
        try {
            DB::beginTransaction();
            $stok->delete();
            DB::commit();
            return redirect('stok')->with('success', 'Stok berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return "Terjadi kesalahan :(" . $error->getMessage();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new StokExport, $date . '_Stok.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new StokImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import data menu berhasil');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Gagal mengimpor data Stok: ' . $e->getMessage());
        }
    }

    public function exportPDF()
    {
        // Ambil data yang akan diekspor (contoh: dari database)
        $data = Stok::all();

        // Render data ke dalam tampilan HTML
        $html = view('stok.pdf', compact('data'))->render();
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
