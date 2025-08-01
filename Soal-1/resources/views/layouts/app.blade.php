<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        @stack('styles')
    </head>

    <body class="bg-gray-50">
        @auth
            @include('partials.navbar')
            @include('partials.sidebar')
        @endauth

        <main class="@auth container mx-auto px-4 py-6 @else min-h-screen @endauth">
            @include('partials.alerts')
            @yield('content')
        </main>

        @stack('scripts')
    </body>

</html>
