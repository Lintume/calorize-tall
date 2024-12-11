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

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="w-16 h-16 fill-current text-gray-500"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{__('welcome.statistic')}}
                    </x-nav-link>
                    <x-nav-link :href="route('diary')" :active="request()->routeIs('diary')" wire:navigate>
                        {{__('welcome.diary')}}
                    </x-nav-link>
                    <x-nav-link :href="route('product.create')" :active="request()->routeIs('product.create')"
                                wire:navigate>
                        {{__('welcome.createProduct')}}
                    </x-nav-link>
                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('products')" wire:navigate>
                        {{__('welcome.productList')}}
                    </x-nav-link>
                    <x-nav-link :href="route('recipe.create')" :active="request()->routeIs('createRecipe')"
                                wire:navigate>
                        {{__('welcome.createRecipe')}}
                    </x-nav-link>
                    <x-nav-link :href="route('recipe.index')" :active="request()->routeIs('recipes')" wire:navigate>
                        {{__('welcome.recipes')}}
                    </x-nav-link>
                    <x-nav-link :href="route('personal')" :active="request()->routeIs('personal')" wire:navigate>
                        {{__('welcome.personal')}}
                    </x-nav-link>
                </div>

            </div>

            <div class="flex">
                <!-- Language Switcher -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
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
                            <x-dropdown-link :href="route('switch-language', 'en')" wire:navigate>
                                English
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('switch-language', 'ua')" wire:navigate>
                                Українська
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
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
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{__('welcome.statistic')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('diary')" :active="request()->routeIs('diary')" wire:navigate>
                {{__('welcome.diary')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('product.create')" :active="request()->routeIs('createProduct')"
                                   wire:navigate>
                {{__('welcome.createProduct')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('product.index')" :active="request()->routeIs('products')" wire:navigate>
                {{__('welcome.productList')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('recipe.create')" :active="request()->routeIs('createRecipe')"
                                   wire:navigate>
                {{__('welcome.createRecipe')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('recipe.index')" :active="request()->routeIs('recipes')" wire:navigate>
                {{__('welcome.recipes')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('personal')" :active="request()->routeIs('personal')" wire:navigate>
                {{__('welcome.personal')}}
            </x-responsive-nav-link>
        </div>

        <!-- Language Switcher -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ __('welcome.language') }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('switch-language', 'en')" wire:navigate>
                    English
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('switch-language', 'ua')" wire:navigate>
                    Українська
                </x-responsive-nav-link>
            </div>
        </div>
        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800"
                         x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                         x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
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
