<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $dataPenjualan = Penjualan::select(DB::raw('DATE(tanggal_penjualan) as tanggal'), DB::raw('SUM(total_harga) as total'))
            ->whereBetween('tanggal_penjualan', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalPenjualan = Penjualan::whereBetween('tanggal_penjualan', [$startDate, $endDate])->sum('total_harga');
        $totalProduk = Produk::count();
        $totalPelanggan = Pelanggan::count();

        return view('dashboard', [
            'labels' => $dataPenjualan->pluck('tanggal')->toArray(),
            'values' => $dataPenjualan->pluck('total')->toArray(),
            'totalPenjualan' => $totalPenjualan,
            'totalProduk' => $totalProduk,
            'totalPelanggan' => $totalPelanggan,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
