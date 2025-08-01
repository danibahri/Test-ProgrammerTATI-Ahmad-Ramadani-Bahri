@extends('layouts.app')

@section('title', 'Detail Log Harian')

@section('content')
    <div class="mt-14 space-y-6 p-4 sm:ml-64">
        <!-- Header -->
        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('daily-log.index') }}" class="text-indigo-600 hover:text-indigo-500">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Log Harian</h1>
                        <p class="text-gray-600">{{ $dailyLog->user->name }}</p>
                    </div>
                </div>

                @if ($dailyLog->user_id == auth()->id() && $dailyLog->status == 'pending')
                    <div class="flex space-x-2">
                        <a href="{{ route('daily-log.edit', $dailyLog) }}"
                            class="inline-flex items-center rounded-lg bg-indigo-600 px-3 py-2 text-white hover:bg-indigo-700">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Log Details -->
        <div class="rounded-lg bg-white shadow">
            <div class="p-6">
                <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Date -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Tanggal</label>
                        <div class="rounded-md bg-gray-50 p-3">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar-alt text-gray-500"></i>
                                <span
                                    class="font-medium">{{ \Carbon\Carbon::parse($dailyLog->log_date)->isoFormat('dddd, D MMMM Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Status</label>
                        <div class="rounded-md bg-gray-50 p-3">
                            <span class="status-{{ $dailyLog->status }}">
                                @if ($dailyLog->status == 'pending')
                                    <i class="fas fa-clock mr-2"></i>Pending - Menunggu Persetujuan
                                @elseif($dailyLog->status == 'approved')
                                    <i class="fas fa-check-circle mr-2"></i>Disetujui
                                @else
                                    <i class="fas fa-times-circle mr-2"></i>Ditolak
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Created At -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Dibuat Pada</label>
                        <div class="rounded-md bg-gray-50 p-3">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock text-gray-500"></i>
                                <span>{{ $dailyLog->created_at->isoFormat('dddd, D MMMM Y HH:mm') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Updated At -->
                    @if ($dailyLog->updated_at != $dailyLog->created_at)
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                            <div class="rounded-md bg-gray-50 p-3">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-edit text-gray-500"></i>
                                    <span>{{ $dailyLog->updated_at->isoFormat('dddd, D MMMM Y HH:mm') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Activity Description -->
                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Deskripsi Aktivitas</label>
                    <div class="rounded-md border-l-4 border-indigo-500 bg-gray-50 p-4">
                        <p class="whitespace-pre-line leading-relaxed text-gray-800">{{ $dailyLog->activity_description }}
                        </p>
                    </div>
                </div>

                <!-- Attachment -->
                @if ($dailyLog->attachment)
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Lampiran</label>
                        <div class="rounded-md bg-gray-50 p-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @php
                                        $extension = pathinfo($dailyLog->attachment, PATHINFO_EXTENSION);
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $isImage = in_array(strtolower($extension), $imageExtensions);
                                    @endphp

                                    @if ($isImage)
                                        <i class="fas fa-image text-2xl text-green-500"></i>
                                    @elseif(in_array(strtolower($extension), ['pdf']))
                                        <i class="fas fa-file-pdf text-2xl text-red-500"></i>
                                    @elseif(in_array(strtolower($extension), ['doc', 'docx']))
                                        <i class="fas fa-file-word text-2xl text-blue-500"></i>
                                    @else
                                        <i class="fas fa-file text-2xl text-gray-500"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ basename($dailyLog->attachment) }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ strtoupper($extension) }} •
                                        {{ \Storage::disk('public')->exists($dailyLog->attachment)
                                            ? number_format(\Storage::disk('public')->size($dailyLog->attachment) / 1024, 1) . ' KB'
                                            : 'Ukuran tidak diketahui' }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ Storage::url($dailyLog->attachment) }}" target="_blank"
                                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-white hover:bg-indigo-700">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat
                                    </a>
                                    <a href="{{ Storage::url($dailyLog->attachment) }}" download
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-white hover:bg-gray-700">
                                        <i class="fas fa-download mr-2"></i>
                                        Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Supervisor Information -->
        @if ($dailyLog->user->supervisor)
            <div class="rounded-lg bg-white shadow">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Informasi Atasan</h3>
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100">
                                <i class="fas fa-user text-indigo-600"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $dailyLog->user->supervisor->name }}</p>
                            <p class="text-sm capitalize text-gray-600">
                                {{ str_replace('_', ' ', $dailyLog->user->supervisor->role) }}</p>
                            <p class="text-sm text-gray-500">{{ $dailyLog->user->supervisor->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        @if ($dailyLog->user_id == auth()->id())
            <div class="flex justify-center space-x-4">
                @if ($dailyLog->status == 'pending')
                    <a href="{{ route('daily-log.edit', $dailyLog) }}"
                        class="inline-flex items-center rounded-lg bg-indigo-600 px-6 py-3 text-white hover:bg-indigo-700">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Log Ini
                    </a>
                @endif

                <a href="{{ route('daily-log.index') }}"
                    class="inline-flex items-center rounded-lg bg-gray-300 px-6 py-3 text-gray-700 hover:bg-gray-400">
                    <i class="fas fa-list mr-2"></i>
                    Kembali ke Daftar
                </a>
            </div>
        @endif
    </div>
@endsection
