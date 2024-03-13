<!DOCTYPE html>
<html>

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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons/css/all.min.css">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css?v=1.0.3') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <!-- PowerGrid Styles -->
    @livewireStyles

    @vite('resources/css/app.css')
    @stack('css')
</head>

<body data-theme="light"
    class="m-0 font-sans antialiased font-normal text-size-base leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->

    <x-sidebar />


    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative rounded-xl h-screen transition-all duration-200">
        <!-- Navbar -->


        @include('layouts.navigation')

        <!-- end Navbar -->

        <div class="mx-2 xl:mx-10 pb-8">
            {{ $slot }}
        </div>
    </main>

    <script src="{{ asset('js/plugins/chartjs.min.js') }}" async></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script src="{{ asset('js/perfect-scrollbar.js') }}" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="{{ asset('js/soft-ui-dashboard-tailwind.js?v=1.0.3') }}" async></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
    @livewireScripts
    @stack('js')
</body>

</html>
