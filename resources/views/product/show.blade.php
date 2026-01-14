<x-app-layout>

    @section('title', $product->title . ': ' . __('calories, proteins, fats, and carbohydrates'))

    @section('meta')
        <meta name="description" content="{{ $product->title }} - {{ __('Find out the calorie content, proteins, fats and carbohydrates on our website. A simple and convenient tool for monitoring nutrition.') }}">
        <meta name="keywords" content="{{ __('Product, Proteins, Fats, Carbohydrates, Calories') }}, {{ $product->title }}">
        <meta property="og:title" content="{{ $product->title }}">
        <meta property="og:description" content="{{ $product->title }} - {{ __('Product details including proteins, fats, carbohydrates, and calories.') }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ url()->current() }}">

        <script type="application/ld+json">
            {
                "@@context": "https://schema.org",
                "@@type": "NutritionInformation",
                "name": "{{ $product->title }}",
                "description": "{{ __('Detailed information about') }} {{ $product->title }}",
                "calories": "{{ number_format($product->calories) }} kcal",
                "proteinContent": "{{ number_format($product->proteins, 2) }} g",
                "fatContent": "{{ number_format($product->fats, 2) }} g",
                "carbohydrateContent": "{{ number_format($product->carbohydrates, 2) }} g",
                "servingSize": "100 g",
                "url": "{{ url()->current() }}"
            }
        </script>
    @endsection

    @php
        $totalMacros = $product->proteins + $product->fats + $product->carbohydrates;
        $proteinPercent = $totalMacros > 0 ? round(($product->proteins / $totalMacros) * 100) : 0;
        $fatPercent = $totalMacros > 0 ? round(($product->fats / $totalMacros) * 100) : 0;
        $carbPercent = $totalMacros > 0 ? round(($product->carbohydrates / $totalMacros) * 100) : 0;
    @endphp

    <div class="py-10 lg:py-16">
        <div class="max-w-6xl mx-auto px-4 space-y-8">

            {{-- Hero --}}
            <div class="relative overflow-hidden rounded-[2rem] border border-stone-200 bg-white/90 backdrop-blur shadow-2xl shadow-stone-900/5">
                <div class="absolute inset-0 bg-[radial-gradient(1200px_circle_at_10%_-20%,rgba(245,158,11,0.18),transparent_55%),radial-gradient(900px_circle_at_95%_-10%,rgba(14,165,233,0.14),transparent_50%),linear-gradient(to_bottom,rgba(255,255,255,0.96),rgba(250,250,249,0.96))]"></div>
                <div class="relative p-6 sm:p-8 lg:p-10 space-y-6">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/70 px-3 py-1.5 text-[11px] font-semibold text-stone-700">
                            <i class="fas {{ $product->base ? 'fa-seedling' : 'fa-utensils' }} text-amber-600"></i>
                            {{ $product->base ? __('Product') : __('Recipe') }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-[11px] font-semibold text-amber-700">
                            <i class="fas fa-bolt"></i>
                            {{ __('Per 100 g') }}
                        </span>
                        @if($product->user_id === optional(auth()->user())->id)
                            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-[11px] font-semibold text-emerald-700">
                                <i class="fas fa-user"></i>
                                {{ __('Created by you') }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-[clamp(2rem,3vw,2.8rem)] font-extrabold leading-[1.05] text-stone-900">
                                {{ $product->title }}
                            </h1>
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    <div class="w-full lg:w-auto">
                            <div class="mx-auto w-full max-w-xs">
                                <div class="relative rounded-[1.75rem] border border-amber-200 bg-white shadow-xl shadow-amber-900/10 overflow-hidden">
                                    <div class="absolute inset-0 bg-[radial-gradient(260px_circle_at_30%_20%,rgba(245,158,11,0.12),transparent_60%)]"></div>
                                    <div class="relative px-6 pt-7 pb-6 text-center">
                                        <div class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">{{ __('Calories') }}</div>
                                        <div class="mt-3 text-[56px] sm:text-[64px] font-black bg-gradient-to-br from-amber-600 to-amber-700 bg-clip-text text-transparent leading-none">
                                            {{ number_format($product->calories) }}
                                        </div>
                                        <div class="text-sm font-semibold text-stone-500 mt-1">{{ __('kcal per 100 g') }}</div>
                                        <div class="mt-6 grid grid-cols-3 gap-2">
                                            <div class="rounded-xl border border-sky-100 bg-sky-50 py-2">
                                                <div class="text-[11px] font-semibold text-sky-700 uppercase">{{ __('Prot') }}</div>
                                                <div class="text-base font-extrabold text-stone-900">{{ number_format($product->proteins, 1) }}</div>
                                            </div>
                                            <div class="rounded-xl border border-amber-100 bg-amber-50 py-2">
                                                <div class="text-[11px] font-semibold text-amber-700 uppercase">{{ __('Fat') }}</div>
                                                <div class="text-base font-extrabold text-stone-900">{{ number_format($product->fats, 1) }}</div>
                                            </div>
                                            <div class="rounded-xl border border-emerald-100 bg-emerald-50 py-2">
                                                <div class="text-[11px] font-semibold text-emerald-700 uppercase">{{ __('Carb') }}</div>
                                                <div class="text-base font-extrabold text-stone-900">{{ number_format($product->carbohydrates, 1) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4 max-w-2xl">
                    
                            <p class="text-sm sm:text-base text-stone-600 leading-relaxed">
                                {{ __('A diary-ready item with clean macros, tuned for AI chat, quick add, and voice-friendly logging. Perfect for keeping your meals consistent and on-budget.') }}
                            </p>

                            <div class="flex flex-wrap items-center gap-3">
                                @auth
                                    <a href="{{ route('diary') }}"
                                       class="inline-flex items-center justify-center gap-2 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                        <i class="fas fa-plus text-xs"></i>
                                        {{ __('Add to diary') }}
                                    </a>
                                    @if($product->user_id === auth()->id())
                                        <a href="{{ route('product.edit', $product->id) }}"
                                           class="inline-flex items-center justify-center gap-2 rounded-2xl border border-stone-200 bg-white px-5 py-3 text-sm font-semibold text-stone-800 hover:bg-stone-50 transition">
                                            <i class="fas fa-edit text-xs"></i>
                                            {{ __('Edit') }}
                                        </a>
                                    @endif
                                @endauth
                                @guest
                                    <a href="{{ route('register') }}"
                                       class="inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-600/20 hover:bg-amber-700 transition">
                                        <i class="fas fa-magic text-xs"></i>
                                        {{ __('Start free') }}
                                    </a>
                                    <a href="{{ route('login') }}"
                                       class="inline-flex items-center justify-center gap-2 rounded-2xl border border-stone-200 bg-white px-5 py-3 text-sm font-semibold text-stone-800 hover:bg-stone-50 transition">
                                        <i class="fas fa-door-open text-xs"></i>
                                        {{ __('Login') }}
                                    </a>
                                @endguest
                                <a href="{{ $product->base ? route('product.index') : route('recipe.index') }}"
                                   class="inline-flex items-center gap-2 text-sm font-semibold text-amber-700 hover:text-amber-800 transition">
                                    <i class="fas fa-arrow-left text-xs"></i>{{ __('Show All') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                        <div class="rounded-2xl border border-stone-200 bg-white/80 backdrop-blur p-4">
                            <div class="text-[11px] font-semibold text-stone-500 uppercase tracking-wide">{{ __('AI diary ready') }}</div>
                            <p class="mt-1 text-sm text-stone-700 font-semibold">{{ __('Use voice or text; AI finds and adds it in seconds.') }}</p>
                        </div>
                        <div class="rounded-2xl border border-stone-200 bg-white/80 backdrop-blur p-4">
                            <div class="text-[11px] font-semibold text-stone-500 uppercase tracking-wide">{{ __('Trustable macros') }}</div>
                            <p class="mt-1 text-sm text-stone-700 font-semibold">{{ __('Per 100 g baseline keeps diary math consistent.') }}</p>
                        </div>
                        <div class="rounded-2xl border border-stone-200 bg-white/80 backdrop-blur p-4">
                            <div class="text-[11px] font-semibold text-stone-500 uppercase tracking-wide">{{ __('Meal-ready') }}</div>
                            <p class="mt-1 text-sm text-stone-700 font-semibold">{{ __('Add to breakfast, lunch, dinner, or snacks instantly.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Macro details --}}
            <div class="rounded-[1.5rem] border border-stone-200 bg-white shadow-xl shadow-stone-900/5 overflow-hidden">
                <div class="px-6 sm:px-8 py-6 border-b border-stone-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">{{ __('Nutrition per 100 g') }}</div>
                        <div class="text-lg font-extrabold text-stone-900">{{ __('Macro breakdown & balance') }}</div>
                    </div>
                    <div class="flex flex-wrap gap-2 text-[11px] font-semibold text-stone-700">
                        <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-stone-50 px-3 py-1.5">
                            <i class="fas fa-chart-line text-amber-600"></i>{{ __('Balanced view') }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-stone-50 px-3 py-1.5">
                            <i class="fas fa-robot text-sky-600"></i>{{ __('AI + manual friendly') }}
                        </span>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-6">
                    {{-- Proteins --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 shadow-md shadow-amber-200"></div>
                                <span class="text-base font-semibold text-stone-800">{{ __('Proteins') }}</span>
                            </div>
                            <span class="text-lg font-extrabold text-stone-900">{{ number_format($product->proteins, 1) }} g</span>
                        </div>
                        <div class="h-3 rounded-full bg-stone-100 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-amber-500 to-amber-600" style="width: {{ min($proteinPercent, 100) }}%"></div>
                        </div>
                    </div>

                    {{-- Fats --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-full bg-gradient-to-br from-orange-400 to-orange-500 shadow-md shadow-orange-200"></div>
                                <span class="text-base font-semibold text-stone-800">{{ __('Fats') }}</span>
                            </div>
                            <span class="text-lg font-extrabold text-stone-900">{{ number_format($product->fats, 1) }} g</span>
                        </div>
                        <div class="h-3 rounded-full bg-stone-100 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-orange-400 to-orange-500" style="width: {{ min($fatPercent, 100) }}%"></div>
                        </div>
                    </div>

                    {{-- Carbs --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-full bg-gradient-to-br from-yellow-400 to-amber-400 shadow-md shadow-yellow-200"></div>
                                <span class="text-base font-semibold text-stone-800">{{ __('Carbohydrates') }}</span>
                            </div>
                            <span class="text-lg font-extrabold text-stone-900">{{ number_format($product->carbohydrates, 1) }} g</span>
                        </div>
                        <div class="h-3 rounded-full bg-stone-100 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-yellow-400 to-amber-400" style="width: {{ min($carbPercent, 100) }}%"></div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-stone-200 bg-stone-50/70 px-4 py-3 flex items-center justify-center gap-6">
                        <div class="flex items-center gap-2 text-sm font-semibold text-stone-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-amber-500 to-amber-600"></span>
                            {{ $proteinPercent }}% {{ __('proteins') }}
                        </div>
                        <div class="flex items-center gap-2 text-sm font-semibold text-stone-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-orange-400 to-orange-500"></span>
                            {{ $fatPercent }}% {{ __('fats') }}
                        </div>
                        <div class="flex items-center gap-2 text-sm font-semibold text-stone-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-yellow-400 to-amber-400"></span>
                            {{ $carbPercent }}% {{ __('carbs') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Diary guidance --}}
            <div class="rounded-[1.5rem] border border-stone-200 bg-white/90 backdrop-blur shadow-lg shadow-stone-900/5">
                <div class="px-6 sm:px-8 py-6 border-b border-stone-100 flex items-center justify-between gap-4">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">{{ __('Use it in Diary') }}</div>
                        <div class="text-lg font-extrabold text-stone-900">{{ __('Three taps to log this item') }}</div>
                    </div>
                    <div class="hidden sm:flex h-10 w-10 rounded-2xl bg-stone-900 text-white items-center justify-center">
                        <i class="fas fa-calendar-day text-sm"></i>
                    </div>
                </div>
                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-stone-200 bg-white p-4 space-y-2">
                        <div class="inline-flex items-center justify-center h-9 w-9 rounded-xl bg-amber-500/10 text-amber-700 border border-amber-200">1</div>
                        <p class="text-sm font-semibold text-stone-900">{{ __('Open Diary & pick a meal') }}</p>
                        <p class="text-sm text-stone-600">{{ __('Breakfast, lunch, dinner, or snack—AI chooses if you do not.') }}</p>
                    </div>
                    <div class="rounded-2xl border border-stone-200 bg-white p-4 space-y-2">
                        <div class="inline-flex items-center justify-center h-9 w-9 rounded-xl bg-amber-500/10 text-amber-700 border border-amber-200">2</div>
                        <p class="text-sm font-semibold text-stone-900">{{ __('Search or paste voice text') }}</p>
                        <p class="text-sm text-stone-600">{{ __('AI finds this exact item; grams auto-fill to 100 by default.') }}</p>
                    </div>
                    <div class="rounded-2xl border border-stone-200 bg-white p-4 space-y-2">
                        <div class="inline-flex items-center justify-center h-9 w-9 rounded-xl bg-amber-500/10 text-amber-700 border border-amber-200">3</div>
                        <p class="text-sm font-semibold text-stone-900">{{ __('Adjust grams, save, done') }}</p>
                        <p class="text-sm text-stone-600">{{ __('Macros recalc instantly; diary totals and charts stay in sync.') }}</p>
                    </div>
                </div>
            </div>

            @guest
                {{-- Guest CTA --}}
                <div class="rounded-[1.75rem] border border-amber-200 bg-gradient-to-br from-amber-600 via-amber-600 to-orange-600 p-8 sm:p-10 text-center shadow-2xl shadow-amber-700/30 relative overflow-hidden">
                    <div class="absolute -top-16 -left-16 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-14 -right-14 w-52 h-52 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative space-y-4">
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white">{{ __('Track this item with voice or text in seconds') }}</h3>
                        <p class="text-sm sm:text-base text-amber-100">
                            {{ __('Create a free account to unlock AI diary, macros, measurements, and quick add for every product and recipe.') }}
                        </p>
                        <div class="flex flex-col sm:flex-row sm:justify-center gap-3 pt-2">
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-amber-700 shadow-lg shadow-amber-600/25 hover:bg-amber-50 transition">
                                <i class="fas fa-rocket text-xs"></i>{{ __('Start free') }}
                            </a>
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-full border border-white/60 text-white px-6 py-3 text-sm font-semibold hover:bg-white/10 transition">
                                <i class="fas fa-door-open text-xs"></i>{{ __('I already have an account') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endguest

            @auth
                {{-- Quick add --}}
                <div class="rounded-[1.5rem] border border-stone-200 bg-white shadow-xl shadow-stone-900/5 p-8 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 text-amber-700 shadow-inner shadow-amber-900/10">
                        <i class="fas fa-plus text-lg"></i>
                    </div>
                    <p class="text-base text-stone-600 mb-5">
                        {{ __('Add this product to your diary using the AI assistant or quick search.') }}
                    </p>
                    <a href="{{ route('diary') }}"
                       class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-4 text-sm font-semibold text-white bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 rounded-2xl shadow-lg shadow-amber-600/25 transition">
                        <i class="fas fa-book-open mr-2 text-xs"></i>
                        {{ __('Go to Diary') }}
                    </a>
                </div>
            @endauth

        </div>
    </div>

</x-app-layout>
