<div class="flex flex-col justify-center mb-10">

    @if($isRecipesRequest)
        @section('title', __('Recipes'))
    @else
        @section('title', __('Products'))
    @endif

    @section('meta')
        @if ($products->onFirstPage())
            <link rel="next" href="{{ $products->nextPageUrl() }}">
        @elseif ($products->hasMorePages())
            <link rel="prev" href="{{ $products->previousPageUrl() }}">
            <link rel="next" href="{{ $products->nextPageUrl() }}">
        @else
            <link rel="prev" href="{{ $products->previousPageUrl() }}">
        @endif
        <link rel="canonical" href="{{ url()->current() }}">

        <meta name="description"
              content="{{ __('List of products including their nutritional information such as proteins, fats, carbohydrates, and calories.') }}">
        <meta name="keywords" content="{{ __('Products, Nutrition, Proteins, Fats, Carbohydrates, Calories') }}">
        <meta property="og:title" content="{{ __('Product list') }}">
        <meta property="og:description"
              content="{{ __('List of products including their nutritional information such as proteins, fats, carbohydrates, and calories.') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">

        @php
            $at = '@';
            $schemaItems = $products->values()->map(function ($product, $index) use ($at) {
                return [
                    "{$at}type" => "ListItem",
                    "position" => $index + 1,
                    "url" => route('product.show', $product->slug),
                    "name" => $product->title,
                    "additionalProperty" => [
                        ["{$at}type" => "PropertyValue", "name" => "Calories", "value" => "{$product->calories} kcal"],
                        ["{$at}type" => "PropertyValue", "name" => "Proteins", "value" => "{$product->proteins} g"],
                        ["{$at}type" => "PropertyValue", "name" => "Fats", "value" => "{$product->fats} g"],
                        ["{$at}type" => "PropertyValue", "name" => "Carbohydrates", "value" => "{$product->carbohydrates} g"],
                    ],
                ];
            });
        @endphp
        <script type="application/ld+json">
            {!! json_encode([
                "{$at}context" => "https://schema.org",
                "{$at}type" => "ItemList",
                "name" => __("Product List"),
                "description" => __("List of products including nutritional information such as calories, proteins, fats, and carbohydrates."),
                "url" => url()->current(),
                "itemListElement" => $schemaItems,
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endsection

    {{-- Header --}}
    <div class="flex justify-between items-center mt-6 mb-4">
        <h1 class="text-2xl font-bold text-stone-800">
            @if($isRecipesRequest)
                {{ __('Recipes') }}
            @else
                {{ __('Products') }}
            @endif
        </h1>
        @if($isRecipesRequest)
            <a href="{{ route('recipe.create') }}">
                <button class="px-4 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-xl transition-colors">
                    <i class="fas fa-plus mr-2"></i>{{ __('Create Recipe') }}
                </button>
            </a>
        @else
            <a href="{{ route('product.create') }}">
                <button class="px-4 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-xl transition-colors">
                    <i class="fas fa-plus mr-2"></i>{{ __('Create Product') }}
                </button>
            </a>
        @endif
    </div>

    {{-- Main Card --}}
    <div class="rounded-2xl bg-white border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-4 md:p-6">
            {{-- Search bar --}}
            <div class="mb-5">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"></i>
                    <input
                        type="text"
                        placeholder="{{ __('Search...') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
                        wire:model.live.debounce.500ms="search"
                    />
                </div>
                <div class="text-red-500 text-sm mt-1">@error('search') {{ $message }} @enderror</div>
            </div>

            @if($products->isEmpty())
                <div class="py-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-stone-100 flex items-center justify-center text-stone-400">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <p class="text-stone-500">{{ __('No products found.') }}</p>
                </div>
            @else
                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="border-b border-stone-100">
                                <th class="px-2 md:px-4 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                <th class="w-12 sm:w-14 px-2 py-3 text-center text-xs font-medium text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Prot') }}</th>
                                <th class="w-12 sm:w-14 px-2 py-3 text-center text-xs font-medium text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Fat') }}</th>
                                <th class="w-12 sm:w-14 px-2 py-3 text-center text-xs font-medium text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Carb') }}</th>
                                <th class="w-14 sm:w-16 px-2 py-3 text-center text-xs font-medium text-stone-500 uppercase tracking-wider">{{ __('Kcal') }}</th>
                                <th class="w-8 px-2 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50">
                            @foreach($products as $product)
                                <tr class="hover:bg-stone-50/50 transition-colors">
                                    <td class="px-2 md:px-4 py-3">
                                        <div class="flex items-center gap-2 min-w-0">
                                            @if($product->user_id)
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                   class="text-stone-400 hover:text-amber-600 transition-colors flex-shrink-0">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('product.show', $product->slug) }}"
                                               class="text-stone-700 hover:text-amber-600 transition-colors truncate">
                                                {{ $product->title }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-2 py-3 text-center text-sm text-stone-400 hidden sm:table-cell">{{ $product->proteins }}</td>
                                    <td class="px-2 py-3 text-center text-sm text-stone-400 hidden sm:table-cell">{{ $product->fats }}</td>
                                    <td class="px-2 py-3 text-center text-sm text-stone-400 hidden sm:table-cell">{{ $product->carbohydrates }}</td>
                                    <td class="px-2 py-3 text-center text-sm font-medium text-stone-600">{{ $product->calories }}</td>
                                    <td class="px-2 py-3">
                                        @if($product->user_id)
                                            <button wire:click.prevent="delete({{ $product->id }})"
                                                    class="text-stone-300 hover:text-red-500 transition-colors">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6 pt-4 border-t border-stone-100">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
    <x-loading-screen/>
</div>
