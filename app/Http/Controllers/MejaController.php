<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Http\Requests\StoreMejaRequest;
use App\Http\Requests\UpdateMejaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;
use App\Exports\MejaExport;
use App\Imports\MejaImport;
use App\Models\Menu;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;


class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $data['meja'] = Meja::all();
            // DB::table('mejas')
            //     ->join('menus', 'mejas.menu_id', '=', 'menus.id')
            //     ->select('mejas.*', 'menus.nama_menu', 'menus.id as idMenu')->orderBy('created_at', 'DESC')->get();;
            $menu = Menu::get();
            return view('meja.index', [
                'page' => 'meja',
                'section' => 'Kelola data',
            ], compact('menu'))->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            return $error->getMessage();
            $this->failResponse($error->getCode());
        }
    }

    public function store(StoreMejaRequest $request)
    {
        try {
            DB::beginTransaction();
            Meja::create($request->all());
            DB::commit();
            return redirect('meja')->with('success', 'meja berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return [$error->getMessage(), $error->getCode()];
        }
    }

    public function update(StoreMejaRequest $request, Meja $meja)
    {
        try {
            DB::beginTransaction();
            $meja->update($request->all());
            DB::commit();
            return redirect('meja')->with('success', 'meja berhasil diupdate!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function destroy(Meja $meja)
    {
        try {
            DB::beginTransaction();
            $meja->delete();
            DB::commit();
            return redirect('meja')->with('success', 'meja berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return "Terjadi kesalahan :(" . $error->getMessage();
        }
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new MejaExport, $date . '_Meja.xlsx');
    }

    public function importData()
    {
        try {
            Excel::import(new MejaImport, request()->file('import'));
            return redirect()->back()->with('success', 'Import data menu berhasil');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Gagal mengimpor data Meja: ' . $e->getMessage());
        }
    }

    public function exportPDF()
    {
        // Ambil data yang akan diekspor (contoh: dari database)
        $data = Meja::all();

        // Render data ke dalam tampilan HTML
        $html = view('meja.pdf', compact('data'))->render();
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
