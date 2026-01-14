<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

@php
    $currentLocale = (string) app()->getLocale();
    $targetLocale = $currentLocale === 'uk' ? 'en' : 'uk';

    // Show the switcher label in the *target* language (opposite to the active one).
    $languageLabel = $targetLocale === 'uk' ? 'Мова' : 'Language';
    $languageName = $targetLocale === 'uk' ? 'Українська' : 'English';
    $languageText = $languageLabel . ' — ' . $languageName;
@endphp

<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-stone-200/60 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-3">
                    <a href="{{ auth()->check() ? route('diary') : url('/') }}" wire:navigate>
                        <img
                            src="/favicon/favicon.svg"
                            onerror="this.onerror=null;this.src='/favicon/favicon-96x96.png';"
                            alt="Calorize"
                            class="w-8 h-8 md:w-9 md:h-9"
                        />
                    </a>
                </div>

                <!-- Navigation Links (desktop, full) -->
                <div class="hidden space-x-6 xl:-my-px xl:ms-3 xl:flex">
                    <x-nav-link :href="route('statistic')" :active="request()->routeIs('statistic')" wire:navigate>
                        {{__('welcome.statistic')}}
                    </x-nav-link>
                    <x-nav-link :href="route('diary')" :active="request()->routeIs('diary')" wire:navigate>
                        {{__('welcome.diary')}}
                    </x-nav-link>
                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')"
                                wire:navigate>
                        {{__('welcome.productList')}}
                    </x-nav-link>
                    <x-nav-link :href="route('recipe.index')" :active="request()->routeIs('recipe.index')"
                                wire:navigate>
                        {{__('welcome.recipes')}}
                    </x-nav-link>
                    <x-nav-link :href="route('feedback')" :active="request()->routeIs('feedback')"
                                wire:navigate>
                        {{__('welcome.feedback')}}
                    </x-nav-link>
                </div>

                <!-- Navigation Links (tablet, grouped) -->
                @php
                    $trackingActive = request()->routeIs('diary') || request()->routeIs('statistic');
                    $catalogActive = request()->routeIs('product.*') || request()->routeIs('recipe.*');
                    $moreActive = request()->routeIs('feedback') || request()->routeIs('blog');

                    $diaryItemActive = request()->routeIs('diary');
                    $statisticItemActive = request()->routeIs('statistic');

                    $productCreateActive = request()->routeIs('product.create');
                    $productListActive = request()->routeIs('product.*') && ! $productCreateActive;

                    $recipeCreateActive = request()->routeIs('recipe.create');
                    $recipeListActive = request()->routeIs('recipe.*') && ! $recipeCreateActive;

                    $feedbackItemActive = request()->routeIs('feedback');
                    $blogItemActive = request()->routeIs('blog');
                @endphp

                <div class="hidden md:flex md:items-center xl:hidden">
                    <div class="flex items-center gap-1 rounded-xl bg-white/60 backdrop-blur px-1 py-1">
                        <x-dropdown align="left" width="w-64" contentClasses="bg-white/95 backdrop-blur-md">
                            <x-slot name="trigger">
                                <button
                                    @class([
                                        'inline-flex items-center gap-2 px-3 py-2 text-sm font-semibold rounded-lg border transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500/30',
                                        'text-amber-800 bg-amber-50 border-amber-200/70 shadow-sm shadow-amber-900/5' => $trackingActive,
                                        'text-stone-600 bg-transparent border-transparent hover:text-stone-900 hover:bg-white/70 hover:border-stone-200/70' => ! $trackingActive,
                                    ])
                                >
                                    <svg class="h-4 w-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                                    </svg>
                                    <span>{{ __('nav.group.tracking') }}</span>
                                    <svg
                                        :class="open ? 'rotate-180 text-stone-500' : 'text-stone-400'"
                                        class="ms-1 h-4 w-4 transition-transform"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 pt-3 pb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-amber-500/10 text-amber-700">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                                            </svg>
                                        </span>
                                        <div class="text-xs font-semibold tracking-wide text-stone-500 uppercase">
                                            {{ __('nav.group.tracking') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="h-px bg-stone-200/70"></div>
                                <div class="py-1">
                                    <x-dropdown-link :href="route('diary')" :active="$diaryItemActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $diaryItemActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $diaryItemActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 4h8a2 2 0 012 2v14l-6-3-6 3V6a2 2 0 012-2z"/>
                                            </svg>
                                            <span>{{ __('welcome.diary') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('statistic')" :active="$statisticItemActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $statisticItemActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $statisticItemActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m5 14V9m5 10V4m5 15v-7"/>
                                            </svg>
                                            <span>{{ __('welcome.statistic') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>

                        <x-dropdown align="left" width="w-72" contentClasses="bg-white/95 backdrop-blur-md">
                            <x-slot name="trigger">
                                <button
                                    @class([
                                        'inline-flex items-center gap-2 px-3 py-2 text-sm font-semibold rounded-lg border transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500/30',
                                        'text-amber-800 bg-amber-50 border-amber-200/70 shadow-sm shadow-amber-900/5' => $catalogActive,
                                        'text-stone-600 bg-transparent border-transparent hover:text-stone-900 hover:bg-white/70 hover:border-stone-200/70' => ! $catalogActive,
                                    ])
                                >
                                    <svg class="h-4 w-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h16"/>
                                    </svg>
                                    <span>{{ __('nav.group.catalog') }}</span>
                                    <svg
                                        :class="open ? 'rotate-180 text-stone-500' : 'text-stone-400'"
                                        class="ms-1 h-4 w-4 transition-transform"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 pt-3 pb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-amber-500/10 text-amber-700">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h16"/>
                                            </svg>
                                        </span>
                                        <div class="text-xs font-semibold tracking-wide text-stone-500 uppercase">
                                            {{ __('nav.group.catalog') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="h-px bg-stone-200/70"></div>

                                <div class="py-1">
                                    <x-dropdown-link :href="route('product.index')" :active="$productListActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $productListActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $productListActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4v10l8 4 8-4V7z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 22V12"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8 5-8-5"/>
                                            </svg>
                                            <span>{{ __('welcome.productList') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('recipe.index')" :active="$recipeListActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $recipeListActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $recipeListActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                                            </svg>
                                            <span>{{ __('welcome.recipes') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                </div>

                                <div class="my-1 border-t border-stone-200/70"></div>

                                <div class="px-4 pt-2 pb-1 text-[11px] font-semibold tracking-wide text-stone-500 uppercase">
                                    {{ __('nav.group.actions') }}
                                </div>
                                <div class="py-1">
                                    <x-dropdown-link :href="route('product.create')" :active="$productCreateActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $productCreateActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $productCreateActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                                            </svg>
                                            <span>{{ __('Create Product') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('recipe.create')" :active="$recipeCreateActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $recipeCreateActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $recipeCreateActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                                            </svg>
                                            <span>{{ __('Create Recipe') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>

                        <x-dropdown align="left" width="w-64" contentClasses="bg-white/95 backdrop-blur-md">
                            <x-slot name="trigger">
                                <button
                                    @class([
                                        'inline-flex items-center gap-2 px-3 py-2 text-sm font-semibold rounded-lg border transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500/30',
                                        'text-amber-800 bg-amber-50 border-amber-200/70 shadow-sm shadow-amber-900/5' => $moreActive,
                                        'text-stone-600 bg-transparent border-transparent hover:text-stone-900 hover:bg-white/70 hover:border-stone-200/70' => ! $moreActive,
                                    ])
                                >
                                    <svg class="h-4 w-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
                                    </svg>
                                    <span>{{ __('nav.group.more') }}</span>
                                    <svg
                                        :class="open ? 'rotate-180 text-stone-500' : 'text-stone-400'"
                                        class="ms-1 h-4 w-4 transition-transform"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 pt-3 pb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-amber-500/10 text-amber-700">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
                                            </svg>
                                        </span>
                                        <div class="text-xs font-semibold tracking-wide text-stone-500 uppercase">
                                            {{ __('nav.group.more') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="h-px bg-stone-200/70"></div>
                                <div class="py-1">
                                    <x-dropdown-link :href="route('feedback')" :active="$feedbackItemActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $feedbackItemActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $feedbackItemActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a4 4 0 01-4 4H7l-4 3V7a4 4 0 014-4h10a4 4 0 014 4v8z"/>
                                            </svg>
                                            <span>{{ __('welcome.feedback') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('blog')" :active="$blogItemActive" wire:navigate class="group">
                                        <span class="flex items-center gap-2">
                                            <svg @class([
                                                'h-4 w-4',
                                                'text-amber-600' => $blogItemActive,
                                                'text-stone-400 group-hover:text-amber-600' => ! $blogItemActive,
                                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19a2 2 0 002 2h12a2 2 0 002-2V7l-6-4H6a2 2 0 00-2 2v14z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 11h8M8 15h8"/>
                                            </svg>
                                            <span>{{ __('Blog') }}</span>
                                        </span>
                                    </x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

            </div>

            <div class="flex">
                <!-- Install App Button (PWA) - Desktop (Android/Chrome) -->
                <div
                    x-data="{ canInstall: false }"
                    x-init="
                        canInstall = window.isInstallPromptAvailable ? window.isInstallPromptAvailable() : false;
                        window.addEventListener('pwa-install-available', () => canInstall = true);
                        window.addEventListener('pwa-installed', () => canInstall = false);
                    "
                    x-show="canInstall"
                    x-cloak
                    class="hidden xl:flex xl:items-center"
                >
                    <button
                        @click="window.showInstallPrompt && window.showInstallPrompt()"
                        class="inline-flex items-center px-3 py-2 border border-amber-200 text-sm leading-4 font-medium rounded-lg text-amber-700 bg-amber-50 hover:bg-amber-100 hover:border-amber-300 focus:outline-none transition ease-in-out duration-150"
                    >
                        <svg class="h-4 w-4 me-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        {{ __('Install App') }}
                    </button>
                </div>

                <!-- iOS Install Hint - Desktop -->
                <div
                    x-data="{ showHint: false }"
                    x-init="
                        showHint = window.shouldShowIOSInstallHint ? window.shouldShowIOSInstallHint() : false;
                        window.addEventListener('pwa-install-available', () => showHint = false);
                    "
                    x-show="showHint"
                    x-cloak
                    class="hidden xl:flex xl:items-center"
                >
                    <x-dropdown align="right" width="72">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-amber-200 text-sm leading-4 font-medium rounded-lg text-amber-700 bg-amber-50 hover:bg-amber-100 hover:border-amber-300 focus:outline-none transition ease-in-out duration-150">
                                <svg class="h-4 w-4 me-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                {{ __('Install App') }}
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 py-3">
                                <p class="text-sm text-stone-700 mb-2">{{ __('ios_install.instruction') }}</p>
                                <ol class="text-sm text-stone-600 space-y-1 list-decimal list-inside">
                                    <li>{{ __('ios_install.step1') }}</li>
                                    <li>{{ __('ios_install.step2') }}</li>
                                </ol>
                                <button
                                    @click="window.dismissIOSInstallHint && window.dismissIOSInstallHint(); showHint = false"
                                    class="mt-3 text-xs text-stone-400 hover:text-stone-600"
                                >
                                    {{ __('ios_install.dismiss') }}
                                </button>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Language Switcher (desktop) -->
                <div class="hidden xl:flex xl:items-center xl:ms-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-stone-500 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition ease-in-out duration-150">
                                <svg class="h-4 w-4 me-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M2 12h20"/>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                </svg>
                                <div>{{ $languageLabel }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale) }}" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition-colors">
                                {{ $languageName }}
                            </a>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Settings Dropdown (desktop) -->
                <div class="hidden xl:flex xl:items-center">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-stone-500 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition ease-in-out duration-150">
                                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                         x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>

                                <x-dropdown-link :href="route('personal')" wire:navigate>
                                    {{ __('welcome.personal') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <x-nav-link :href="route('login')" wire:navigate>
                            {{ __('auth.login') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" wire:navigate>
                            {{ __('auth.register') }}
                        </x-nav-link>
                    @endauth
                </div>

                <!-- Tablet Actions Dropdown (language/install/auth) -->
                <div class="hidden md:flex md:items-center xl:hidden md:ms-2">
                    <x-dropdown align="right" width="w-72">
                        <x-slot name="trigger">
                            <button aria-label="{{ __('nav.group.actions') }}"
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg text-stone-600 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="12" cy="12" r="3"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 pt-3 pb-2 text-xs font-semibold text-stone-400 uppercase tracking-wide">
                                {{ __('nav.group.actions') }}
                            </div>

                            <!-- Install App Button (PWA) -->
                            <div
                                class="px-2 pb-2"
                                x-data="{ canInstall: false }"
                                x-init="
                                    canInstall = window.isInstallPromptAvailable ? window.isInstallPromptAvailable() : false;
                                    window.addEventListener('pwa-install-available', () => canInstall = true);
                                    window.addEventListener('pwa-installed', () => canInstall = false);
                                "
                                x-show="canInstall"
                                x-cloak
                            >
                                <button
                                    @click="window.showInstallPrompt && window.showInstallPrompt()"
                                    class="w-full inline-flex items-center px-3 py-2 border border-amber-200 text-sm font-medium rounded-lg text-amber-700 bg-amber-50 hover:bg-amber-100 hover:border-amber-300 focus:outline-none transition"
                                >
                                    <svg class="h-4 w-4 me-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    {{ __('Install App') }}
                                </button>
                            </div>

                            <div class="my-1 border-t border-stone-200/70"></div>

                            <!-- Language -->
                            <x-dropdown-link :href="LaravelLocalization::getLocalizedURL($targetLocale)" wire:navigate>
                                {{ $languageText }}
                            </x-dropdown-link>

                            <div class="my-1 border-t border-stone-200/70"></div>

                            <!-- Auth -->
                            @auth
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('personal')" wire:navigate>
                                    {{ __('welcome.personal') }}
                                </x-dropdown-link>
                                <button wire:click="logout" class="w-full text-start">
                                    <span class="block w-full px-4 py-2 text-start text-sm leading-5 text-stone-700 hover:bg-amber-50 hover:text-amber-700 focus:outline-none focus:bg-amber-50 transition duration-150 ease-in-out">
                                        {{ __('Log Out') }}
                                    </span>
                                </button>
                            @else
                                <x-dropdown-link :href="route('login')" wire:navigate>
                                    {{ __('auth.login') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('register')" wire:navigate>
                                    {{ __('auth.register') }}
                                </x-dropdown-link>
                            @endauth
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center md:hidden">
                <button x-cloak
                        aria-label="{{ __('Open main menu') }}"
                        @click="open = ! open"
                        class="
            inline-flex items-center justify-center p-2
            rounded-lg
            text-amber-700
            hover:bg-amber-100
            hover:text-amber-900
            transition
            duration-150
            ease-in-out
        "
                >
                    <svg
                        class="h-6 w-6 transform transition-transform duration-300"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                        :class="{ 'rotate-180': open }"
                    >
                        <!-- Гамбургер -->
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                            :class="[
                    open ? 'opacity-0 scale-75' : 'opacity-100 scale-100',
                    'transition-all duration-300 origin-center'
                ]"
                        />
                        <!-- Хрестик -->
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                            :class="[
                    open ? 'opacity-100 scale-100' : 'opacity-0 scale-75',
                    'transition-all duration-300 origin-center'
                ]"
                        />
                    </svg>
                </button>
            </div>


        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
        id="mobile-menu"
        :class="{'block': open, 'hidden': ! open}"
        class="hidden md:hidden bg-white/95 backdrop-blur-md border-t border-stone-100 max-h-[calc(100dvh-4rem)] overflow-y-auto overscroll-contain"
    >
        <!-- Main nav (mobile) -->
        <div class="pt-3 pb-2">
            <div class="px-4 pb-1 text-[11px] font-semibold tracking-wide text-stone-400 uppercase">
                {{ __('nav.group.tracking') }}
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('diary')" :active="$diaryItemActive" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => $diaryItemActive,
                            'text-stone-400 group-hover:text-amber-600' => ! $diaryItemActive,
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 4h8a2 2 0 012 2v14l-6-3-6 3V6a2 2 0 012-2z"/>
                        </svg>
                        {{ __('welcome.diary') }}
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('statistic')" :active="$statisticItemActive" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => $statisticItemActive,
                            'text-stone-400 group-hover:text-amber-600' => ! $statisticItemActive,
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5m5 14V9m5 10V4m5 15v-7"/>
                        </svg>
                        {{ __('welcome.statistic') }}
                    </span>
                </x-responsive-nav-link>
            </div>
        </div>

        <div class="my-1 border-t border-stone-200/70"></div>

        <div class="py-2">
            <div class="px-4 pb-1 text-[11px] font-semibold tracking-wide text-stone-400 uppercase">
                {{ __('nav.group.catalog') }}
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('product.index')" :active="$productListActive" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => $productListActive,
                            'text-stone-400 group-hover:text-amber-600' => ! $productListActive,
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4v10l8 4 8-4V7z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22V12"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8 5-8-5"/>
                        </svg>
                        {{ __('welcome.productList') }}
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('recipe.index')" :active="$recipeListActive" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => $recipeListActive,
                            'text-stone-400 group-hover:text-amber-600' => ! $recipeListActive,
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                        </svg>
                        {{ __('welcome.recipes') }}
                    </span>
                </x-responsive-nav-link>
            </div>

            <div class="mt-2 px-4 pb-1 text-[11px] font-semibold tracking-wide text-stone-400 uppercase">
                {{ __('nav.group.actions') }}
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('product.create')" :active="$productCreateActive" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => $productCreateActive,
                            'text-stone-400 group-hover:text-amber-600' => ! $productCreateActive,
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                        </svg>
                        {{ __('welcome.createProduct') }}
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('recipe.create')" :active="$recipeCreateActive" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => $recipeCreateActive,
                            'text-stone-400 group-hover:text-amber-600' => ! $recipeCreateActive,
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                        </svg>
                        {{ __('welcome.createRecipe') }}
                    </span>
                </x-responsive-nav-link>
            </div>
        </div>

        <div class="my-1 border-t border-stone-200/70"></div>

        <div class="py-2">
            <div class="px-4 pb-1 text-[11px] font-semibold tracking-wide text-stone-400 uppercase">
                {{ __('welcome.personal') }}
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('personal')" :active="request()->routeIs('personal')" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => request()->routeIs('personal'),
                            'text-stone-400 group-hover:text-amber-600' => ! request()->routeIs('personal'),
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11a4 4 0 100-8 4 4 0 000 8z"/>
                        </svg>
                        {{ __('welcome.personal') }}
                    </span>
                </x-responsive-nav-link>
            </div>
        </div>

        <div class="my-1 border-t border-stone-200/70"></div>

        <div class="py-2">
            <div class="px-4 pb-1 text-[11px] font-semibold tracking-wide text-stone-400 uppercase">
                {{ __('nav.group.more') }}
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => request()->routeIs('blog'),
                            'text-stone-400 group-hover:text-amber-600' => ! request()->routeIs('blog'),
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19a2 2 0 002 2h12a2 2 0 002-2V7l-6-4H6a2 2 0 00-2 2v14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 11h8M8 15h8"/>
                        </svg>
                        {{ __('Blog') }}
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('feedback')" :active="request()->routeIs('feedback')" wire:navigate class="group">
                    <span class="inline-flex items-center gap-2">
                        <svg @class([
                            'h-4 w-4',
                            'text-amber-600' => request()->routeIs('feedback'),
                            'text-stone-400 group-hover:text-amber-600' => ! request()->routeIs('feedback'),
                        ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a4 4 0 01-4 4H7l-4 3V7a4 4 0 014-4h10a4 4 0 014 4v8z"/>
                        </svg>
                        {{ __('welcome.feedback') }}
                    </span>
                </x-responsive-nav-link>
            </div>
        </div>

        <!-- Install App Button (PWA) - Android/Chrome -->
        <div
            x-data="{ canInstall: false }"
            x-init="
                canInstall = window.isInstallPromptAvailable ? window.isInstallPromptAvailable() : false;
                window.addEventListener('pwa-install-available', () => canInstall = true);
                window.addEventListener('pwa-installed', () => canInstall = false);
            "
            x-show="canInstall"
            x-cloak
            class="py-1 border-t border-stone-200"
        >
            <button
                @click="window.showInstallPrompt && window.showInstallPrompt()"
                class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-amber-600 hover:text-amber-800 hover:bg-amber-50 hover:border-amber-300 focus:outline-none focus:text-amber-800 focus:bg-amber-50 focus:border-amber-300 transition duration-150 ease-in-out"
            >
                <span class="inline-flex items-center">
                    <svg class="h-4 w-4 me-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    {{ __('Install App') }}
                </span>
            </button>
        </div>

        <!-- iOS Install Hint - Mobile -->
        <div
            x-data="{ showHint: false, expanded: false }"
            x-init="
                showHint = window.shouldShowIOSInstallHint ? window.shouldShowIOSInstallHint() : false;
                window.addEventListener('pwa-install-available', () => showHint = false);
            "
            x-show="showHint"
            x-cloak
            class="py-1 border-t border-stone-200"
        >
            <button
                @click="expanded = !expanded"
                class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-amber-600 hover:text-amber-800 hover:bg-amber-50 hover:border-amber-300 focus:outline-none transition duration-150 ease-in-out"
            >
                <span class="inline-flex items-center">
                    <svg class="h-4 w-4 me-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    {{ __('Install App') }}
                    <svg class="h-4 w-4 ms-1 transition-transform" :class="{ 'rotate-180': expanded }" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </button>
            <div x-show="expanded" x-collapse class="px-4 py-3 bg-amber-50/50">
                <p class="text-sm text-stone-700 mb-2">{{ __('ios_install.instruction') }}</p>
                <ol class="text-sm text-stone-600 space-y-1 list-decimal list-inside">
                    <li>{{ __('ios_install.step1') }}</li>
                    <li>{{ __('ios_install.step2') }}</li>
                </ol>
                <button
                    @click="window.dismissIOSInstallHint && window.dismissIOSInstallHint(); showHint = false"
                    class="mt-3 text-xs text-stone-400 hover:text-stone-600"
                >
                    {{ __('ios_install.dismiss') }}
                </button>
            </div>
        </div>

        <!-- Language Switcher -->
        <div class="py-1 border-t border-stone-200">
            <x-responsive-nav-link :href="LaravelLocalization::getLocalizedURL($targetLocale)" wire:navigate>
                <span class="inline-flex items-center">
                    <svg class="h-4 w-4 me-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M2 12h20"/>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                    </svg>
                    {{ $languageText }}
                </span>
            </x-responsive-nav-link>
        </div>
        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-stone-200">
                <div class="px-4">
                    <div class="font-medium text-base text-stone-800"
                         x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                         x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-stone-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @else
            <x-responsive-nav-link :href="route('login')" wire:navigate>
                {{ __('auth.login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')" wire:navigate>
                {{ __('auth.register') }}
            </x-responsive-nav-link>
        @endauth
    </div>
</nav>
