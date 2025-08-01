@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex min-h-screen items-center justify-center">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center">
                <div class="gradient-bg mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full">
                    <i class="fas fa-clipboard-list text-2xl text-white"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Daily Log System</h2>
                <p class="mt-2 text-sm text-gray-600">Pemerintah Daerah X</p>
            </div>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="rounded-lg bg-white p-8 shadow-lg">
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email" required
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500"
                                placeholder="Masukkan email Anda" value="{{ old('email') }}">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input id="password" name="password" type="password" required
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500"
                                placeholder="Masukkan password Anda">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="gradient-bg flex w-full justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white shadow-sm hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Masuk
                        </button>
                    </div>
                </div>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 rounded-lg border border-blue-200 bg-blue-50 p-4">
                <h3 class="mb-2 text-sm font-medium text-blue-800">Demo Credentials:</h3>
                <div class="space-y-1 text-xs text-blue-700">
                    <p><strong>Kepala Dinas:</strong> kepala.dinas@pemda.go.id</p>
                    <p><strong>Kepala Bidang 1:</strong> kepala.bidang1@pemda.go.id</p>
                    <p><strong>Kepala Bidang 2:</strong> kepala.bidang2@pemda.go.id</p>
                    <p><strong>Staff 1:</strong> staff1@pemda.go.id</p>
                    <p><strong>Staff 2:</strong> staff2@pemda.go.id</p>
                    <p class="font-medium text-blue-600">Password untuk semua: <strong>password123</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection
