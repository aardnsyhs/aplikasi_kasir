<style>
    @page {
        size: auto;
        margin-top: 0mm;
        margin-bottom: 0mm;
        width: auto;
        height: auto;
    }
</style>

<x-app-layout>
    <section class="dark:bg-gray-900 p-3 sm:p-5 flex justify-center">
        <div id="struk-belanja" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg border border-gray-300">
            <h1 class="text-xl text-center font-bold">Toko ABC</h1>
            <p class="text-sm text-center text-gray-700">Jl. Contoh No. 123, Kota Contoh</p>
            <p class="text-sm text-center text-gray-700">Telepon: (021) 123-4567</p>
            <h2 class="text-lg font-semibold text-center text-green-600">Pembayaran Berhasil!</h2>
            <p class="text-sm text-center text-gray-700">Terima kasih telah berbelanja.</p>
            <hr class="my-2 border-dashed border-gray-400">

            <div class="text-sm font-mono flex justify-between">
                <div class="flex flex-col">
                    @if ($penjualan->pelanggan)
                        <p><strong>Nama:</strong> {{ $penjualan->pelanggan->nama_pelanggan }}</p>
                        <p><strong>Alamat:</strong> {{ $penjualan->pelanggan->alamat }}</p>
                        <p><strong>Telepon:</strong> {{ $penjualan->pelanggan->nomor_telepon }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <p><strong>Nama Kasir:</strong> {{ $kasir->petugas->nama_lengkap }}</p>
                </div>
            </div>

            <hr class="my-2 border-dashed border-gray-400">

            <table class="w-full text-sm font-mono">
                <thead>
                    <tr>
                        <th class="text-left">Produk</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->detailPenjualan as $detail)
                                        @php
                                            $hargaSatuan = $detail->jumlah_produk > 0 ? ($detail->subtotal / $detail->jumlah_produk) : 0;
                                        @endphp
                                        <tr>
                                            <td class="text-left">
                                                {{ $detail->produk?->nama_produk ?? $detail->nama_produk . " (Tidak tersedia)" }}
                                            </td>
                                            <td class="text-right">{{ $detail->jumlah_produk }}</td>
                                            <td class="text-right text-nowrap">
                                                Rp.{{ number_format($hargaSatuan, 2, ',', '.') }}
                                            </td>
                                            <td class="text-right">Rp.{{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <hr class="my-2 border-dashed border-gray-400">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right font-bold">Total</td>
                        <td class="text-right font-bold">Rp.{{ number_format($penjualan->total_harga, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right font-bold">Nominal Bayar</td>
                        <td class="text-right font-bold">Rp.{{ number_format($penjualan->nominal_bayar, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right font-bold">Kembalian</td>
                        <td class="text-right font-bold">Rp.{{ number_format($penjualan->kembalian, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>

    <div class="text-center mt-4">
        @if (auth()->user()->role === 'petugas')
            <button onclick="printStruk()"
                class="inline-block bg-gray-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800">Cetak</button>
            <a href="{{ route('pembelian.index') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Kembali</a>
        @else
            <a href="{{ route('dashboard') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Kembali</a>
        @endif
    </div>
</x-app-layout>

<script>
    function printStruk() {
        let struk = document.getElementById('struk-belanja').innerHTML;
        let judul = document.title;
        let originalContent = document.body.innerHTML;
        document.title = "Struk Belanja";
        document.body.innerHTML = struk;
        window.print();
        document.title = judul;
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>
