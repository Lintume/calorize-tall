<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('meta')

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96"/>
        <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg"/>
        <link rel="shortcut icon" href="/favicon/favicon.ico"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png"/>
        <link rel="manifest" href="/favicon/site.webmanifest"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
            html, body {
                margin: 0;
                display: flex;
                flex-direction: column;
            }
            .content {
                flex: 1;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            <livewire:layout.navigation/>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="content">
                <div class="flex items-center justify-center">
                    <div class="w-full max-w-4xl px-4 sm:px-6 lg:px-8 ">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white shadow mt-auto">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-gray-500 text-sm">
                        &copy; {{ date('Y') }} <a href="https://www.linkedin.com/in/lialia-sakhno/">{{__('Lialia Sakhno') }}.</a> {{__('All rights reserved.') }}
                    </p>
                </div>
            </footer>
        </div>
        @livewireScripts
    </body>
</html>