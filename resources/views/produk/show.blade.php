<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full">
                        <div class="gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="nama_produk"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Produk</label>
                                <input type="text" name="nama_produk" value="{{ $produk->nama_produk ?? '' }}"
                                    id="nama_produk"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    readonly>
                            </div>
                            <div class="w-full">
                                <label for="harga"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Harga</label>
                                <input type="number" name="harga" value="{{ $produk->harga ?? '' }}" id="harga"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    readonly>
                            </div>
                            <div class="w-full">
                                <label for="stok"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Stok</label>
                                <input type="text" name="stok" value="{{ $produk->stok ?? '' }}" id="stok"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
