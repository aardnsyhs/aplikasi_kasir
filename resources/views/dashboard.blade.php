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
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Pelanggan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Harga
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayatTransaksi as $transaksi)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $transaksi->pelanggan->nama_pelanggan }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $transaksi->tanggal_penjualan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp.{{ number_format($transaksi->total_harga, 2) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('checkout.success', ['id' => $transaksi->id]) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail
                                            Transaksi</a>
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
                <div class="px-1 pt-4">
                    {{ $riwayatTransaksi->links() }}
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
