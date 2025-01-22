<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($user) ? 'Edit User' : 'Tambah User' }}
        </h2>
    </x-slot>

    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full">
                        <form method="POST"
                            action="{{ isset($user) ? route('user.update', $user) : route('user.store') }}">
                            @csrf
                            @if (isset($user))
                                @method('PUT')
                            @endif
                            <div class="gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="nama_lengkap"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama_lengkap"
                                        value="{{ old('nama_lengkap', $user->nama_lengkap ?? '') }}" id="nama_lengkap"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan nama lengkap Anda">
                                    @error('nama_lengkap')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="username"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Username</label>
                                    <input type="text" name="username"
                                        value="{{ old('username', $user->username ?? '') }}" id="username"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan username Anda">
                                    @error('username')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                        id="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan email Anda">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Password</label>
                                    <input type="password" name="password" value="{{ $user->password ?? '' }}"
                                        id="password"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan password Anda">
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="role"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Role</label>
                                    <select id="role" name="role"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option disabled selected>- Pilih Role -</option>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                    </select>
                                    @error('role')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                {{ isset($user) ? 'Simpan Perubahan' : 'Simpan User' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
