<div class="flex flex-col justify-center mb-10">

    @if($isRecipesRequest)
        @section('title', __('Recipes'))
    @else
        @section('title', __('Products'))
    @endif

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @if($isRecipesRequest)
                    {{ __('Recipes') }}
                @else
                    {{ __('Products') }}
                @endif
            </h2>
            @if($isRecipesRequest)
                <a href="{{ route('recipe.create') }}">
                    <x-secondary-button>
                        {{ __('Create Recipe') }}
                    </x-secondary-button>
                </a>
            @else
                <a href="{{ route('product.create') }}">
                    <x-secondary-button>
                        {{ __('Create Product') }}
                    </x-secondary-button>
                </a>
            @endif
        </div>
    </x-slot>

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

        <script type="application/ld+json">
            {!! json_encode([
                "@context" => "https://schema.org",
                "@type" => "ItemList",
                "name" => __("Product List"),
                "description" => __("List of products including nutritional information such as calories, proteins, fats, and carbohydrates."),
                "url" => url()->current(),
                "itemListElement" => $products->map(function ($product, $index) {
                    return [
                        "@type" => "ListItem",
                        "position" => $index + 1,
                        "url" => route('product.show', $product->slug),
                        "name" => $product->title,
                        "additionalProperty" => [
                            [
                                "@type" => "PropertyValue",
                                "name" => "Calories",
                                "value" => "{$product->calories} kcal",
                            ],
                            [
                                "@type" => "PropertyValue",
                                "name" => "Proteins",
                                "value" => "{$product->proteins} g",
                            ],
                            [
                                "@type" => "PropertyValue",
                                "name" => "Fats",
                                "value" => "{$product->fats} g",
                            ],
                            [
                                "@type" => "PropertyValue",
                                "name" => "Carbohydrates",
                                "value" => "{$product->carbohydrates} g",
                            ],
                        ],
                    ];
                }),
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endsection

    <div class="flex flex-col shadow justify-between rounded-lg mt-5 bg-white mb-1">
        <div class="p-5 md:p-10">
            <!-- Search bar -->
            <div class="mb-5 md:mb-10">
                <input
                    type="text"
                    placeholder="{{ __('Search...') }}"
                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    wire:model.live.debounce.500ms="search"
                />
                <div class="text-red-600">@error('search') {{ $message }} @enderror</div>
            </div>
            @if($products->isEmpty())
                <div class="text-center text-gray-500">
                    {{ __('No products found.') }}
                </div>
            @else
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Prot') }}</th>
                                <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Fat') }}</th>
                                <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Carb') }}</th>
                                <th class="w-1/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Kcal') }}</th>
                                <th class="w-1/12 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $product)
                                <tr>
                                    <td class="px-2 py-4 break-words">
                                        @if($product->user_id)
                                            <a href="{{route('product.edit', $product->id) }}"
                                               class="hover:underline">
                                                <i class="fas fa-edit text-blue-800"></i>
                                            </a>
                                        @endif
                                        <a href="{{route('product.show', $product->slug) }}"
                                           class="hover:underline">
                                            {{ $product->title }}
                                        </a>
                                    </td>
                                    <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->proteins }}</td>
                                    <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->fats }}</td>
                                    <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->carbohydrates }}</td>
                                    <td class="px-2 py-3 text-center whitespace-nowrap">{{ $product->calories }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap">
                                        @if($product->user_id)
                                            <a href="#" wire:click.prevent="delete({{ $product->id }})"
                                               class="text-red-500 hover:underline">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{--                    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">--}}
                    {{--            <span>--}}
                    {{--                --}}{{-- Previous Page Link --}}
                    {{--                @if ($products->onFirstPage())--}}
                    {{--                    <span--}}
                    {{--                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">--}}
                    {{--                        {!! __('pagination.previous') !!}--}}
                    {{--                    </span>--}}
                    {{--                @else--}}
                    {{--                    <a href="{{ $products->previousPageUrl() }}">--}}
                    {{--                    <button type="button" dusk="previousPage"--}}
                    {{--                            wire:loading.attr="disabled"--}}
                    {{--                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">--}}
                    {{--                                {!! __('pagination.previous') !!}--}}
                    {{--                        </button>--}}
                    {{--                    </a>--}}
                    {{--                @endif--}}
                    {{--            </span>--}}

                    {{--                        <span>--}}
                    {{--                --}}{{-- Next Page Link --}}
                    {{--                            @if ($products->hasMorePages())--}}
                    {{--                                <a href="{{ $products->nextPageUrl() }}">--}}
                    {{--                                    <button type="button" dusk="nextPage"--}}
                    {{--                                            wire:loading.attr="disabled"--}}
                    {{--                                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">--}}
                    {{--                                {!! __('pagination.next') !!}--}}
                    {{--                        </button>--}}
                    {{--                                    </a>--}}
                    {{--                            @else--}}
                    {{--                                <span--}}
                    {{--                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">--}}
                    {{--                        {!! __('pagination.next') !!}--}}
                    {{--                    </span>--}}
                    {{--                            @endif--}}
                    {{--            </span>--}}
                    {{--                    </nav>--}}
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
    <x-loading-screen/>
</div>