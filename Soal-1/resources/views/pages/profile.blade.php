@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="mt-14 space-y-6 p-4 sm:ml-64">
        <div class="rounded-lg bg-white p-6 shadow">
            <h1 class="text-2xl font-bold text-gray-900">Profile</h1>
        </div>

        <div class="rounded-lg bg-white shadow">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">Informasi Akun</h2>
                <p class="mt-2 text-sm text-gray-600">Anda dapat mengelola informasi akun Anda di sini.</p>
            </div>
            <div class="border-t border-gray-200 p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <p class="mt-1 text-gray-900">{{ Auth::user()->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-gray-900">{{ Auth::user()->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="mt-1 text-gray-900">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900">Pengaturan Akun</h2>
                <p class="mt-2 text-sm text-gray-600">Anda dapat mengubah password atau menghapus akun Anda di sini.</p>
                <div class="mt-4 space-y-4">
                    <a href="" id="change-password"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        <i class="fas fa-edit mr-2"></i> Ubah Password
                    </a>
                    <a href="" id="delete-account"
                        class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i> Hapus Akun
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.getElementById('change-password').addEventListener('click', function(event) {
            event.preventDefault();
            alert('Mohon maaf, fitur ini belum tersedia.');
        });

        document.getElementById('delete-account').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.')) {
                alert('Mohon maaf, fitur ini belum tersedia.');
            }
        });
    </script>
@endpush
