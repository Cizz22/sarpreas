<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{-- @vite('resources/css/app.css') --}}
    @vite('resources/css/app.css')
    <livewire:styles>
</head>

<body class="bg-gray-50 dark:bg-gray-800 h-screen antialiased leading-none">
    <div id="app">
        {{ $slot }}
    </div>

    <!-- Scripts -->
    <livewire:scripts>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
</body>

</html>
