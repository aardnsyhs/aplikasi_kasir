<x-app-layout>
    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="max-w-3xl mx-auto mt-10">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold text-green-600 mb-4 text-center">Pembayaran Berhasil!</h1>
                    <p class="text-lg text-gray-700 text-center">Terima kasih telah berbelanja. Data transaksi Anda telah
                        disimpan.</p>
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Pelanggan</h2>
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nama Pelanggan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Alamat</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nomor Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggan->nama_pelanggan }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggan->alamat }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggan->nomor_telepon }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Barang yang Dibeli</h2>
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nama Produk</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Jumlah</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Harga Satuan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailPenjualan as $detail)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $detail->produk->nama_produk }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">
                                            {{ $detail->jumlah_produk }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">
                                            Rp.{{ number_format($detail->produk->harga, 2, ',', '.') }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">
                                            Rp.{{ number_format($detail->subtotal, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-100">
                                <tr>
                                    <th colspan="3" class="border border-gray-300 px-4 py-2 text-right">Total</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">
                                        Rp.{{ number_format($penjualan->total_harga, 2, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="text-center mt-6">
                        <a href="{{ route('pembelian.index') }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
