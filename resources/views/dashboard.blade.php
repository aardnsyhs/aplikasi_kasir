<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
                <form method="GET" action="{{ route('dashboard') }}" class="mt-4 flex flex-col md:flex-row gap-4">
                    <div id="date-range-picker" date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-start" name="start_date" type="text"
                                value="{{ request('start_date', $startDate) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Pilih tanggal">
                        </div>
                        <span class="mx-4 text-gray-500">sampai</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-end" name="end_date" type="text"
                                value="{{ request('end_date', $endDate) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Pilih tanggal">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition">
                        Filter
                    </button>
                </form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg text-center">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Penjualan</h3>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                            Rp.{{ number_format($totalPenjualan, 2) }}</p>
                    </div>
                    <div class="p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg text-center">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Pelanggan</h3>
                        <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $totalPelanggan }}</p>
                    </div>
                </div>
                <div class="mt-6 p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg">
                    <canvas id="chartPenjualan"></canvas>
                </div>
            </div>
        </div>
        <div class="mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Riwayat Transaksi</h2>
                <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow-lg rounded-lg p-4">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                    Tanggal</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                    Pelanggan</th>
                                <th
                                    class="px-4 py-2 text-right text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                    Total Harga</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">
                                    Detail Produk</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($riwayatTransaksi as $transaksi)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $transaksi->tanggal_penjualan }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $transaksi->pelanggan->nama_pelanggan }}</td>
                                    <td class="px-4 py-3 text-sm text-right font-bold text-blue-600 dark:text-blue-400">
                                        Rp.{{ number_format($transaksi->total_harga, 2) }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        <ul class="list-disc pl-4">
                                            @foreach ($transaksi->detailPenjualan as $detail)
                                                <li>{{ $detail->produk->nama_produk }} ({{ $detail->jumlah_produk }}x)
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada transaksi dalam periode ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let ctx = document.getElementById('chartPenjualan').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Total Penjualan',
                    data: @json($values),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    });
</script>
