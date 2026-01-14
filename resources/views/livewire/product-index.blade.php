<div class="space-y-8 pb-12">

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

    {{-- Hero --}}
    <div class="mt-7 relative overflow-hidden rounded-[1.75rem] border border-stone-200 bg-white/90 backdrop-blur shadow-xl shadow-stone-900/5">
        <div class="absolute inset-0 bg-[radial-gradient(1200px_circle_at_10%_-30%,rgba(245,158,11,0.2),transparent_55%),radial-gradient(900px_circle_at_100%_-20%,rgba(14,165,233,0.16),transparent_55%),linear-gradient(to_bottom,rgba(255,255,255,0.95),rgba(250,250,249,0.95))]"></div>
        <div class="relative p-6 md:p-8 space-y-6">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div class="space-y-4 max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/80 px-3 py-1.5 text-[11px] font-semibold text-stone-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        <span>
                            {{ $isRecipesRequest ? __('landing.proof.recipes') : __('landing.proof.foods') }}
                        </span>
                    </div>
                    <div>
                        <h1 class="text-[clamp(1.9rem,3vw,2.6rem)] font-extrabold leading-[1.05] text-stone-900">
                            {{ $isRecipesRequest ? __('Create, save, and reuse your signature recipes') : __('Discover ingredients tailored for your diary & macros') }}
                        </h1>
                        <p class="mt-3 text-stone-600 text-sm sm:text-base leading-relaxed">
                            {{ $isRecipesRequest
                                ? __('Design chef-level recipes once, then add them to meals in two clicks — synced with AI diary, macros, and measurements.')
                                : __('Browse a living library of ingredients tuned for the diary experience: fast search, clean macros, AI suggestions, and quick add to meals.') }}
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 text-[11px] font-semibold text-stone-600">
                        <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                            <i class="fas fa-magic text-amber-500"></i>
                            {{ __('AI-ready search') }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                            <i class="fas fa-sync text-sky-600"></i>
                            {{ __('Syncs with Diary & Chat') }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                            <i class="fas fa-bolt text-emerald-600"></i>
                            {{ __('Macros per 100 g ready to drop in') }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    @if($isRecipesRequest)
                        <a href="{{ route('recipe.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition">
                            <i class="fas fa-plus text-xs"></i>{{ __('Create Recipe') }}
                        </a>
                    @else
                        <a href="{{ route('product.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition">
                            <i class="fas fa-plus text-xs"></i>{{ __('Create Product') }}
                        </a>
                    @endif
                    <a href="{{ route('diary') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 rounded-2xl border border-stone-200 bg-white/80 px-4 py-3 text-sm font-semibold text-stone-800 hover:bg-white transition">
                        <i class="fas fa-book-open text-xs"></i>{{ __('Open Diary') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Library --}}
    <div class="rounded-[1.5rem] border border-stone-200 bg-white/90 backdrop-blur shadow-lg shadow-stone-900/5 overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-4 md:px-6 py-4 border-b border-stone-200/70 bg-[radial-gradient(700px_circle_at_10%_-30%,rgba(245,158,11,0.12),transparent_55%),linear-gradient(to_right,rgba(255,255,255,0.95),rgba(250,250,249,0.95))]">
            <div class="flex items-center gap-3">
                <div class="h-11 w-11 rounded-2xl grid place-items-center bg-amber-100 text-amber-700 border border-amber-200 shadow-inner shadow-amber-900/5">
                    <i class="fas fa-seedling text-base"></i>
                </div>
                <div>
                    <div class="text-sm font-extrabold text-stone-900">
                        {{ $isRecipesRequest ? __('Recipe Library') : __('Product Library') }}
                    </div>
                    <div class="text-xs text-stone-500">
                        {{ __('Showing :count items on this page', ['count' => $products->count()]) }}
                    </div>
                </div>
            </div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-stone-200 bg-white/70 px-2 py-1.5 text-xs font-semibold text-stone-700">
                <a href="{{ route('product.index') }}"
                   class="px-3 py-1.5 rounded-xl {{ $isRecipesRequest ? 'text-stone-500 hover:text-stone-800' : 'bg-stone-900 text-white shadow-sm shadow-stone-900/15' }}">
                    {{ __('Products') }}
                </a>
                <a href="{{ route('recipe.index') }}"
                   class="px-3 py-1.5 rounded-xl {{ $isRecipesRequest ? 'bg-stone-900 text-white shadow-sm shadow-stone-900/15' : 'text-stone-500 hover:text-stone-800' }}">
                    {{ __('Recipes') }}
                </a>
            </div>
        </div>

        <div class="p-4 md:p-6 space-y-5">
            {{-- Search bar --}}
            <div>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"></i>
                    <input
                        type="text"
                        placeholder="{{ __('Search...') }}"
                        class="w-full pl-10 pr-4 py-3 rounded-2xl border border-stone-200 bg-white text-sm shadow-inner shadow-stone-900/5 focus:border-amber-500 focus:ring-amber-500 transition"
                        wire:model.live.debounce.500ms="search"
                    />
                </div>
                <div class="text-red-500 text-sm mt-1">@error('search') {{ $message }} @enderror</div>
            </div>

            @if($products->isEmpty())
                <div class="rounded-[1.25rem] border border-dashed border-stone-200 bg-stone-50 px-6 py-10 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white text-amber-600 grid place-items-center shadow-inner shadow-amber-900/5 border border-stone-200">
                        <i class="fas fa-search text-xl"></i>
                    </div>
                    <p class="text-lg font-extrabold text-stone-900 mb-2">{{ __('No products found.') }}</p>
                    <p class="text-sm text-stone-600 mb-5">{{ __('Try a shorter query or add your own item tailored to your diary flow.') }}</p>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3">
                        @if($isRecipesRequest)
                            <a href="{{ route('recipe.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition">
                                <i class="fas fa-plus text-xs"></i>{{ __('Create Recipe') }}
                            </a>
                        @else
                            <a href="{{ route('product.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition">
                                <i class="fas fa-plus text-xs"></i>{{ __('Create Product') }}
                            </a>
                        @endif
                        <a href="{{ route('diary') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm font-semibold text-stone-800 hover:bg-stone-50 transition">
                            <i class="fas fa-book-open text-xs"></i>{{ __('Back to Diary') }}
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                    @foreach($products as $product)
                        <div wire:key="product-{{ $product->id }}" class="group relative rounded-2xl border border-stone-200 bg-white/90 backdrop-blur p-4 shadow-sm shadow-stone-900/5 hover:-translate-y-[2px] hover:shadow-md hover:border-amber-200 transition">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0 space-y-1">
                                    <div class="inline-flex items-center gap-2 rounded-full border px-2.5 py-1 text-[11px] font-semibold"
                                         @class([
                                            'border-emerald-200 bg-emerald-50 text-emerald-700' => $product->user_id,
                                            'border-stone-200 bg-stone-50 text-stone-600' => ! $product->user_id,
                                         ])>
                                        <i class="fas {{ $product->user_id ? 'fa-user' : 'fa-globe' }} text-[10px]"></i>
                                        <span>{{ $product->user_id ? __('Your item') : __('Community base') }}</span>
                                    </div>
                                    <a href="{{ route('product.show', $product->slug) }}"
                                       class="block text-lg font-extrabold text-stone-900 leading-tight truncate hover:text-amber-700 transition">
                                        {{ $product->title }}
                                    </a>
                                    <p class="text-xs text-stone-500 truncate">
                                        {{ __('Ready for diary • 100 g baseline • quick macros view') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-1">
                                    @if($product->user_id)
                                        <a href="{{ route('product.edit', $product->id) }}"
                                           class="h-9 w-9 grid place-items-center rounded-xl border border-stone-200 text-stone-500 hover:text-amber-700 hover:border-amber-200 transition"
                                           title="{{ __('Edit') }}">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <button
                                            wire:click.prevent="delete({{ $product->id }})"
                                            class="h-9 w-9 grid place-items-center rounded-xl border border-stone-200 text-stone-400 hover:text-red-600 hover:border-red-200 transition"
                                            title="{{ __('Delete') }}"
                                        >
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-4 gap-2 text-center">
                                <div class="rounded-xl border border-sky-100 bg-sky-50 py-2">
                                    <div class="text-[11px] font-semibold text-sky-700 uppercase">{{ __('Prot') }}</div>
                                    <div class="text-sm font-extrabold text-stone-900">{{ $product->proteins }}</div>
                                </div>
                                <div class="rounded-xl border border-amber-100 bg-amber-50 py-2">
                                    <div class="text-[11px] font-semibold text-amber-700 uppercase">{{ __('Fat') }}</div>
                                    <div class="text-sm font-extrabold text-stone-900">{{ $product->fats }}</div>
                                </div>
                                <div class="rounded-xl border border-emerald-100 bg-emerald-50 py-2">
                                    <div class="text-[11px] font-semibold text-emerald-700 uppercase">{{ __('Carb') }}</div>
                                    <div class="text-sm font-extrabold text-stone-900">{{ $product->carbohydrates }}</div>
                                </div>
                                <div class="rounded-xl border border-stone-200 bg-white py-2">
                                    <div class="text-[11px] font-semibold text-amber-800 uppercase">{{ __('Kcal') }}</div>
                                    <div class="text-sm font-extrabold text-stone-900">{{ $product->calories }}</div>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <div class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-stone-50 px-3 py-1.5 text-[11px] font-semibold text-stone-700">
                                    <i class="fas fa-bolt text-amber-600"></i>
                                    {{ __('100 g ready for AI & diary') }}
                                </div>
                                <a href="{{ route('product.show', $product->slug) }}"
                                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-700 hover:text-amber-800">
                                    <span>{{ __('Open') }}</span>
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="pt-4 border-t border-stone-100">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
    <x-loading-screen/>
</div>
