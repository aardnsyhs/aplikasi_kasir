<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-transaksi {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Laporan Penjualan</h2>
    @if ($startDate && $endDate)
        <p>Periode: {{ $startDate }} sampai {{ $endDate }}</p>
    @else
        <p>Semua Data</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Tanggal Penjualan</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalTransaksiDisplayed = [];
            @endphp
            @foreach ($data as $transaksi)
                        @php
                            $detailCount = count($transaksi->detailPenjualan);
                            $key = $transaksi->pelanggan_id . '-' . $transaksi->tanggal_penjualan;
                            $totalTransaksi = 'Rp.' . number_format($transaksi->total_harga, 2, ',', '.');
                        @endphp
                        @foreach ($transaksi->detailPenjualan as $index => $detail)
                                @php
                                    $hargaSatuan = $detail->jumlah_produk > 0 ? ($detail->subtotal / $detail->jumlah_produk) : 0;
                                @endphp
                                <tr>
                                    @if ($index === 0)
                                        <td rowspan="{{ $detailCount }}">
                                            {{ $transaksi->pelanggan ? $transaksi->pelanggan->nama_pelanggan : 'Tidak Diketahui' }}
                                        </td>
                                        <td rowspan="{{ $detailCount }}">{{ $transaksi->tanggal_penjualan }}</td>
                                    @endif
                                    <td>{{ $detail->produk->nama_produk ?? 'Produk Tidak Diketahui' }}</td>
                                    <td>{{ $detail->jumlah_produk }}</td>
                                    <td>Rp.{{ number_format($hargaSatuan, 2, ',', '.') }}</td>
                                    <td>Rp.{{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                                    @if ($index === 0)
                                        <td rowspan="{{ $detailCount }}" class="total-transaksi">{{ $totalTransaksi }}</td>
                                    @endif
                                </tr>
                        @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>