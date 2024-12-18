<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
        <livewire:product-update :product="$product"/>
    </div>
</x-app-layout>