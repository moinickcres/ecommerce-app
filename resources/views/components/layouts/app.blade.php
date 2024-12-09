<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>{{ $title ?? 'ecommerce' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">
    @yield('content')
    <!-- Header Component -->
    <x-header />

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <!-- Footer Component -->
    <x-footer />

</body>
</html>
