@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    @if (Auth::check())
        <div class="mt-14 flex min-h-screen items-center justify-center space-y-6 p-6 sm:ml-64">
            <div class="max-w-md text-center">
                <div class="mb-6">
                    <i class="fas fa-exclamation-triangle text-6xl text-yellow-500"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">404 - Halaman Tidak Ditemukan</h1>
                <p class="mt-2 text-gray-600">Maaf, halaman yang Anda cari tidak ditemukan.</p>
                <a href="{{ route('dashboard') }}"
                    class="mt-4 inline-block rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    @else
        <div class="flex min-h-screen items-center justify-center bg-gray-100 p-6">
            <div class="max-w-md text-center">
                <div class="mb-6">
                    <i class="fas fa-exclamation-triangle text-6xl text-yellow-500"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">404 - Halaman Tidak Ditemukan</h1>
                <p class="mt-2 text-gray-600">Maaf, halaman yang Anda cari tidak ditemukan.</p>
                <a href="{{ route('login') }}"
                    class="mt-4 inline-block rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">
                    Kembali ke Halaman Login
                </a>
            </div>
        </div>
    @endif
@endsection
