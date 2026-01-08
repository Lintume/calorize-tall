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
                    <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" wire:navigate>
                        <x-application-logo class="w-8 md:w-10 fill-current text-stone-500 py-2"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-3 sm:flex">
                    <x-nav-link :href="route('statistic')" :active="request()->routeIs('statistic')" wire:navigate>
                        {{__('welcome.statistic')}}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
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
                </div>

            </div>

            <div class="flex">
                <!-- Language Switcher -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-stone-500 hover:text-amber-700 hover:bg-amber-50 focus:outline-none transition ease-in-out duration-150">
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

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">
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
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-stone-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('statistic')" :active="request()->routeIs('statistic')" wire:navigate>
                {{__('welcome.statistic')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
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
        </div>

        <!-- Language Switcher -->
        <div class="py-1 border-t border-stone-200">
            @if (app()->getLocale() == 'uk')
                <x-responsive-nav-link :href="LaravelLocalization::getLocalizedURL('en')" wire:navigate>
                    English
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="LaravelLocalization::getLocalizedURL('uk')" wire:navigate>
                    Українська
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
