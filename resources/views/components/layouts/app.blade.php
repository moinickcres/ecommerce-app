<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'ecommerce' }}</title>

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Tailwind CSS (or other CSS frameworks) 
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">-->

    <!-- Include Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">
    <!-- Header Component -->
    <x-header />

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Additional Scripts
    <script src="{{ mix('js/app.js') }}"></script>-->
</body>
</html>
