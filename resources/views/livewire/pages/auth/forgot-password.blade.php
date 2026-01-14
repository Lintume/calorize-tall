<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="space-y-6">
    <div class="text-center">
        <div class="mx-auto h-12 w-12 rounded-2xl bg-sky-600 text-white grid place-items-center shadow-sm shadow-sky-600/20">
            <i class="fas fa-envelope text-sm"></i>
        </div>
        <h1 class="mt-4 text-2xl font-extrabold text-stone-900 tracking-tight">
            {{ __('Forgot password') }}
        </h1>
        <p class="mt-1 text-sm text-stone-600">
            {{ __('We’ll send you a reset link to your email') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="space-y-4">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full h-11 px-3 rounded-2xl" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center rounded-2xl py-3">
            {{ __('Email Password Reset Link') }}
        </x-primary-button>
    </form>
</div>
