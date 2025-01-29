<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Keranjang') }}
        </h2>
    </x-slot>

    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        @foreach (session('cart', []) as $item)
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    @if (!empty($item['gambar']))
                                        <img class="h-20 w-20 object-cover rounded-md"
                                            src="{{ asset('storage/' . $item['gambar']) }}"
                                            alt="{{ $item['nama_produk'] }}">
                                    @else
                                        <img class="h-20 w-20 object-cover rounded-md"
                                            src="https://placehold.co/200x200" alt="Gambar Tidak Tersedia">
                                    @endif
                                    <label for="counter-input" class="sr-only">Choose quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button type="button"
                                                class="decrement-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                                data-produk-id="{{ $item['produk_id'] }}">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" id="quantity-{{ $item['produk_id'] }}"
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                value="{{ $item['quantity'] }}" readonly />
                                            <button type="button"
                                                class="increment-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                                data-produk-id="{{ $item['produk_id'] }}">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class="text-base font-bold text-gray-900 dark:text-white">
                                                Rp.<span
                                                    id="harga-{{ $item['produk_id'] }}">{{ number_format($item['harga'] * $item['quantity'], 2, ',', '.') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="#"
                                            class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item['nama_produk'] }}</a>
                                        <div id="product-{{ $item['produk_id'] }}" class="flex items-center gap-4">
                                            <button type="button"
                                                class="remove-button inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500"
                                                data-produk-id="{{ $item['produk_id'] }}">
                                                <svg class="me-1.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if (session()->has('cart') && count(session('cart')) > 0)
                    @php
                        $total = collect(session('cart', []))->sum(function ($item) {
                            return $item['harga'] * $item['quantity'];
                        });
                    @endphp
                    <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                        <div
                            class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Pesanan</p>
                            <div class="space-y-4">
                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">
                                        Rp.<span id="total-harga">{{ number_format($total, 2, ',', '.') }}</span>
                                    </dd>
                                </dl>
                            </div>
                            <a href="/checkout"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Lanjutkan
                                ke Pembayaran</a>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> atau </span>
                                <a href="/pembelian" title=""
                                    class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                    Lanjutkan Belanja
                                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".increment-button, .decrement-button").click(function(e) {
            e.preventDefault();
            let button = $(this);
            let produkId = button.data("produk-id");
            let action = button.hasClass("increment-button") ? "increment" : "decrement";
            let quantityInput = $("#quantity-" + produkId);
            let hargaElement = $("#harga-" + produkId);
            let totalHargaElement = $("#total-harga");

            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    produk_id: produkId,
                    action: action
                },
                success: function(response) {
                    if (response.success) {
                        quantityInput.val(response.new_quantity);
                        hargaElement.text(response.new_total);
                        totalHargaElement.text(response.total_harga);
                    } else {
                        alert("Gagal memperbarui jumlah produk!");
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan saat memperbarui keranjang!");
                }
            });
        });
        $(".remove-button").click(function(e) {
            e.preventDefault();
            let produkId = $(this).data("produk-id");
            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    produk_id: produkId
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                        alert("Produk berhasil dihapus dari keranjang!");
                    } else {
                        alert("Gagal menghapus produk!");
                    }
                }
            });
        });
    });
</script>
