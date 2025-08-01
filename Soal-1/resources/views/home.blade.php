@extends('layouts.app')

@section('title', 'Daily Log System - Pemerintah Daerah X')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="gradient-bg relative text-white">
            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
            <div class="container relative mx-auto px-4 py-20">
                <div class="mx-auto max-w-4xl text-center">
                    <div class="mb-8">
                        <i class="fas fa-clipboard-list mb-4 text-6xl"></i>
                        <h1 class="mb-6 text-5xl font-bold md:text-6xl">
                            Daily Log System
                        </h1>
                        <p class="mb-8 text-xl text-blue-100 md:text-2xl">
                            Sistem Manajemen Log Harian Pegawai Pemerintah Daerah X
                        </p>
                        <p class="mb-12 text-lg leading-relaxed text-blue-200">
                            Platform digital modern untuk mencatat, memantau, dan memverifikasi aktivitas harian pegawai
                            dengan sistem hierarki yang terintegrasi dan user-friendly.
                        </p>
                    </div>

                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center rounded-lg bg-white px-8 py-4 font-semibold text-indigo-600 shadow-lg transition duration-300 hover:bg-gray-100">
                            <i class="fas fa-sign-in-alt mr-3"></i>
                            Masuk ke Sistem
                        </a>
                        <a href="#features"
                            class="inline-flex items-center rounded-lg border-2 border-white px-8 py-4 font-semibold text-white transition duration-300 hover:bg-white hover:text-indigo-600">
                            <i class="fas fa-info-circle mr-3"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>

            <!-- Wave Shape -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                        fill="white" />
                </svg>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="bg-white py-20">
            <div class="container mx-auto px-4">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-bold text-gray-900">Fitur Unggulan</h2>
                    <p class="mx-auto max-w-3xl text-xl text-gray-600">
                        Sistem yang dirancang khusus untuk memenuhi kebutuhan manajemen log harian
                        dengan teknologi modern dan antarmuka yang intuitif.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div
                        class="rounded-xl border border-gray-100 bg-white p-8 shadow-lg transition duration-300 hover:shadow-xl">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-lg bg-blue-100">
                            <i class="fas fa-clipboard-list text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Manajemen Log Harian</h3>
                        <p class="leading-relaxed text-gray-600">
                            Input, edit, dan kelola log aktivitas harian dengan mudah.
                            Dilengkapi dengan upload attachment untuk dokumentasi yang lengkap.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="rounded-xl border border-gray-100 bg-white p-8 shadow-lg transition duration-300 hover:shadow-xl">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-lg bg-green-100">
                            <i class="fas fa-sitemap text-2xl text-green-600"></i>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Sistem Hierarki</h3>
                        <p class="leading-relaxed text-gray-600">
                            Struktur kepegawaian yang jelas dengan sistem supervisor-subordinate
                            untuk alur persetujuan yang efisien dan terkontrol.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="rounded-xl border border-gray-100 bg-white p-8 shadow-lg transition duration-300 hover:shadow-xl">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-lg bg-purple-100">
                            <i class="fas fa-check-circle text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Sistem Persetujuan</h3>
                        <p class="leading-relaxed text-gray-600">
                            Workflow persetujuan otomatis dengan status tracking yang real-time.
                            Atasan dapat menyetujui atau menolak log dengan catatan.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div
                        class="rounded-xl border border-gray-100 bg-white p-8 shadow-lg transition duration-300 hover:shadow-xl">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-lg bg-yellow-100">
                            <i class="fas fa-chart-bar text-2xl text-yellow-600"></i>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Dashboard Analytics</h3>
                        <p class="leading-relaxed text-gray-600">
                            Dashboard interaktif dengan statistik lengkap, grafik aktivitas bulanan,
                            dan insight untuk memantau produktivitas tim.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div
                        class="rounded-xl border border-gray-100 bg-white p-8 shadow-lg transition duration-300 hover:shadow-xl">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-lg bg-red-100">
                            <i class="fas fa-shield-alt text-2xl text-red-600"></i>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Keamanan Tinggi</h3>
                        <p class="leading-relaxed text-gray-600">
                            Sistem autentikasi yang aman dengan role-based access control
                            dan validasi berlapis untuk melindungi data sensitif.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div
                        class="rounded-xl border border-gray-100 bg-white p-8 shadow-lg transition duration-300 hover:shadow-xl">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-lg bg-indigo-100">
                            <i class="fas fa-mobile-alt text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Responsive Design</h3>
                        <p class="leading-relaxed text-gray-600">
                            Antarmuka yang responsif dan modern, dapat diakses dari berbagai perangkat
                            dengan pengalaman pengguna yang optimal.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Workflow Section -->
        <section class="bg-gray-50 py-20">
            <div class="container mx-auto px-4">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-bold text-gray-900">Alur Kerja Sistem</h2>
                    <p class="mx-auto max-w-3xl text-xl text-gray-600">
                        Proses yang sederhana dan efisien untuk manajemen log harian pegawai
                    </p>
                </div>

                <div class="mx-auto grid max-w-6xl grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div
                            class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-blue-600 text-2xl font-bold text-white">
                            1
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Input Log Harian</h3>
                        <p class="leading-relaxed text-gray-600">
                            Pegawai menginput aktivitas harian dengan deskripsi detail dan lampiran pendukung.
                            Status awal: <span
                                class="rounded-full bg-yellow-100 px-2 py-1 text-xs text-yellow-800">Pending</span>
                        </p>
                    </div>

                    <!-- Arrow 1 -->
                    <div class="hidden items-center justify-center md:flex">
                        <i class="fas fa-arrow-right text-3xl text-gray-400"></i>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div
                            class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">
                            2
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Verifikasi Atasan</h3>
                        <p class="leading-relaxed text-gray-600">
                            Atasan langsung melakukan review dan memberikan persetujuan atau penolakan
                            dengan catatan feedback yang konstruktif.
                        </p>
                    </div>

                    <!-- Arrow 2 -->
                    <div class="hidden items-center justify-center md:col-start-2 md:flex">
                        <i class="fas fa-arrow-right text-3xl text-gray-400"></i>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center md:col-start-3">
                        <div
                            class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-purple-600 text-2xl font-bold text-white">
                            3
                        </div>
                        <h3 class="mb-4 text-xl font-semibold text-gray-900">Monitoring & Reporting</h3>
                        <p class="leading-relaxed text-gray-600">
                            Pantau progres dan produktivitas melalui dashboard analytics
                            dengan berbagai insight dan laporan yang komprehensif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Demo Section -->
        <section class="bg-white py-20">
            <div class="container mx-auto px-4">
                <div class="mx-auto max-w-4xl text-center">
                    <h2 class="mb-8 text-4xl font-bold text-gray-900">Coba Demo Sistem</h2>
                    <p class="mb-12 text-xl text-gray-600">
                        Sistem sudah dilengkapi dengan data demo untuk memudahkan pengujian.
                        Gunakan kredensial berikut untuk mengakses berbagai level akses.
                    </p>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Supervisor Demo -->
                        <div class="rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-100 p-8">
                            <div
                                class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-blue-600 text-white">
                                <i class="fas fa-user-tie text-2xl"></i>
                            </div>
                            <h3 class="mb-4 text-xl font-semibold text-gray-900">Demo Supervisor</h3>
                            <div class="mb-6 space-y-2 text-sm text-gray-700">
                                <p><strong>Email:</strong> kepala.dinas@pemda.go.id</p>
                                <p><strong>Password:</strong> password123</p>
                                <p><strong>Akses:</strong> Full dashboard, verifikasi log</p>
                            </div>
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 text-white transition duration-300 hover:bg-blue-700">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login Supervisor
                            </a>
                        </div>

                        <!-- Staff Demo -->
                        <div class="rounded-xl border border-green-200 bg-gradient-to-br from-green-50 to-emerald-100 p-8">
                            <div
                                class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-white">
                                <i class="fas fa-user text-2xl"></i>
                            </div>
                            <h3 class="mb-4 text-xl font-semibold text-gray-900">Demo Staff</h3>
                            <div class="mb-6 space-y-2 text-sm text-gray-700">
                                <p><strong>Email:</strong> staff1@pemda.go.id</p>
                                <p><strong>Password:</strong> password123</p>
                                <p><strong>Akses:</strong> Input log, lihat status</p>
                            </div>
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center rounded-lg bg-green-600 px-6 py-3 text-white transition duration-300 hover:bg-green-700">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login Staff
                            </a>
                        </div>
                    </div>

                    <div class="mt-8 rounded-lg border border-yellow-200 bg-yellow-50 p-6">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle mr-3 mt-1 text-yellow-600"></i>
                            <div class="text-left">
                                <h4 class="mb-2 font-semibold text-yellow-800">Informasi Demo</h4>
                                <p class="text-sm leading-relaxed text-yellow-700">
                                    Sistem sudah terisi dengan data sample untuk 5 pegawai dengan struktur hierarki lengkap.
                                    Anda dapat mencoba semua fitur termasuk input log, verifikasi, dan melihat dashboard
                                    analytics.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact/Footer Section -->
        <section class="gradient-bg py-16 text-white">
            <div class="container mx-auto px-4">
                <div class="text-center">
                    <h2 class="mb-6 text-3xl font-bold">Siap Memulai?</h2>
                    <p class="mx-auto mb-8 max-w-2xl text-xl text-blue-100">
                        Tingkatkan efisiensi manajemen log harian pegawai dengan sistem yang modern dan terintegrasi.
                    </p>

                    <div class="mb-12 flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center rounded-lg bg-white px-8 py-4 font-semibold text-indigo-600 shadow-lg transition duration-300 hover:bg-gray-100">
                            <i class="fas fa-rocket mr-3"></i>
                            Mulai Sekarang
                        </a>
                    </div>

                    <div class="border-t border-blue-400 pt-8">
                        <div class="flex flex-col items-center justify-between md:flex-row">
                            <div class="mb-4 flex items-center space-x-3 md:mb-0">
                                <i class="fas fa-clipboard-list text-2xl"></i>
                                <span class="text-xl font-semibold">Daily Log System</span>
                            </div>

                            <div class="text-sm text-blue-200">
                                © {{ date('Y') }} Pemerintah Daerah X. Dikembangkan dengan ❤️ untuk efisiensi kerja.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add animation on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe elements for animation
            document.querySelectorAll('.shadow-lg, .shadow-xl').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(el);
            });
        </script>
    @endpush
@endsection
