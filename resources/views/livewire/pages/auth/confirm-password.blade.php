<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('diary', absolute: false), navigate: true);
    }
}; ?>

<div class="space-y-6">
    <div class="text-center">
        <div class="mx-auto h-12 w-12 rounded-2xl bg-amber-600 text-white grid place-items-center shadow-sm shadow-amber-600/20">
            <i class="fas fa-shield-halved text-sm"></i>
        </div>
        <h1 class="mt-4 text-2xl font-extrabold text-stone-900 tracking-tight">
            {{ __('Confirm Password') }}
        </h1>
        <p class="mt-1 text-sm text-stone-600">
            {{ __('Please confirm your password to continue') }}
        </p>
    </div>

    <form wire:submit="confirmPassword" class="space-y-4">
        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password"
                          id="password"
                          class="block mt-1 w-full h-11 px-3 rounded-2xl"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center rounded-2xl py-3">
            {{ __('Confirm') }}
        </x-primary-button>
    </form>
</div>
