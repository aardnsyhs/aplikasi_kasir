<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Stok') }}
        </h2>
    </x-slot>

    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full">
                        <form method="POST" action="{{ route('stok.update', $stok) }}">
                            @csrf
                            @method('PUT')

                            <div class="gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="nama_produk"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nama Produk
                                    </label>
                                    <input type="text" name="nama_produk" value="{{ $stok->nama_produk }}"
                                        id="nama_produk"
                                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        readonly>
                                </div>

                                <div class="w-full">
                                    <label for="stok_saat_ini"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-2">
                                        Stok Saat Ini
                                    </label>
                                    <input type="text" name="stok_saat_ini" value="{{ $stok->stok }}" id="stok_saat_ini"
                                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        readonly>
                                </div>

                                <div class="w-full">
                                    <label for="tambah_stok"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-2">
                                        Tambah Stok
                                    </label>
                                    <input type="number" name="tambah_stok" id="tambah_stok"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        placeholder="Masukkan jumlah stok yang ingin ditambahkan" required min="1">
                                    @error('tambah_stok')
                                        <p class="mt-2 text-red-500 dark:text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                {{ __('Tambah Stok') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
