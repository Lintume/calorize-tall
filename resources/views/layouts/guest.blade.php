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

        <!-- Fonts -->
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
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col bg-[radial-gradient(1200px_circle_at_20%_-10%,rgba(245,158,11,0.18),transparent_55%),radial-gradient(900px_circle_at_90%_10%,rgba(14,165,233,0.16),transparent_50%),linear-gradient(to_bottom,rgba(250,250,249,1),rgba(255,255,255,1))]">
            <livewire:layout.navigation/>
            <main class="flex-1 flex items-center justify-center px-4 py-10 sm:py-16">
                <div class="w-full sm:max-w-md">
                    <div class="rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                        <div class="px-5 py-4 border-b border-stone-200/70 bg-[radial-gradient(900px_circle_at_15%_-10%,rgba(245,158,11,0.14),transparent_55%),radial-gradient(700px_circle_at_90%_0%,rgba(14,165,233,0.10),transparent_55%),linear-gradient(to_bottom,rgba(255,255,255,0.8),rgba(255,255,255,0.8))]">
                            <a href="/" wire:navigate class="flex items-center gap-3">
                                <x-application-logo class="w-10 h-10 rounded-2xl shadow-sm" />
                                <span class="font-extrabold text-stone-900 tracking-tight">
                                    {{ config('app.name') }}
                                </span>
                            </a>
                        </div>

                        <div class="p-5 sm:p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-white/60 backdrop-blur border-t border-stone-200">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center md:justify-between text-center">
                    <div>
                        <p class="text-stone-500 text-sm">
                            &copy; {{ date('Y') }}
                            <a href="https://www.linkedin.com/in/lialia-sakhno-114436b8/" target="_blank" rel="noopener noreferrer" class="hover:text-amber-700 transition-colors">
                                {{ __('Lialia') }}
                            </a> &
                            <a href="https://www.linkedin.com/in/ulianasakhnoqa/" class="hover:text-amber-700 transition-colors">
                                {{ __('Uliana') }}
                            </a>
                            {{ __('Sakhno') }}. {{ __('All rights reserved.') }}
                        </p>
                    </div>

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
