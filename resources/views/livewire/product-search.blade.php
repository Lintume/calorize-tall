<div>
    {{-- Search bar --}}
    <div class="relative">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"></i>
        <input
            type="text"
            placeholder="{{ __('Search...') }}"
            class="w-full pl-10 pr-10 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
            wire:model.live.debounce.500ms="search"
        />
        @if($search)
            <button type="button"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600"
                    wire:click="$set('search', '')">
                <i class="fas fa-times"></i>
            </button>
        @endif
    </div>
    <div class="text-red-500 text-sm mt-1">@error('search') {{ $message }} @enderror</div>

    {{-- Results --}}
    @if($products->isEmpty() || Str::length($search) === 0)
        <div class="mt-4 py-6 text-center text-stone-500 text-sm">
            @if($products->isEmpty())
                {{ __('No products found.') }}
            @endif
            @if(Str::length($search) === 0)
                {{ __('Start typing Product Name or') }}
            @endif
        </div>
        <div class="text-center">
            <button @click="createProductForm = true"
                    class="px-4 py-2 text-sm font-medium text-stone-600 bg-stone-100 hover:bg-stone-200 border border-stone-200 rounded-xl transition-colors">
                {{ __('Create Product') }}
            </button>
        </div>
    @else
        <div class="mt-3 overflow-x-auto">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="border-b border-stone-100">
                        <th class="px-2 py-2 text-left text-xs font-medium text-stone-500 uppercase">{{ __('Title') }}</th>
                        <th class="w-12 sm:w-14 px-1 py-2 text-center text-xs font-medium text-stone-400 uppercase">{{ __('Prot') }}</th>
                        <th class="w-12 sm:w-14 px-1 py-2 text-center text-xs font-medium text-stone-400 uppercase">{{ __('Fat') }}</th>
                        <th class="w-12 sm:w-14 px-1 py-2 text-center text-xs font-medium text-stone-400 uppercase">{{ __('Carb') }}</th>
                        <th class="w-14 sm:w-16 px-2 py-2 text-center text-xs font-medium text-stone-500 uppercase">{{ __('Kcal') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-50">
                    @foreach($products as $product)
                        <tr @click="$dispatch('select-product', '{{ addslashes($product) }}')"
                            wire:key="{{ $product->id }}"
                            class="cursor-pointer hover:bg-amber-50/50 transition-colors"
                        >
                            <td class="px-2 py-2.5 text-sm text-stone-700 truncate">{{ $product->title }}</td>
                            <td class="px-1 py-2 text-center text-sm text-stone-400">{{ $product->proteins }}</td>
                            <td class="px-1 py-2 text-center text-sm text-stone-400">{{ $product->fats }}</td>
                            <td class="px-1 py-2 text-center text-sm text-stone-400">{{ $product->carbohydrates }}</td>
                            <td class="px-2 py-2 text-center text-sm font-medium text-stone-600">{{ $product->calories }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
