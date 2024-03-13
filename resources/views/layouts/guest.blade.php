<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}"> --}}
    {{-- <link rel="manifest" href="{{ asset('img/site.webmanifest') }}"> --}}
    <title>Dashboard</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons/css/all.min.css">
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="{{ asset('css/styles.css?v=1.0.3') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <!-- PowerGrid Styles -->
    @livewireStyles

    @vite('resources/css/app.css')
    @stack('css')
</head>

<body class="bg-gray-50 dark:bg-gray-800 antialiased leading-none h-screen">
    <div id="app">
        {{ $slot }}
    </div>

    <!-- Scripts -->
    <!-- plugin for charts  -->
    <script src="{{ asset('js/plugins/chartjs.min.js') }}" async></script>
    <!-- plugin for scrollbar  -->

    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script src="{{ asset('js/perfect-scrollbar.js') }}" async></script>
    {{-- <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="{{ asset('js/soft-ui-dashboard-tailwind.js?v=1.0.3') }}" async></script>
    <!-- In your Blade template, include Leaflet CSS and JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script> --}}

    @vite('resources/js/app.js')
    @livewireScripts
    @stack('js')
</body>

</html>
