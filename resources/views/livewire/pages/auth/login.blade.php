<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('diary', absolute: false), navigate: true);
    }
}; ?>

<div class="space-y-6">
    <div class="text-center">
        <div class="mx-auto h-12 w-12 rounded-2xl bg-stone-900 text-white grid place-items-center shadow-sm shadow-stone-900/15">
            <i class="fas fa-right-to-bracket text-sm"></i>
        </div>
        <h1 class="mt-4 text-2xl font-extrabold text-stone-900 tracking-tight">
            {{ __('Log in') }}
        </h1>
        <p class="mt-1 text-sm text-stone-600">
            {{ __('Welcome back') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800" :status="session('status')" />

    <form wire:submit="login" class="space-y-4">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full h-11 px-3 rounded-2xl" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full h-11 px-3 rounded-2xl"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4 pt-1">
            <!-- Remember Me -->
            <label for="remember" class="inline-flex items-center select-none">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-stone-300 text-amber-600 shadow-sm focus:ring-amber-500" name="remember">
                <span class="ms-2 text-sm text-stone-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-stone-600 hover:text-amber-700 font-medium underline underline-offset-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button
            type="submit"
            class="w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-stone-900 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 active:scale-[0.99] transition focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
        >
            {{ __('Log in') }}
        </button>
    </form>

    <div class="text-center">
        <span class="text-sm text-stone-600">{{ __("Don't have an account?") }}</span>
        <a class="text-sm text-amber-700 hover:text-amber-800 font-semibold ms-1" href="{{ route('register') }}" wire:navigate>
            {{ __('Register') }}
        </a>
    </div>
</div>
