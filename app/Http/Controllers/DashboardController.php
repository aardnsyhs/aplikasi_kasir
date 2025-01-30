<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDateRaw = $request->input('start_date');
        $endDateRaw = $request->input('end_date');

        try {
            $startDate = $startDateRaw
                ? Carbon::createFromFormat('m/d/Y', $startDateRaw)->format('Y-m-d')
                : now()->subMonth()->format('Y-m-d');
            $endDate = $endDateRaw
                ? Carbon::createFromFormat('m/d/Y', $endDateRaw)->format('Y-m-d')
                : now()->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['date' => 'Format tanggal tidak valid.']);
        }

        $dataPenjualan = Penjualan::select(DB::raw('DATE(tanggal_penjualan) as tanggal'), DB::raw('SUM(total_harga) as total'))
            ->whereBetween('tanggal_penjualan', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalPenjualan = Penjualan::whereBetween('tanggal_penjualan', [$startDate, $endDate])->sum('total_harga');
        $totalPelanggan = Pelanggan::count();

        $riwayatTransaksi = Penjualan::with(['pelanggan', 'detailPenjualan.produk'])
            ->whereBetween('tanggal_penjualan', [$startDate, $endDate])
            ->orderBy('tanggal_penjualan', 'desc')
            ->get();

        return view('dashboard', [
            'labels' => $dataPenjualan->pluck('tanggal')->toArray(),
            'values' => $dataPenjualan->pluck('total')->toArray(),
            'totalPenjualan' => $totalPenjualan,
            'totalPelanggan' => $totalPelanggan,
            'startDate' => $startDateRaw ?? now()->subMonth()->format('m/d/Y'),
            'endDate' => $endDateRaw ?? now()->format('m/d/Y'),
            'riwayatTransaksi' => $riwayatTransaksi,
        ]);
    }
}
