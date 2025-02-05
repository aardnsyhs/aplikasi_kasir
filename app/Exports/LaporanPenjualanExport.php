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
            "Nama Pelanggan",
            "Tanggal Penjualan",
            "Nama Produk",
            "Jumlah",
            "Harga Satuan",
            "Subtotal",
            "Total Transaksi"
        ];
    }

    public function map($penjualan): array
    {
        $rows = [];
        $totalTransaksiDisplayed = [];

        foreach ($penjualan->detailPenjualan as $detail) {
            $key = $penjualan->pelanggan_id . '-' . $penjualan->tanggal_penjualan;

            $hargaSatuan = $detail->jumlah_produk > 0 ? ($detail->subtotal / $detail->jumlah_produk) : 0;

            $totalTransaksi = isset($totalTransaksiDisplayed[$key]) ? '' : number_format($penjualan->total_harga, 2, ',', '.');
            $totalTransaksiDisplayed[$key] = true;

            $rows[] = [
                $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Tidak Diketahui',
                $penjualan->tanggal_penjualan,
                $detail->produk->nama_produk ?? 'Produk Tidak Diketahui',
                $detail->jumlah_produk,
                number_format($hargaSatuan, 2, ',', '.'),
                number_format($detail->subtotal, 2, ',', '.'),
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

                $this->mergeTotalTransactionCells($sheet);
                $this->mergeCustomerAndDateCells($sheet);

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $cellRange = "A1:{$highestColumn}{$highestRow}";

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

                $sheet->getStyle('A1:G1')->applyFromArray([
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

    private function mergeCustomerAndDateCells($sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $startRow = 2;
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
        $startRow = 2;
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
