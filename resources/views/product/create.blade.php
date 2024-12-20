<x-app-layout>
    @section('title', __('Create Product'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
        <livewire:product-create/>
    </div>


    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('productAdded', () => {
                window.location = '{{ route('product.index') }}';
            });
            Livewire.on('productCreateCancelled', () => {
                window.location = '{{ route('product.index') }}';
            });
        });
    </script>

</x-app-layout>