<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Stok;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $menu = Menu::get();
        $stok = Stok::get();
        $transaksi = Transaksi::get();
        $detailTransaksi = DetailTransaksi::get();
        $date = DetailTransaksi::get();
        
        $data['count_menu'] = $menu->count();
        
        $data['menu_teratas'] = DetailTransaksi::with('menu')
        ->select('id_menu', DB::raw('COUNT(*) as total_terjual'))
        ->groupBy('id_menu')
        ->limit(5)
        ->orderBy('total_terjual','desc')
        ->get();
        
        $data['pelanggan'] = Pelanggan::limit(10)->orderBy('created_at', 'desc')->get();
        
        $data['count_transaksi'] = Transaksi::with('detailTransaksi')
        ->get();
        $today = Carbon::today();


        $data['pendapatan_today'] = DB::table('transaksis')
        ->whereDate('tanggal', $today)
        ->sum('total_harga');
      

        $data['count_transaksi_today'] = Transaksi::whereDate('tanggal', $today)->count();


        $data['lows_stok'] = Stok::with('menu')
    ->join('menus', 'menus.stok_id', '=', 'stoks.id')
    ->orderBy('stoks.jumlah', 'asc') // Mengurutkan stok dari terendah ke tertinggi
    ->limit(3) // Membatasi hasil untuk menampilkan 3 stok terendah
    ->get();



        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');


        if ($request->has('tanggal_awal') && $request->has('tanggal_awal')) {
            $date['tanggal_awal'] = $tanggal_awal;
            $date['tanggal_akhir'] = $tanggal_akhir;

            $data['pendapatan'] = DB::table('transaksis')
                ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
                ->sum('total_harga');

            $data['count_transaksi'] = DB::table('transaksis')
                ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
                ->count();

            $data['menu_teratas'] = DetailTransaksi::with('menu')
                ->whereHas('transaksi', function ($query) use ($tanggal_awal, $tanggal_akhir) {
                    $query->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
                })
                ->select('id_menu', DB::raw('COUNT(*) as total_terjual'))
                ->groupBy('id_menu')
                ->orderBy('total_terjual', 'desc')
                ->limit(5)
                ->get();
        } else {
            $data['date'] = $today;

            $data['pendapatan'] = DB::table('transaksis')
                ->whereDate('tanggal', $today)
                ->sum('total_harga');

            $data['count_transaksi'] = DB::table('transaksis')
                ->whereDate('tanggal', $today)
                ->count();

            $data['menu_teratas'] = DetailTransaksi::with('menu')
                ->whereHas('transaksi', function ($query) use ($today) {
                    $query->whereDate('tanggal', $today);
                })
                ->select('id_menu', DB::raw('COUNT(*) as total_terjual'))
                ->groupBy('id_menu')
                ->orderBy('total_terjual', 'desc')
                ->limit(5)
                ->get();
        };
        return view('dashboard.index')->with($data);
    }
    

    public function data_penjualan($lastCount)
    {
        $data = 0;
        if ($lastCount == 0) {
            $data = Transaksi::select(
                'tanggal',
                DB::raw('SUM(total_harga) as total_bayar'),
                DB::raw('COUNT(id) as jumlah')
            )
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get();
        } else {
            $data = Transaksi::select(
                'tanggal',
                DB::raw('SUM(total_harga) as total_bayar'),
                DB::raw('COUNT(id) as jumlah')
            )
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->skip($lastCount - 1)
                ->limit(264187365)
                ->get();
        }
        
        
        return response($data);
    }

    
}
