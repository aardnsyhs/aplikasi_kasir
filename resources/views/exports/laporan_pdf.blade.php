@php
    use Carbon\Carbon;
    setlocale(LC_TIME, 'id_ID');
    Carbon::setLocale('id');

    $startDateFormatted = $startDate ? Carbon::parse($startDate)->translatedFormat('d F Y') : null;
    $endDateFormatted = $endDate ? Carbon::parse($endDate)->translatedFormat('d F Y') : null;
    $grandTotal = 0;
    $tanggal = Carbon::now()->translatedFormat('d F Y');
@endphp


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

        h2 {
            text-align: center;
            justify-content: center;
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

        .header-laporan {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-laporan h1 {
            margin: 0;
            font-size: 24px;
        }

        .header-laporan p {
            margin: 5px 0;
        }

        .tanda-tangan {
            float: right;
            margin-top: 50px;
            text-align: center;
        }

        .tanda-tangan p {
            margin: 0;
            font-size: 16px;
        }

        .tanda-tangan .nama {
            margin-top: 70px;
            font-weight: bold;
        }

        .title {
            text-align: center;
            font-weight: 600;
            font-size: x-large;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .header-row p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="header-laporan">
        <p style="font-size: x-large; font-weight: 600;">Toko ABC</p>
        <p style="font-size: 12px;">Jl. Contoh No. 123, Kota Contoh</p>
        <p style="font-size: 12px;">Telepon: (021) 123-4567</p>
    </div>
    <hr>
    <p class="title">Laporan Penjualan</p>

    @if ($startDateFormatted && $endDateFormatted)
        <p>Periode: {{ $startDateFormatted }} sampai {{ $endDateFormatted }}</p>
    @else
        <div class="header-row">
            <p>Semua Data</p>
            <p>Dicetak Oleh: {{ Auth::user()->nama_lengkap }}</p>
        </div>
    @endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Nama Pelanggan</th>
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
                $no = 1;
            @endphp
            @foreach ($data as $transaksi)
                        @php
                            $detailCount = count($transaksi->detailPenjualan);
                            $key = $transaksi->pelanggan_id . '-' . $transaksi->tanggal_penjualan;
                            $totalTransaksi = (float) $transaksi->total_harga;
                            $grandTotal += $totalTransaksi;
                        @endphp
                        @foreach ($transaksi->detailPenjualan as $index => $detail)
                                @php
                                    $hargaSatuan = $detail->jumlah_produk > 0 ? ($detail->subtotal / $detail->jumlah_produk) : 0;
                                @endphp
                                <tr>
                                    @if ($index === 0)
                                        <td rowspan="{{ $detailCount }}">{{ $no++ }}</td>
                                        <td rowspan="{{ $detailCount }}">
                                            {{ Carbon::parse($transaksi->tanggal_penjualan)->translatedFormat('d F Y') }}
                                        </td>
                                        <td rowspan="{{ $detailCount }}">
                                            {{ $transaksi->pelanggan ? $transaksi->pelanggan->nama_pelanggan : 'Tidak Diketahui' }}
                                        </td>
                                    @endif
                                    <td>{{ $detail->produk?->nama_produk ?? $detail->nama_produk . " (Tidak tersedia)" }}</td>
                                    <td>{{ $detail->jumlah_produk }}</td>
                                    <td>Rp.{{ number_format($hargaSatuan, 2, ',', '.') }}</td>
                                    <td>Rp.{{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                                    @if ($index === 0)
                                        <td rowspan="{{ $detailCount }}" class="total-transaksi">
                                            Rp.{{ number_format($totalTransaksi, 2, ',', '.') }}</td>
                                    @endif
                                </tr>
                        @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold;">Total Pendapatan:</td>
                <td class="total-transaksi">Rp.{{ number_format($grandTotal, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="tanda-tangan">
        <p>Kota Contoh, {{ $tanggal }}</p>
        <p>Pencetak,</p>
        <p class="nama">{{ Auth::user()->nama_lengkap }}</p>
    </div>
</body>

</html>
