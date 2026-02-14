<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ERP')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- MENÚ LATERAL --}}
        <aside class="w-64 bg-gray-900 text-white">
            @include('layouts.sidebar')
        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</body>
</html>

