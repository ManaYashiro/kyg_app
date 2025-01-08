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

    {{-- Full Calendar --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    @yield('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/beta.css', 'resources/css/hamburger.css', 'resources/js/app.js', 'resources/js/modules/datepicker.js', 'resources/css/top.css'])
    <script src="{{ Vite::asset('resources/js/modules/base.js') }}"></script>
</head>

<body class="wait-for-icons relative bg-customgray-200 font-sans antialiased text-base">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')
        @if (Route::current()->getName() === 'top')
            <section class="banner flex flex-col md:flex-row mx-auto max-w-7xl">
                <div class="h-full max-h-72 flex">
                    <div class="text-content w-full h-1/5 md:w-2/6  md:h-auto relative">
                        <div class="text-container mobi-container md:desktop-container">
                            <h1 class="text-base sm:text-xl md:text-2xl lg:text-4xl md:mb-6">KIMURA UNITY
                                GROUP</h1>
                            <div class="w-[85%]">
                                <div class="flex flex-col mt-3 md:mt-0 md:hidden text-xxs xsm:text-xs">
                                    <span class="">キムラユニティーグループの</span>
                                    <span class="">WEB予約ページへようこそ。</span>
                                </div>
                                <div class="hidden md:block text-sm lg:text-lg mb-[1rem]">
                                    <span class="inline-block">キムラユニティーグループの</span>
                                    <span class="inline-block">WEB予約ページへようこそ。</span>
                                </div>
                            </div>
                            <div class="scroll-indicator hidden md:inline-block">
                                <img src="{{ Vite::asset('resources/img/top/scroll.png') }}" alt="スクロール"
                                    id="scrollbar" class="scroll w-4">
                            </div>
                        </div>
                    </div>
                    <div class="image-content w-full h-4/5 md:w-4/6 md:h-auto">
                        <img src="{{ Vite::asset('resources/img/top/top.png') }}" alt="タイトル"
                            class="mobi-polygon md:desktop-polygon banner-aspect w-full h-full">
                    </div>
                </div>
            </section>
        @endif
        <!-- Page Content -->
        <div class="min-h-full h-full w-full max-w-7xl mx-auto flex-1 relative">
            <div class="w-full mx-auto px-4 pt-2 pb-8 bg-white shadow-md ">
                {{ $slot }}
            </div>
        </div>
        @include('layouts.footer')
    </div>

    @include('modules.loading-screen')
    @include('modules.scroll-up')
    @stack('modals')
    @stack('scripts')
</body>

</html>
