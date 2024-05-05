<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailTransaksi;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Titipan;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kategori'] = Kategori::with(['menu'])->get();
        return view('transaksi.index')->with($data);
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
     * @param  \App\Http\Requests\StoreTransaksiRequest  $request
     */
    public function store(StoreTransaksiRequest $request)
    {
        try {
            DB::beginTransaction();
            $last_id = Transaksi::where('tanggal', date('Y-m-d'))->orderBy('created_at', 'desc')->select('id')->first();
            $noTrans = $last_id == null ? date('Ymd') . '0001' : date('Ymd') . sprintf('%04d', substr($last_id->id, 8, 4) + 1);
            $insertTransaksi = Transaksi::create([
                'id_pelanggan' => $request->id_pelanggan,
                'id' => $noTrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request->total,
                'metode_pembayaran' => "cash",
                'keterangan' => '',
            ]);

            if (!$insertTransaksi->exists) return 'error';

            // Memproses menu yang dipesan
            // dd($request->orderedList);
            $dd = [];
            foreach ($request->orderedList as $detail) {
                $data = [
                    'id_transaksi' => $noTrans,
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty'],
                ];
                if ($detail['barang'] == 'menu') {
                    $menu = Menu::find($detail['barang_id']);
                    $menu->stok->jumlah = $menu->stok->jumlah - $detail['qty'];
                    $menu->save();
                    $menu->stok->save();

                    $data['id_menu'] = $detail['barang_id'];
                } else {
                    $titipan = Titipan::find($detail['barang_id']);
                    $titipan->stok = $titipan->stok - $detail['qty'];
                    $titipan->save();

                    $data['id_titipan'] = $detail['barang_id'];
                }

                // $dd[$detail['barang_id'] . $detail['barang']] = $data
                DetailTransaksi::create($data);
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil!', 'nota' => $noTrans]);
        } catch (Exception | QueryException | PDOException $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal', 'error' => $e->getMessage()]);
        }
    }

    public function faktur($noFaktur)
    {
        $data['transaksi'] = Transaksi::find($noFaktur);
        return view('transaksi.nota')->with($data);
    }
}
