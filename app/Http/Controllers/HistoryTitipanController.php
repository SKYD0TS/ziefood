<?php

namespace App\Http\Controllers;

use App\Models\Titipan;
use App\Models\Transaksi;
use App\Models\Jenis;
use Illuminate\Http\Request;

class HistoryTitipanController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['titipan', 'transaksi'])->get(); // Ambil data jenis dengan relasi menu dan titipan
        return view('titipan_history.index', compact('transaksi'));
    }
}
