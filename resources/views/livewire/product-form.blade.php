<div>
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
        <input wire:model="form.title"
            type="text" name="title" id="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        @error('title')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="proteins" class="block text-sm font-medium text-gray-700">{{ __('Proteins') }}</label>
        <input wire:model="form.proteins"
            type="number" name="proteins" id="proteins" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        @error('proteins')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="fats" class="block text-sm font-medium text-gray-700">{{ __('Fats') }}</label>
        <input wire:model="form.fats"
            type="number" name="fats" id="fats" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        @error('fats')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="carbohydrates" class="block text-sm font-medium text-gray-700">{{ __('Carbohydrates') }}</label>
        <input wire:model="form.carbohydrates"
            type="number" name="carbohydrates" id="carbohydrates" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        @error('carbohydrates')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="calories" class="block text-sm font-medium text-gray-700">{{ __('Calories') }}</label>
        <input wire:model="form.calories"
            type="number" name="calories" id="calories" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        @error('calories')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex justify-end mt-7">
        <x-secondary-button wire:click.prevent="cancel" type="button" class="mr-3">{{ __('Cancel') }}</x-secondary-button>
        <x-primary-button wire:click.prevent="save" type="submit">{{ __('Submit') }}</x-primary-button>
    </div>
</div>