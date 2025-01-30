<x-app-layout>
    <section class="dark:bg-gray-900 p-3 sm:p-5 flex justify-center">
        <div id="struk-belanja" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg border border-gray-300">
            <h2 class="text-lg font-semibold text-center text-green-600">Pembayaran Berhasil!</h2>
            <p class="text-sm text-center text-gray-700">Terima kasih telah berbelanja.</p>
            <hr class="my-2 border-dashed border-gray-400">
            <div class="text-sm font-mono">
                <p><strong>Nama:</strong> {{ $pelanggan->nama_pelanggan }}</p>
                <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
                <p><strong>Telepon:</strong> {{ $pelanggan->nomor_telepon }}</p>
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
                    @foreach ($detailPenjualan as $detail)
                        <tr>
                            <td class="text-left">{{ $detail->produk->nama_produk }}</td>
                            <td class="text-right">{{ $detail->jumlah_produk }}</td>
                            <td class="text-right">Rp.{{ number_format($detail->produk->harga, 2, ',', '.') }}</td>
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
                </tfoot>
            </table>
        </div>
    </section>
    <div class="text-center">
        <button onclick="printStruk()"
            class="inline-block bg-gray-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800">Cetak</button>
        <a href="{{ route('pembelian.index') }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Kembali</a>
    </div>
</x-app-layout>

<script>
    function printStruk() {
        let struk = document.getElementById('struk-belanja').innerHTML;
        let originalContent = document.body.innerHTML;
        document.body.innerHTML = struk;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>
