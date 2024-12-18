<div>
    <!-- Search bar -->
    <div class="mt-5 mb-5 md:mt-10">
        <div class="mt-5 mb-5 md:mt-10 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input
                type="text"
                placeholder="{{ __('Search...') }}"
                class="w-full p-2 pl-10 pr-10 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                wire:model.live.debounce.500ms="search"
            />
            @if($search)
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button" class="text-gray-400 hover:text-gray-600"
                            wire:click="$set('search', '')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            <div class="text-red-600">@error('search') {{ $message }} @enderror</div>
        </div>
    </div>
    <!-- Table results -->
    @if($products->isEmpty() ||  Str::length($search) === 0)
        <div class="mt-5 text-center">
            @if($products->isEmpty())
                {{ __('No products found.') }}
            @endif
            @if(Str::length($search) === 0)
                {{ __('Start typing Product Name or') }}
            @endif
        </div>
        <div class="text-center mt-2">
            <x-secondary-button @click="createProductForm = true">
                {{ __('Create Product') }}
            </x-secondary-button>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                        <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Prot') }}</th>
                        <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Fat') }}</th>
                        <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Carb') }}</th>
                        <th class="w-1/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Kcal') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr @click="$dispatch('select-product', '{{ $product }}')"
                            wire:key="{{ $product->id }}"
                            class="cursor-pointer hover:bg-gray-50"
                        >
                            <td class="px-2 py-4 break-words">{{ $product->title }}</td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->proteins }}</td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->fats }}</td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->carbohydrates }}</td>
                            <td class="px-2 py-3 text-center whitespace-nowrap">{{ $product->calories }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>