@extends('layouts.app')

@section('title', 'Edit Log Harian')

@section('content')
    <div class="mt-14 space-y-6 p-4 sm:ml-64">
        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center space-x-3">
                <a href="{{ route('daily-log.index') }}" class="text-indigo-600 hover:text-indigo-500">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Log Harian</h1>
                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($dailyLog->log_date)->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white shadow">
            <form method="POST" action="{{ route('daily-log.update', $dailyLog) }}" enctype="multipart/form-data"
                class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="log_date" class="mb-2 block text-sm font-medium text-gray-700">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="log_date" name="log_date"
                            value="{{ old('log_date', $dailyLog->log_date) }}" max="{{ date('Y-m-d') }}" required
                            class="@error('log_date') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">
                        @error('log_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Lampiran Saat Ini
                        </label>
                        @if ($dailyLog->attachment)
                            <div class="flex items-center space-x-3 rounded-md bg-gray-50 p-3">
                                <i class="fas fa-paperclip text-gray-500"></i>
                                <a href="{{ Storage::url($dailyLog->attachment) }}" target="_blank"
                                    class="flex-1 text-indigo-600 hover:text-indigo-500">
                                    {{ basename($dailyLog->attachment) }}
                                </a>
                            </div>
                        @else
                            <p class="italic text-gray-500">Tidak ada lampiran</p>
                        @endif
                    </div>
                </div>

                <div>
                    <label for="attachment" class="mb-2 block text-sm font-medium text-gray-700">
                        {{ $dailyLog->attachment ? 'Ganti Lampiran (Opsional)' : 'Tambah Lampiran (Opsional)' }}
                    </label>
                    <input type="file" id="attachment" name="attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                        class="@error('attachment') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">
                    <p class="mt-1 text-xs text-gray-500">
                        Format: PDF, DOC, DOCX, JPG, JPEG, PNG. Maksimal 2MB
                        @if ($dailyLog->attachment)
                            <br><strong>Catatan:</strong> File baru akan mengganti file yang sudah ada
                        @endif
                    </p>
                    @error('attachment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="activity_description" class="mb-2 block text-sm font-medium text-gray-700">
                        Deskripsi Aktivitas <span class="text-red-500">*</span>
                    </label>
                    <textarea id="activity_description" name="activity_description" rows="6" required
                        placeholder="Jelaskan secara detail aktivitas yang telah Anda lakukan hari ini..."
                        class="@error('activity_description') border-red-500 @enderror w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500">{{ old('activity_description', $dailyLog->activity_description) }}</textarea>
                    @error('activity_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maksimal 1000 karakter</p>
                </div>

                <div class="flex items-center justify-end space-x-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('daily-log.index') }}"
                        class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-6 py-2 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <i class="fas fa-save mr-2"></i>
                        Update Log
                    </button>
                </div>
            </form>
        </div>

        <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle mr-3 mt-1 text-yellow-500"></i>
                <div class="text-sm text-yellow-800">
                    <h3 class="mb-1 font-medium">Perhatian:</h3>
                    <ul class="list-inside list-disc space-y-1">
                        <li>Anda hanya dapat mengedit log yang masih berstatus "Pending"</li>
                        <li>Setelah log disetujui atau ditolak, tidak dapat diedit lagi</li>
                        <li>Pastikan semua informasi sudah benar sebelum menyimpan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const textarea = document.getElementById('activity_description');
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });

            textarea.addEventListener('input', function() {
                const maxLength = 1000;
                const currentLength = this.value.length;
                const remaining = maxLength - currentLength;

                let counterElement = this.parentNode.querySelector('.char-counter');
                if (!counterElement) {
                    counterElement = document.createElement('p');
                    counterElement.className = 'char-counter mt-1 text-sm text-gray-500';
                    this.parentNode.appendChild(counterElement);
                }

                counterElement.textContent = `${currentLength}/${maxLength} karakter`;

                if (remaining < 0) {
                    counterElement.className = 'char-counter mt-1 text-sm text-red-500';
                } else if (remaining < 100) {
                    counterElement.className = 'char-counter mt-1 text-sm text-yellow-500';
                } else {
                    counterElement.className = 'char-counter mt-1 text-sm text-gray-500';
                }
            });

            document.getElementById('attachment').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const maxSize = 2 * 1024 * 1024;
                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.value = '';
                    }
                }
            });

            textarea.dispatchEvent(new Event('input'));
        </script>
    @endpush
@endsection
