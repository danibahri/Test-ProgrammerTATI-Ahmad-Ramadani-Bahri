<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('title', 'Daily Log System - Pemda X')</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Custom CSS -->
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .status-pending {
        @apply bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium;
    }

    .status-approved {
        @apply bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium;
    }

    .status-rejected {
        @apply bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium;
    }
</style>

@vite(['resources/css/app.css', 'resources/js/app.js'])
