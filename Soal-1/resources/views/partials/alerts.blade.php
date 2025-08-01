@if (session('success'))
    <div
        class="mb-4 mt-14 flex items-center rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 sm:ml-64">
        <i class="fas fa-check-circle mr-3"></i>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 mt-14 flex items-center rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700 sm:ml-64">
        <i class="fas fa-exclamation-circle mr-3"></i>
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div
        class="mb-4 mt-14 flex items-center rounded border border-yellow-400 bg-yellow-100 px-4 py-3 text-yellow-700 sm:ml-64">
        <i class="fas fa-exclamation-triangle mr-3"></i>
        {{ session('warning') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 mt-14 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700 sm:ml-64">
        <div class="mb-2 flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <strong>Terdapat kesalahan:</strong>
        </div>
        <ul class="list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
