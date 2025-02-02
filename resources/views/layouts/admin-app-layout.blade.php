<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Helpers\Formats::title() }}｜車検・点検整備のWEB予約ページ｜キムラユニティーグループ</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" sizes="114x114" href="{{ Vite::asset('resources/img/main/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- jQuery & jQuery UI --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css"
        integrity="sha512-TFee0335YRJoyiqz8hA8KV3P0tXa5CpRBSoM0Wnkn7JoJx1kaq1yXL/rb8YFpWXkMOjRcv5txv+C6UluttluCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js"
        integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.css"
        integrity="sha512-Xxs33QtURTKyRJi+DQ7EKwWzxpDlLSqjC7VYwbdWW9zdhrewgsHoim8DclqjqMlsMeiqgAi51+zuamxdEP2v1Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.all.min.js"
        integrity="sha512-m4zOGknNg3h+mK09EizkXi9Nf7B3zwsN9ow+YkYIPZoA6iX2vSzLezg4FnW0Q6Z1CPaJdwgUFQ3WSAUC4E/5Hg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/beta.css', 'resources/js/app.js', 'resources/js/modules/datepicker.js', 'resources/js/modules/dashboard.js', 'resources/js/modules/keyboard.js'])
    <script src="{{ Vite::asset('resources/js/modules/base.js') }}"></script>

</head>

<body class="wait-for-icons relative font-sans antialiased text-base">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" x-data="navi()"
        :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('includes.desktop-sidebar')

        <!-- Mobile sidebar -->
        @include('includes.mobile-sidebar')

        <div class="flex flex-col flex-1 w-full min-w-0">
            @include('includes.header')
            <main class="h-full overflow-hidden">
                {{ $slot }}
            </main>
        </div>
    </div>

    @include('modules.loading-screen')
    @stack('modals')
    @stack('scripts')
    <script src="{{ Vite::asset('resources/js/modules/admin/navi.js') }}"></script>
</body>

</html>
