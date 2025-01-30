<?php
namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPenjualanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Penjualan::select('id', 'pelanggan_id', 'tanggal_penjualan', 'total_harga')->get();
    }

    public function headings(): array
    {
        return ["ID", "Pelanggan ID", "Tanggal Penjualan", "Total Harga"];
    }
}
