@extends('layouts.app')

@section('title', 'Log Harian Saya')

@section('content')
    <div class="mt-14 space-y-6 p-4 sm:ml-64">
        <!-- Header -->
        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Log Harian Saya</h1>
                    <p class="text-gray-600">Kelola aktivitas harian Anda</p>
                </div>
                <a href="{{ route('daily-log.create') }}"
                    class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Log Baru
                </a>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="rounded-lg bg-white p-6 shadow">
            <form method="GET" action="{{ route('daily-log.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Tanggal Dari</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Tanggal Sampai</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        <i class="fas fa-search mr-1"></i>
                        Filter
                    </button>
                    <a href="{{ route('daily-log.index') }}"
                        class="rounded-md bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Daily Logs List -->
        <div class="rounded-lg bg-white shadow">
            @if ($logs->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Tanggal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Aktivitas
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Lampiran
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($logs as $log)
                                <tr class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($log->log_date)->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-xs">
                                            <p class="truncate" title="{{ $log->activity_description }}">
                                                {{ Str::limit($log->activity_description, 80) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="status-{{ $log->status }}">
                                            @if ($log->status == 'pending')
                                                <i class="fas fa-clock mr-1"></i>Pending
                                            @elseif($log->status == 'approved')
                                                <i class="fas fa-check-circle mr-1"></i>Disetujui
                                            @else
                                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                                            @endif
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                        @if ($log->attachment)
                                            <a href="{{ Storage::url($log->attachment) }}" target="_blank"
                                                class="text-indigo-600 hover:text-indigo-500">
                                                <i class="fas fa-paperclip mr-1"></i>
                                                Lihat File
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('daily-log.show', $log) }}"
                                                class="text-blue-600 hover:text-blue-500" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if ($log->status == 'pending')
                                                <a href="{{ route('daily-log.edit', $log) }}"
                                                    class="text-indigo-600 hover:text-indigo-500" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form method="POST" action="{{ route('daily-log.destroy', $log) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus log ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-500"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $logs->links() }}
                </div>
            @else
                <div class="py-12 text-center">
                    <i class="fas fa-clipboard-list mb-4 text-6xl text-gray-300"></i>
                    <h3 class="mb-2 text-lg font-medium text-gray-900">Belum Ada Log Harian</h3>
                    <p class="mb-6 text-gray-600">Mulai catat aktivitas harian Anda sekarang.</p>
                    <a href="{{ route('daily-log.create') }}"
                        class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Log Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
