<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <section class="dark:bg-gray-900 p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="grid lg:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <p class="text-2xl font-semibold text-center">Daftar Barang</p>
                        <div class="space-y-4 rounded-lg border bg-white p-5">
                            @foreach ($cart as $item)
                                <div class="flex items-center justify-between p-4 border-b">
                                    <div class="flex items-center space-x-4">
                                        @if (!empty($item['gambar']))
                                            <img class="h-24 w-28 rounded-md border object-cover"
                                                src="{{ asset('storage/' . $item['gambar']) }}"
                                                alt="{{ $item['nama_produk'] }}">
                                        @else
                                            <img class="h-24 w-28 rounded-md border object-cover"
                                                src="https://placehold.co/600x400" alt="Gambar Tidak Tersedia">
                                        @endif
                                        <div class="flex flex-col flex-grow">
                                            <span class="font-semibold text-gray-800">{{ $item['nama_produk'] }}</span>
                                            <span class="text-gray-500">{{ $item['quantity'] }} x
                                                Rp.{{ number_format($item['harga'], 2, ',', '.') }}</span>
                                            <p class="text-md font-semibold text-gray-900">Subtotal:
                                                Rp.{{ number_format($item['harga'] * $item['quantity'], 2, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="produk[{{ $loop->index }}][produk_id]"
                                    value="{{ $item['produk_id'] }}">
                                <input type="hidden" name="produk[{{ $loop->index }}][quantity]"
                                    value="{{ $item['quantity'] }}">
                                <input type="hidden" name="produk[{{ $loop->index }}][harga]" value="{{ $item['harga'] }}">
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-6">
                        <p class="text-2xl font-semibold text-center">Identitas Pelanggan</p>
                        <div class="space-y-6 bg-white p-6 rounded-lg shadow-md">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Pelanggan</label>
                                <div class="flex space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_pelanggan" value="bukan_member" checked
                                            onclick="togglePelangganForm()">
                                        <span class="ml-2">Bukan Member</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_pelanggan" value="member_baru"
                                            onclick="togglePelangganForm()">
                                        <span class="ml-2">Member Baru</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_pelanggan" value="member"
                                            onclick="togglePelangganForm()">
                                        <span class="ml-2">Member</span>
                                    </label>
                                </div>
                            </div>
                            <div id="cari_member" class="hidden">
                                <label for="username_member" class="block text-sm font-medium text-gray-700">Cari
                                    Member</label>
                                <input type="text" id="username_member" name="username_member"
                                    class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan username member" oninput="cekMember()">
                                @error('username_member')
                                    <p class="text-red-600 dark:text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                                <p id="status_member" class="text-sm mt-2"></p>
                            </div>
                            <div id="form_pelanggan" class="hidden">
                                <div>
                                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama
                                        Pelanggan</label>
                                    <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                        class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan nama Anda">
                                </div>
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="3"
                                        class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div>
                                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor
                                        Telepon</label>
                                    <input type="number" id="nomor_telepon" name="nomor_telepon"
                                        class="w-full rounded-md border-gray-300 px-4 py-3 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                            <div>
                                <label for="nominal_bayar" class="block text-sm font-medium text-gray-700">Nominal
                                    Bayar</label>
                                <input type="number" id="nominal_bayar" name="nominal_bayar"
                                    class="w-full rounded-md border-gray-300 px-4 py-3 text-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan jumlah uang yang dibayarkan">
                                @error('nominal_bayar')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-between mt-4">
                                <p class="text-xl font-semibold">Total Harga</p>
                                <p class="text-xl font-bold text-gray-900">
                                    Rp.{{ number_format(collect($cart)->sum(fn($item) => $item['harga'] * $item['quantity']), 2, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-md font semibold">Kembalian</p>
                                <p class="text-md font-semibold"><span id="kembalian">0</span></p>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="w-full md:w-auto bg-blue-600 text-white rounded-md py-2 px-3 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>

<script>
    document.getElementById('nominal_bayar').addEventListener('input', function () {
        let totalHarga = parseFloat("{{ collect($cart)->sum(fn($item) => $item['harga'] * $item['quantity']) }}");
        let nominalBayar = parseFloat(this.value);
        let kembalian = nominalBayar - totalHarga;

        function formatCurrency(amount) {
            return 'Rp.' + new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount);
        }

        document.getElementById('kembalian').textContent = kembalian >= 0 ? formatCurrency(kembalian) : formatCurrency(0);
    })

    function togglePelangganForm() {
        let jenisPelanggan = document.querySelector('input[name="jenis_pelanggan"]:checked').value;

        if (jenisPelanggan === 'bukan_member') {
            document.getElementById('cari_member').classList.add('hidden');
            document.getElementById('form_pelanggan').classList.add('hidden');
        } else if (jenisPelanggan === 'member_baru') {
            document.getElementById('cari_member').classList.add('hidden');
            document.getElementById('form_pelanggan').classList.remove('hidden');
        } else if (jenisPelanggan === 'member') {
            document.getElementById('cari_member').classList.remove('hidden');
            document.getElementById('form_pelanggan').classList.add('hidden');
        }
    }

    function cekMember() {
        let username = document.getElementById('username_member').value;

        if (username.length > 3) {
            fetch(`${window.location.pathname.split('/checkout')[0]}/cek-member?username=${username}`)
                .then(response => response.json())
                .then(data => {
                    if (data.found) {
                        document.getElementById('status_member').textContent = "Member ditemukan: " + data.nama;

                        document.getElementById('nama_pelanggan').value = data.nama;
                        document.getElementById('alamat').value = data.alamat;
                        document.getElementById('nomor_telepon').value = data.nomor_telepon;

                        document.getElementById('form_pelanggan').classList.remove('hidden');

                        document.getElementById('nama_pelanggan').setAttribute('readonly', true);
                        document.getElementById('alamat').setAttribute('readonly', true);
                        document.getElementById('nomor_telepon').setAttribute('readonly', true);
                    } else {
                        document.getElementById('status_member').textContent = "Member tidak ditemukan.";

                        document.getElementById('nama_pelanggan').value = "";
                        document.getElementById('alamat').value = "";
                        document.getElementById('nomor_telepon').value = "";

                        document.getElementById('form_pelanggan').classList.add('hidden');

                        document.getElementById('nama_pelanggan').removeAttribute('readonly');
                        document.getElementById('alamat').removeAttribute('readonly');
                        document.getElementById('nomor_telepon').removeAttribute('readonly');
                    }
                })
                .catch(() => {
                    document.getElementById('status_member').textContent = "Terjadi kesalahan saat mencari member.";
                });
        } else {
            document.getElementById('status_member').textContent = "";
            document.getElementById('form_pelanggan').classList.add('hidden');

            document.getElementById('nama_pelanggan').removeAttribute('readonly');
            document.getElementById('alamat').removeAttribute('readonly');
            document.getElementById('nomor_telepon').removeAttribute('readonly');
        }
    }
</script>
