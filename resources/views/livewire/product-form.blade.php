<div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
    <div class="px-4 py-3 flex items-center justify-between gap-3 border-b border-stone-200/70 bg-[radial-gradient(700px_circle_at_15%_-40%,rgba(245,158,11,0.15),transparent_55%),radial-gradient(500px_circle_at_90%_-20%,rgba(59,130,246,0.12),transparent_55%),linear-gradient(to_bottom,rgba(255,255,255,0.9),rgba(255,255,255,0.9))]">
        <div class="flex items-center gap-3">
            <div class="h-11 w-11 rounded-2xl grid place-items-center bg-amber-100 text-amber-700 border border-amber-200 shadow-inner shadow-amber-900/5">
                <i class="fas fa-plus text-sm"></i>
            </div>
            <div>
                <div class="text-sm font-extrabold text-stone-900">{{ __('Create Product') }}</div>
                <div class="text-xs text-stone-600">{{ __('Nutrition per 100 g') }}</div>
            </div>
        </div>
        <span class="px-3 py-1.5 rounded-xl text-[11px] font-semibold uppercase tracking-wide bg-amber-100 text-amber-800 border border-amber-200 shadow-inner shadow-amber-900/5">
            100 g
        </span>
    </div>

    <div class="p-4 sm:p-5 space-y-4">
        <div class="space-y-2">
            <label for="title" class="block text-[12px] font-semibold text-stone-600 uppercase tracking-wide">{{ __('Title') }}</label>
            <div class="relative">
                <i class="fas fa-tag absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"></i>
                <input
                    wire:model="form.title"
                    type="text"
                    name="title"
                    id="title"
                    placeholder="{{ __('Add product name') }}"
                    class="block w-full h-11 pl-10 pr-3 rounded-xl border border-stone-200 bg-white text-sm text-stone-800 shadow-inner shadow-stone-900/5 focus:border-amber-500 focus:ring-amber-500 transition"
                    required
                >
            </div>
            @error('title')
                <p class="text-red-600 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="p-3 rounded-xl border border-stone-200 bg-stone-50/70 shadow-inner shadow-stone-900/5">
                <div class="flex items-center justify-between">
                    <label for="proteins" class="text-[11px] font-semibold uppercase tracking-wide text-sky-700">{{ __('Proteins') }}</label>
                    <span class="px-2 py-0.5 rounded-lg text-[10px] font-semibold bg-sky-100 text-sky-800 border border-sky-200">g</span>
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <i class="fas fa-egg text-sky-500"></i>
                    <input
                        wire:model="form.proteins"
                        type="number"
                        min="0"
                        name="proteins"
                        id="proteins"
                        step="0.01"
                        class="w-full h-10 px-3 rounded-lg border border-stone-200 bg-white text-sm focus:border-amber-500 focus:ring-amber-500 transition"
                        required
                    >
                </div>
                @error('proteins')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-3 rounded-xl border border-stone-200 bg-stone-50/70 shadow-inner shadow-stone-900/5">
                <div class="flex items-center justify-between">
                    <label for="fats" class="text-[11px] font-semibold uppercase tracking-wide text-amber-700">{{ __('Fats') }}</label>
                    <span class="px-2 py-0.5 rounded-lg text-[10px] font-semibold bg-amber-100 text-amber-800 border border-amber-200">g</span>
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <i class="fas fa-cheese text-amber-500"></i>
                    <input
                        wire:model="form.fats"
                        type="number"
                        min="0"
                        name="fats"
                        id="fats"
                        step="0.01"
                        class="w-full h-10 px-3 rounded-lg border border-stone-200 bg-white text-sm focus:border-amber-500 focus:ring-amber-500 transition"
                        required
                    >
                </div>
                @error('fats')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-3 rounded-xl border border-stone-200 bg-stone-50/70 shadow-inner shadow-stone-900/5">
                <div class="flex items-center justify-between">
                    <label for="carbohydrates" class="text-[11px] font-semibold uppercase tracking-wide text-emerald-700">{{ __('Carbohydrates') }}</label>
                    <span class="px-2 py-0.5 rounded-lg text-[10px] font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">g</span>
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <i class="fas fa-bread-slice text-emerald-500"></i>
                    <input
                        wire:model="form.carbohydrates"
                        type="number"
                        min="0"
                        name="carbohydrates"
                        id="carbohydrates"
                        step="0.01"
                        class="w-full h-10 px-3 rounded-lg border border-stone-200 bg-white text-sm focus:border-amber-500 focus:ring-amber-500 transition"
                        required
                    >
                </div>
                @error('carbohydrates')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-3 rounded-xl border border-stone-200 bg-stone-50/70 shadow-inner shadow-stone-900/5">
                <div class="flex items-center justify-between">
                    <label for="calories" class="text-[11px] font-semibold uppercase tracking-wide text-amber-800">{{ __('Calories') }}</label>
                    <span class="px-2 py-0.5 rounded-lg text-[10px] font-semibold bg-amber-600/10 text-amber-800 border border-amber-200">kcal</span>
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <i class="fas fa-fire text-amber-600"></i>
                    <input
                        wire:model="form.calories"
                        type="number"
                        min="0"
                        name="calories"
                        id="calories"
                        step="0.01"
                        class="w-full h-10 px-3 rounded-lg border border-stone-200 bg-white text-sm focus:border-amber-500 focus:ring-amber-500 transition"
                        required
                    >
                </div>
                @error('calories')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="px-4 py-3 flex items-center justify-end gap-3 border-t border-stone-100 bg-stone-50/80">
        <button
            wire:click.prevent="cancel"
            type="button"
            class="h-11 px-4 rounded-xl border border-stone-200 bg-white text-sm font-semibold text-stone-700 hover:bg-stone-100 active:scale-[0.99] transition"
        >
            {{ __('Cancel') }}
        </button>
        <button
            wire:click.prevent="save"
            type="submit"
            class="h-11 px-5 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 text-sm font-semibold text-white shadow-lg shadow-amber-700/20 hover:from-amber-700 hover:to-amber-800 active:scale-[0.99] transition"
        >
            <i class="fas fa-check mr-2 text-xs"></i>{{ __('Submit') }}
        </button>
    </div>
</div>
