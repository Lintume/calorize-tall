<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title', config('app.name'))
        </title>

        <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96"/>
        <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg"/>
        <link rel="shortcut icon" href="/favicon/favicon.ico"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png"/>
        <link rel="manifest" href="/favicon/site.webmanifest"/>
        <link rel="alternate" hreflang="uk" href="{{ LaravelLocalization::getLocalizedURL('uk') }}" />
        <link rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en') }}" />

        <!-- Підключення шрифту Inter із різною товщиною -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Manrope:wght@400..800&family=Inter:wght@400;500;600;700&family=Maven+Pro:wght@500;600;700&display=swap"
            rel="stylesheet"
            media="print"
            onload="this.media='all'"
        />
        <noscript>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400..800&family=Inter:wght@400;500;600;700&family=Maven+Pro:wght@500;600;700&display=swap" />
        </noscript>

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

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-3LXEJPCRR0"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-3LXEJPCRR0');
        </script>

        @yield('meta')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-stone-50 flex flex-col">
            <livewire:layout.navigation/>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white/50 backdrop-blur-sm border-b border-stone-200/60">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="content">
                @if (($fullWidth ?? false) === true)
                    {{ $slot }}
                @else
                    <div class="flex items-center justify-center">
                        <div class="w-full max-w-4xl px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                @endif
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-stone-200 mt-auto">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8
                flex flex-col md:flex-row items-center md:justify-between text-center">

                    <!-- Текст копірайту -->
                    <div>
                        <p class="text-stone-500 text-sm">
                            &copy; {{ date('Y') }}
                            <a href="hey@calorize.com.ua" class="hover:text-amber-700 transition-colors">
                                {{ __('Lialia') }}
                            </a> &
                            <a href="https://www.linkedin.com/in/ulianasakhnoqa/" class="hover:text-amber-700 transition-colors">
                                {{ __('Uliana') }}
                            </a>
                            {{ __('Sakhno') }}. {{ __('All rights reserved.') }}
                        </p>
                    </div>

                    <!-- Посилання -->
                    <div class="mt-3 md:mt-0">
                        <ul class="flex justify-center space-x-4 text-sm text-stone-500">
                            <li>
                                <a href="{{ route('about') }}" class="hover:text-amber-700 transition-colors">
                                    {{ __('About us') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('privacy') }}" class="hover:text-amber-700 transition-colors">
                                    {{ __('Privacy Policy') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
        @livewireScripts
    </body>
</html>
