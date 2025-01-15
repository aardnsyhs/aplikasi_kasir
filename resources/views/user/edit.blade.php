<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ isset($user) ? 'Edit User' : 'Tambah User' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ isset($user) ? route('user.update', $user) : route('user.store') }}">
                    @csrf
                    @if (isset($user))
                        @method('PUT')
                    @endif
                    <div class="mb-4">
                        <label class="block text-gray-700">Username</label>
                        <input type="text" name="username" value="{{ $user->username ?? '' }}"
                            class="w-full border-gray-300 rounded mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $user->email ?? '' }}"
                            class="w-full border-gray-300 rounded mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Password</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap ?? '' }}"
                            class="w-full border-gray-300 rounded mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Role</label>
                        <input type="text" name="role" value="{{ $user->role ?? '' }}"
                            class="w-full border-gray-300 rounded mt-1">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ isset($user) ? 'Update' : 'Simpan' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
