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
                    <label class="block w-full md:w-1/3">
                        <span class="text-gray-700 dark:text-gray-200 font-medium">Start Date</span>
                        <input type="date" name="start_date" value="{{ request('start_date', $startDate) }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </label>
                    <label class="block w-full md:w-1/3">
                        <span class="text-gray-700 dark:text-gray-200 font-medium">End Date</span>
                        <input type="date" name="end_date" value="{{ request('end_date', $endDate) }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </label>
                    <button type="submit"
                        class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition">
                        Filter
                    </button>
                </form>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg text-center">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Penjualan</h3>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                            {{ number_format($totalPenjualan, 2) }}</p>
                    </div>
                    <div class="p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg text-center">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Produk</h3>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalProduk }}</p>
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
