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
                <div class="hidden md:flex md:items-center md:gap-2 xl:hidden">
                    <x-dropdown align="left" width="w-64">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg text-stone-600 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition">
                                <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                                </svg>
                                <span>{{ __('nav.group.tracking') }}</span>
                                <svg class="ms-1 h-4 w-4 text-stone-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('diary')" wire:navigate>
                                {{ __('welcome.diary') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('statistic')" wire:navigate>
                                {{ __('welcome.statistic') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-dropdown align="left" width="w-72">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg text-stone-600 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition">
                                <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h16"/>
                                </svg>
                                <span>{{ __('nav.group.catalog') }}</span>
                                <svg class="ms-1 h-4 w-4 text-stone-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('product.index')" wire:navigate>
                                {{ __('welcome.productList') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('recipe.index')" wire:navigate>
                                {{ __('welcome.recipes') }}
                            </x-dropdown-link>

                            <div class="my-1 border-t border-stone-200/70"></div>

                            <x-dropdown-link :href="route('product.create')" wire:navigate>
                                {{ __('Create Product') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('recipe.create')" wire:navigate>
                                {{ __('Create Recipe') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-dropdown align="left" width="w-64">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg text-stone-600 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition">
                                <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
                                </svg>
                                <span>{{ __('nav.group.more') }}</span>
                                <svg class="ms-1 h-4 w-4 text-stone-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('feedback')" wire:navigate>
                                {{ __('welcome.feedback') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('blog')" wire:navigate>
                                {{ __('Blog') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
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
                                <div>{{ __('welcome.language') }}</div>
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
                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition-colors">
                                English
                            </a>

                            <a href="{{ LaravelLocalization::getLocalizedURL('uk') }}" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition-colors">
                                Українська
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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
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
                            <x-dropdown-link :href="LaravelLocalization::getLocalizedURL('en')" wire:navigate>
                                English
                            </x-dropdown-link>
                            <x-dropdown-link :href="LaravelLocalization::getLocalizedURL('uk')" wire:navigate>
                                Українська
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-stone-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('statistic')" :active="request()->routeIs('statistic')" wire:navigate>
                {{__('welcome.statistic')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('diary')" :active="request()->routeIs('diary')" wire:navigate>
                {{__('welcome.diary')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('product.create')" :active="request()->routeIs('product.create')"
                                   wire:navigate>
                {{__('welcome.createProduct')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')"
                                   wire:navigate>
                {{__('welcome.productList')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('recipe.create')" :active="request()->routeIs('recipe.create')"
                                   wire:navigate>
                {{__('welcome.createRecipe')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('recipe.index')" :active="request()->routeIs('recipe.index')"
                                   wire:navigate>
                {{__('welcome.recipes')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('personal')" :active="request()->routeIs('personal')" wire:navigate>
                {{__('welcome.personal')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')" wire:navigate>
                {{__('Blog')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('feedback')" :active="request()->routeIs('feedback')" wire:navigate>
                {{__('welcome.feedback')}}
            </x-responsive-nav-link>
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
            @if (app()->getLocale() == 'uk')
                <x-responsive-nav-link :href="LaravelLocalization::getLocalizedURL('en')" wire:navigate>
                    <span class="inline-flex items-center">
                        <svg class="h-4 w-4 me-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M2 12h20"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        English
                    </span>
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="LaravelLocalization::getLocalizedURL('uk')" wire:navigate>
                    <span class="inline-flex items-center">
                        <svg class="h-4 w-4 me-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M2 12h20"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        Українська
                    </span>
                </x-responsive-nav-link>
            @endif
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
