<div>
    <div class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-stone-600 mb-1">{{ __('Title') }}</label>
            <input wire:model="form.title"
                type="text" name="title" id="title"
                class="block w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
                required>
            @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div>
                <label for="proteins" class="block text-sm font-medium text-blue-600 mb-1">{{ __('Proteins') }}</label>
                <input wire:model="form.proteins"
                    type="number" min="0" name="proteins" id="proteins" step="0.01"
                    class="block w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
                    required>
                @error('proteins')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="fats" class="block text-sm font-medium text-orange-500 mb-1">{{ __('Fats') }}</label>
                <input wire:model="form.fats"
                    type="number" min="0" name="fats" id="fats" step="0.01"
                    class="block w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
                    required>
                @error('fats')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="carbohydrates" class="block text-sm font-medium text-emerald-600 mb-1">{{ __('Carbohydrates') }}</label>
                <input wire:model="form.carbohydrates"
                    type="number" min="0" name="carbohydrates" id="carbohydrates" step="0.01"
                    class="block w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
                    required>
                @error('carbohydrates')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="calories" class="block text-sm font-medium text-amber-600 mb-1">{{ __('Calories') }}</label>
                <input wire:model="form.calories"
                    type="number" min="0" name="calories" id="calories" step="0.01"
                    class="block w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
                    required>
                @error('calories')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-3 mt-6">
        <button wire:click.prevent="cancel" type="button"
                class="px-4 py-2 text-sm font-medium text-stone-600 bg-stone-100 hover:bg-stone-200 border border-stone-200 rounded-xl transition-colors">
            {{ __('Cancel') }}
        </button>
        <button wire:click.prevent="save" type="submit"
                class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 rounded-xl transition-colors shadow-sm">
            {{ __('Submit') }}
        </button>
    </div>
</div>
