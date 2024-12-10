<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <form action="{{ route('product.update', $product) }}" method="POST" class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
        @method('PUT')
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title') ?? $product->title }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
            @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="proteins" class="block text-sm font-medium text-gray-700">{{ __('Proteins') }}</label>
            <input type="number" name="proteins" id="proteins" value="{{ old('proteins') ?? $product->proteins }}" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
            @error('proteins')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="fats" class="block text-sm font-medium text-gray-700">{{ __('Fats') }}</label>
            <input type="number" name="fats" id="fats" value="{{ old('fats') ?? $product->fats }}" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
            @error('fats')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="carbohydrates" class="block text-sm font-medium text-gray-700">{{ __('Carbohydrates') }}</label>
            <input type="number" name="carbohydrates" id="carbohydrates" value="{{ old('carbohydrates') ?? $product->carbohydrates }}" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
            @error('carbohydrates')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="calories" class="block text-sm font-medium text-gray-700">{{ __('Calories') }}</label>
            <input type="number" name="calories" id="calories" value="{{ old('calories') ?? $product->calories }}" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
            @error('calories')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">{{ __('Submit') }}</button>
        </div>
    </form>
</x-app-layout>