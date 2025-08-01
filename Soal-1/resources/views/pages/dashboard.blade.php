@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mt-14 space-y-6 p-4 sm:ml-64">
        <!-- Welcome Header -->
        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Selamat Datang, {{ $user->name }}!</h1>
                    <p class="capitalize text-gray-600">{{ str_replace('_', ' ', $user->role) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
                    <p class="text-lg font-semibold text-indigo-600">{{ \Carbon\Carbon::now()->format('H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- My Log Stats -->
            <div class="rounded-lg bg-blue-500 p-6 text-white shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Total Log Saya</p>
                        <p class="text-3xl font-bold">{{ $myStats['total_logs'] }}</p>
                    </div>
                    <i class="fas fa-clipboard-list text-3xl text-blue-200"></i>
                </div>
            </div>

            <div class="rounded-lg bg-yellow-500 p-6 text-white shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100">Pending</p>
                        <p class="text-3xl font-bold">{{ $myStats['pending_logs'] }}</p>
                    </div>
                    <i class="fas fa-clock text-3xl text-yellow-200"></i>
                </div>
            </div>

            <div class="rounded-lg bg-green-500 p-6 text-white shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Disetujui</p>
                        <p class="text-3xl font-bold">{{ $myStats['approved_logs'] }}</p>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-200"></i>
                </div>
            </div>

            <div class="rounded-lg bg-red-500 p-6 text-white shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100">Ditolak</p>
                        <p class="text-3xl font-bold">{{ $myStats['rejected_logs'] }}</p>
                    </div>
                    <i class="fas fa-times-circle text-3xl text-red-200"></i>
                </div>
            </div>
        </div>

        <!-- Supervisor Stats (if applicable) -->
        @if ($subordinateStats)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="rounded-lg bg-indigo-500 p-6 text-white shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100">Total Bawahan</p>
                            <p class="text-3xl font-bold">{{ $subordinateStats['total_subordinates'] }}</p>
                        </div>
                        <i class="fas fa-users text-3xl text-indigo-200"></i>
                    </div>
                </div>

                <div class="rounded-lg bg-orange-500 p-6 text-white shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100">Perlu Verifikasi</p>
                            <p class="text-3xl font-bold">{{ $subordinateStats['pending_verification'] }}</p>
                        </div>
                        <i class="fas fa-clipboard-check text-3xl text-orange-200"></i>
                    </div>
                </div>

                <div class="rounded-lg bg-purple-500 p-6 text-white shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100">Total Log Bawahan</p>
                            <p class="text-3xl font-bold">{{ $subordinateStats['total_subordinate_logs'] }}</p>
                        </div>
                        <i class="fas fa-list text-3xl text-purple-200"></i>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Logs -->
            <div class="rounded-lg bg-white shadow">
                <div class="border-b border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Log Harian Terbaru</h2>
                        <a href="{{ route('daily-log.index') }}" class="text-indigo-600 hover:text-indigo-500">
                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    @if ($recentLogs->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentLogs as $log)
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($log->log_date)->isoFormat('dddd, D MMM Y') }}
                                        </p>
                                        <p class="text-sm text-gray-600">{{ Str::limit($log->activity_description, 50) }}
                                        </p>
                                    </div>
                                    <span class="status-{{ $log->status }}">
                                        {{ ucfirst($log->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-8 text-center">
                            <i class="fas fa-clipboard-list mb-4 text-4xl text-gray-300"></i>
                            <p class="text-gray-500">Belum ada log harian</p>
                            <a href="{{ route('daily-log.create') }}"
                                class="mt-4 inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                                <i class="fas fa-plus mr-2"></i>
                                Buat Log Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Subordinate Logs (for verification) -->
            @if ($recentSubordinateLogs && $recentSubordinateLogs->count() > 0)
                <div class="rounded-lg bg-white shadow">
                    <div class="border-b border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Log Perlu Verifikasi</h2>
                            <a href="{{ route('daily-log.verification') }}" class="text-indigo-600 hover:text-indigo-500">
                                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach ($recentSubordinateLogs as $log)
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $log->user->name }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($log->log_date)->isoFormat('dddd, D MMM Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ Str::limit($log->activity_description, 40) }}
                                        </p>
                                    </div>
                                    <span class="status-{{ $log->status }}">
                                        {{ ucfirst($log->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- Quick Actions -->
                <div class="rounded-lg bg-white shadow">
                    <div class="border-b border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('daily-log.create') }}"
                                class="flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-3 text-white transition duration-200 hover:bg-indigo-700">
                                <i class="fas fa-plus mr-2"></i>
                                Buat Log Harian Baru
                            </a>

                            <a href="{{ route('daily-log.index') }}"
                                class="flex w-full items-center justify-center rounded-lg bg-gray-100 px-4 py-3 text-gray-700 transition duration-200 hover:bg-gray-200">
                                <i class="fas fa-list mr-2"></i>
                                Lihat Semua Log Saya
                            </a>

                            @if ($user->subordinates->count() > 0)
                                <a href="{{ route('daily-log.verification') }}"
                                    class="flex w-full items-center justify-center rounded-lg bg-green-100 px-4 py-3 text-green-700 transition duration-200 hover:bg-green-200">
                                    <i class="fas fa-clipboard-check mr-2"></i>
                                    Verifikasi Log Bawahan
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Monthly Chart -->
        @if ($monthlyData->count() > 0)
            <div class="rounded-lg bg-white shadow">
                <div class="border-b border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Aktivitas Bulanan</h2>
                </div>
                <div class="p-6">
                    <canvas id="monthlyChart" width="400" height="200"></canvas>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        @if ($monthlyData->count() > 0)
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('monthlyChart').getContext('2d');
                const monthlyChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach ($monthlyData as $data)
                                '{{ \Carbon\Carbon::create()->month($data->month)->isoFormat('MMMM') }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Disetujui',
                            data: [
                                @foreach ($monthlyData as $data)
                                    {{ $data->approved }},
                                @endforeach
                            ],
                            backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        }, {
                            label: 'Pending',
                            data: [
                                @foreach ($monthlyData as $data)
                                    {{ $data->pending }},
                                @endforeach
                            ],
                            backgroundColor: 'rgba(234, 179, 8, 0.8)',
                        }, {
                            label: 'Ditolak',
                            data: [
                                @foreach ($monthlyData as $data)
                                    {{ $data->rejected }},
                                @endforeach
                            ],
                            backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endif
    @endpush
@endsection
