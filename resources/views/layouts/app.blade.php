<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="{{ asset('css/styles.css?v=1.0.3') }}" rel="stylesheet" />
    <!-- PowerGrid Styles -->
    @livewireStyles

    @vite('resources/css/app.css')
    @stack('css')
</head>

<body class="m-0 font-sans antialiased font-normal text-size-base leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->
    <x-sidebar />

    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->


        @include('layouts.navigation')

        <!-- end Navbar -->

        <div class="mx-10 pb-8">
            {{ $slot }}
        </div>
    </main>
    <!-- plugin for charts  -->
    <script src="{{ asset('js/plugins/chartjs.min.js') }}" async></script>
    <!-- plugin for scrollbar  -->
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script src="{{ asset('js/perfect-scrollbar.js') }}" async></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="{{ asset('js/soft-ui-dashboard-tailwind.js?v=1.0.3') }}" async></script>
    @vite('resources/js/app.js')
    @livewireScripts

    @stack('js')
</body>

</html>
