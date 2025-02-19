<?php
namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;
setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id');

class LaporanPenjualanExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Penjualan::with(['pelanggan', 'detailPenjualan.produk'])
            ->when($this->startDate && $this->endDate, function ($query) {
                return $query->whereBetween('tanggal_penjualan', [$this->startDate, $this->endDate]);
            })
            ->orderBy('tanggal_penjualan', 'desc')
            ->orderBy('pelanggan_id', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            ["LAPORAN PENJUALAN"],
            ["Toko ABC"],
            ["Jl. Contoh No. 123, Kota Contoh"],
            ["Telepon: (021) 123-4567"],
            [],
            [
                "Periode: " . ($this->startDate && $this->endDate
                    ? Carbon::parse($this->startDate)->translatedFormat('d F Y') .
                    " sampai " .
                    Carbon::parse($this->endDate)->translatedFormat('d F Y')
                    : "Semua Data")
            ],
            [],
            [
                "Nama Pelanggan",
                "Tanggal Penjualan",
                "Nama Produk",
                "Jumlah",
                "Harga Satuan",
                "Subtotal",
                "Total Transaksi"
            ]
        ];
    }

    public function map($penjualan): array
    {
        $rows = [];
        $totalTransaksiDisplayed = [];

        foreach ($penjualan->detailPenjualan as $detail) {
            $key = $penjualan->pelanggan_id . '-' . $penjualan->tanggal_penjualan;

            $hargaSatuan = $detail->jumlah_produk > 0 ? ($detail->subtotal / $detail->jumlah_produk) : 0;

            $totalTransaksi = isset($totalTransaksiDisplayed[$key]) ? '' : 'Rp.' . number_format($penjualan->total_harga, 2, ',', '.');
            $totalTransaksiDisplayed[$key] = true;

            $rows[] = [
                $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Tidak Diketahui',
                Carbon::parse($penjualan->tanggal_penjualan)->translatedFormat('d F Y'),
                $detail->produk?->nama_produk ?? $detail->nama_produk . " (Tidak tersedia)",
                $detail->jumlah_produk,
                'Rp.' . number_format($hargaSatuan, 2, ',', '.'),
                'Rp.' . number_format($detail->subtotal, 2, ',', '.'),
                $totalTransaksi,
            ];
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A3:G3');
                $sheet->mergeCells('A4:G4');
                $sheet->mergeCells('A5:G5');
                $sheet->mergeCells('A6:G6');

                $sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A2:G4')->applyFromArray([
                    'font' => [
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A6:G6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $highestRow = $sheet->getHighestRow();
                $totalPendapatan = $this->calculateTotalPendapatan($sheet);

                $sheet->setCellValue('A' . ($highestRow + 2), 'Total Pendapatan');
                $sheet->setCellValue('G' . ($highestRow + 2), $totalPendapatan);

                $sheet->mergeCells('A' . ($highestRow + 2) . ':F' . ($highestRow + 2));
                $sheet->getStyle('A' . ($highestRow + 2) . ':G' . ($highestRow + 2))->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'CCCCCC',
                        ],
                    ],
                ]);

                $this->mergeTotalTransactionCells($sheet);
                $this->mergeCustomerAndDateCells($sheet);

                $cellRange = "A8:G{$highestRow}";
                $sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'bold' => false,
                        'size' => 11,
                    ],
                ]);

                $sheet->getStyle('A8:G8')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'CCCCCC'
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'wrapText' => true,
                    ],
                ]);

                foreach (range('A', 'G') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }

    private function calculateTotalPendapatan($sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $totalPendapatan = 0;

        for ($row = 9; $row <= $highestRow; $row++) {
            $totalTransaksi = $sheet->getCell('G' . $row)->getValue();
            if ($totalTransaksi) {
                $totalPendapatan += (float) str_replace(['Rp.', '.', ','], ['', '', '.'], $totalTransaksi);
            }
        }

        return 'Rp.' . number_format($totalPendapatan, 2, ',', '.');
    }

    private function mergeCustomerAndDateCells($sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $startRow = 9;
        $currentRow = $startRow;

        while ($currentRow <= $highestRow) {
            $currentPelanggan = $sheet->getCell('A' . $currentRow)->getValue();
            $currentTanggal = $sheet->getCell('B' . $currentRow)->getValue();
            $nextRow = $currentRow + 1;

            while ($nextRow <= $highestRow) {
                $nextPelanggan = $sheet->getCell('A' . $nextRow)->getValue();
                $nextTanggal = $sheet->getCell('B' . $nextRow)->getValue();

                if ($nextPelanggan === $currentPelanggan && $nextTanggal === $currentTanggal) {
                    $nextRow++;
                } else {
                    break;
                }
            }

            if ($nextRow - $currentRow > 1) {
                $sheet->mergeCells("A{$currentRow}:A" . ($nextRow - 1));
                $sheet->mergeCells("B{$currentRow}:B" . ($nextRow - 1));
            }

            $currentRow = $nextRow;
        }
    }

    private function mergeTotalTransactionCells($sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $startRow = 9;
        $currentRow = $startRow;

        while ($currentRow <= $highestRow) {
            $currentPelanggan = $sheet->getCell('A' . $currentRow)->getValue();
            $currentTanggal = $sheet->getCell('B' . $currentRow)->getValue();
            $nextRow = $currentRow + 1;

            while ($nextRow <= $highestRow) {
                $nextPelanggan = $sheet->getCell('A' . $nextRow)->getValue();
                $nextTanggal = $sheet->getCell('B' . $nextRow)->getValue();

                if ($nextPelanggan === $currentPelanggan && $nextTanggal === $currentTanggal) {
                    $nextRow++;
                } else {
                    break;
                }
            }

            if ($nextRow - $currentRow > 1) {
                $sheet->mergeCells("G{$currentRow}:G" . ($nextRow - 1));
            }

            $currentRow = $nextRow;
        }
    }
}
