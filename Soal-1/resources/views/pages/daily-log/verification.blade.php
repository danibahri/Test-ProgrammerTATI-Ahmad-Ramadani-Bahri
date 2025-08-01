@extends('layouts.app')

@section('title', 'Verifikasi Log Harian')

@section('content')
    <div class="mt-14 space-y-6 p-4 sm:ml-64">
        <div class="rounded-lg bg-white p-6 shadow">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Verifikasi Log Harian Bawahan</h1>
                <p class="text-gray-600">Kelola persetujuan log harian tim Anda</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @php
                $subordinateIds = auth()->user()->subordinates->pluck('id');
                $totalLogs = \App\Models\DailyLog::whereIn('user_id', $subordinateIds)->count();
                $pendingLogs = \App\Models\DailyLog::whereIn('user_id', $subordinateIds)
                    ->where('status', 'pending')
                    ->count();
                $approvedLogs = \App\Models\DailyLog::whereIn('user_id', $subordinateIds)
                    ->where('status', 'approved')
                    ->count();
            @endphp

            <div class="rounded-lg bg-yellow-500 p-6 text-white shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100">Pending</p>
                        <p class="text-3xl font-bold">{{ $pendingLogs }}</p>
                    </div>
                    <i class="fas fa-clock text-3xl text-yellow-200"></i>
                </div>
            </div>

            <div class="rounded-lg bg-green-500 p-6 text-white shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Disetujui</p>
                        <p class="text-3xl font-bold">{{ $approvedLogs }}</p>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-200"></i>
                </div>
            </div>

            <div class="rounded-lg bg-blue-500 p-6 text-white shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Total Log</p>
                        <p class="text-3xl font-bold">{{ $totalLogs }}</p>
                    </div>
                    <i class="fas fa-clipboard-list text-3xl text-blue-200"></i>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <form method="GET" action="{{ route('daily-log.verification') }}"
                class="grid grid-cols-1 gap-4 md:grid-cols-5">
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Pegawai</label>
                    <select name="user_id"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">
                        <option value="">Semua Pegawai</option>
                        @foreach (auth()->user()->subordinates as $subordinate)
                            <option value="{{ $subordinate->id }}"
                                {{ request('user_id') == $subordinate->id ? 'selected' : '' }}>
                                {{ $subordinate->name }}
                            </option>
                        @endforeach
                    </select>
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
                <div class="flex items-end space-x-2">
                    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        <i class="fas fa-search mr-1"></i>
                        Filter
                    </button>
                    <a href="{{ route('daily-log.verification') }}"
                        class="rounded-md bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="rounded-lg bg-white shadow">
            @if ($logs->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Pegawai
                                </th>
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
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 flex-shrink-0">
                                                <div
                                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100">
                                                    <span class="text-sm font-medium text-indigo-600">
                                                        {{ substr($log->user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $log->user->name }}</p>
                                                <p class="text-sm capitalize text-gray-500">
                                                    {{ str_replace('_', ' ', $log->user->role) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($log->log_date)->isoFormat('ddd, D MMM Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-xs">
                                            <p class="truncate" title="{{ $log->activity_description }}">
                                                {{ Str::limit($log->activity_description, 60) }}
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
                                                Lihat
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
                                                <button
                                                    onclick="openVerificationModal({{ $log->id }}, '{{ $log->user->name }}', '{{ $log->log_date }}', 'approved')"
                                                    class="text-green-600 hover:text-green-500" title="Setujui">
                                                    <i class="fas fa-check"></i>
                                                </button>

                                                <button
                                                    onclick="openVerificationModal({{ $log->id }}, '{{ $log->user->name }}', '{{ $log->log_date }}', 'rejected')"
                                                    class="text-red-600 hover:text-red-500" title="Tolak">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $logs->links() }}
                </div>
            @else
                <div class="py-12 text-center">
                    <i class="fas fa-clipboard-check mb-4 text-6xl text-gray-300"></i>
                    <h3 class="mb-2 text-lg font-medium text-gray-900">Tidak Ada Log untuk Diverifikasi</h3>
                    <p class="text-gray-600">Belum ada log harian dari bawahan yang perlu diverifikasi.</p>
                </div>
            @endif
        </div>
    </div>

    <div id="verificationModal" class="fixed inset-0 z-40 hidden bg-gray-600 bg-opacity-50">
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="w-full max-w-md rounded-lg bg-white shadow-xl">
                <div class="p-6">
                    <div class="mb-4 flex items-center">
                        <div id="modalIcon" class="mr-3 flex-shrink-0">
                        </div>
                        <h3 id="modalTitle" class="text-lg font-medium text-gray-900">
                        </h3>
                    </div>

                    <div class="mb-4">
                        <p id="modalMessage" class="text-sm text-gray-600">
                        </p>
                    </div>

                    <form id="verificationForm" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" id="verificationStatus" name="status">

                        <div class="mb-4">
                            <label for="notes" class="mb-2 block text-sm font-medium text-gray-700">
                                Catatan (Opsional)
                            </label>
                            <textarea id="notes" name="notes" rows="3"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500"
                                placeholder="Berikan catatan untuk pegawai..."></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeVerificationModal()"
                                class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit" id="confirmButton"
                                class="rounded-md px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-offset-2">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openVerificationModal(logId, userName, logDate, status) {
                const modal = document.getElementById('verificationModal');
                const form = document.getElementById('verificationForm');
                const statusInput = document.getElementById('verificationStatus');
                const modalIcon = document.getElementById('modalIcon');
                const modalTitle = document.getElementById('modalTitle');
                const modalMessage = document.getElementById('modalMessage');
                const confirmButton = document.getElementById('confirmButton');

                form.action = `/daily-log/${logId}/verify`;
                statusInput.value = status;

                if (status === 'approved') {
                    modalIcon.innerHTML =
                        '<div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center"><i class="fas fa-check text-green-600"></i></div>';
                    modalTitle.textContent = 'Setujui Log Harian';
                    modalMessage.innerHTML =
                        `Apakah Anda yakin ingin <strong>menyetujui</strong> log harian <strong>${userName}</strong> tanggal <strong>${new Date(logDate).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</strong>?`;
                    confirmButton.textContent = 'Setujui';
                    confirmButton.className =
                        'px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500';
                } else {
                    modalIcon.innerHTML =
                        '<div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center"><i class="fas fa-times text-red-600"></i></div>';
                    modalTitle.textContent = 'Tolak Log Harian';
                    modalMessage.innerHTML =
                        `Apakah Anda yakin ingin <strong>menolak</strong> log harian <strong>${userName}</strong> tanggal <strong>${new Date(logDate).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</strong>?`;
                    confirmButton.textContent = 'Tolak';
                    confirmButton.className =
                        'px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500';
                }

                modal.classList.remove('hidden');
            }

            function closeVerificationModal() {
                const modal = document.getElementById('verificationModal');
                const notesTextarea = document.getElementById('notes');

                modal.classList.add('hidden');
                notesTextarea.value = '';
            }

            document.getElementById('verificationModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeVerificationModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeVerificationModal();
                }
            });
        </script>
    @endpush
@endsection
