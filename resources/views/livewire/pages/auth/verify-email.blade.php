<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('diary', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="space-y-6">
    <div class="text-center">
        <div class="mx-auto h-12 w-12 rounded-2xl bg-sky-600 text-white grid place-items-center shadow-sm shadow-sky-600/20">
            <i class="fas fa-envelope-open-text text-sm"></i>
        </div>
        <h1 class="mt-4 text-2xl font-extrabold text-stone-900 tracking-tight">
            {{ __('Verify Email') }}
        </h1>
        <p class="mt-1 text-sm text-stone-600">
            {{ __('Please verify your email to continue') }}
        </p>
    </div>

    <div class="text-sm text-stone-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 text-sm font-semibold">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <x-primary-button wire:click="sendVerification" class="w-full sm:w-auto justify-center rounded-2xl py-3">
            {{ __('Resend Verification Email') }}
        </x-primary-button>

        <button wire:click="logout" type="submit" class="text-sm text-stone-600 hover:text-amber-700 font-medium underline underline-offset-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
            {{ __('Log Out') }}
        </button>
    </div>
</div>
