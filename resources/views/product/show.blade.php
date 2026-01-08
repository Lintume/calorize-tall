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
        <div class="max-w-xl mx-auto space-y-8">

                {{-- Product Card --}}
                <div class="bg-white rounded-3xl shadow-xl shadow-stone-200/50 overflow-hidden border border-stone-100">

                    {{-- Header with gradient --}}
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 px-8 py-6 border-b border-amber-100/50">
                        <div class="flex items-start justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-stone-900 leading-tight">{{ $product->title }}</h1>
                                <p class="text-base text-stone-500 mt-1">{{ __('Per 100 gram') }}</p>
                            </div>
                            @if(auth()->check() && $product->user_id === auth()->id())
                                <a href="{{ route('product.edit', $product->id) }}"
                                   class="p-2.5 text-stone-400 hover:text-amber-700 hover:bg-amber-100 rounded-xl transition-all">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Calories - Hero element --}}
                    <div class="px-8 py-10 text-center bg-gradient-to-b from-white to-stone-50/50">
                        <div class="text-7xl lg:text-8xl font-bold bg-gradient-to-br from-amber-600 to-orange-600 bg-clip-text text-transparent">
                            {{ number_format($product->calories) }}
                        </div>
                        <div class="text-lg text-stone-500 mt-2 uppercase tracking-widest font-medium">{{ __('Kcal') }}</div>
                    </div>

                    {{-- Macros --}}
                    <div class="px-8 py-8 space-y-6 border-t border-stone-100">
                        {{-- Proteins --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 shadow-md shadow-amber-200"></div>
                                    <span class="text-base font-medium text-stone-700">{{ __('Proteins') }}</span>
                                </div>
                                <span class="text-lg font-bold text-stone-900">{{ number_format($product->proteins, 1) }}g</span>
                            </div>
                            <div class="h-3 bg-stone-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-amber-500 to-amber-600 rounded-full transition-all duration-500" style="width: {{ min($proteinPercent, 100) }}%"></div>
                            </div>
                        </div>

                        {{-- Fats --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-orange-400 to-orange-500 shadow-md shadow-orange-200"></div>
                                    <span class="text-base font-medium text-stone-700">{{ __('Fats') }}</span>
                                </div>
                                <span class="text-lg font-bold text-stone-900">{{ number_format($product->fats, 1) }}g</span>
                            </div>
                            <div class="h-3 bg-stone-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-orange-400 to-orange-500 rounded-full transition-all duration-500" style="width: {{ min($fatPercent, 100) }}%"></div>
                            </div>
                        </div>

                        {{-- Carbs --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-yellow-400 to-amber-400 shadow-md shadow-yellow-200"></div>
                                    <span class="text-base font-medium text-stone-700">{{ __('Carbohydrates') }}</span>
                                </div>
                                <span class="text-lg font-bold text-stone-900">{{ number_format($product->carbohydrates, 1) }}g</span>
                            </div>
                            <div class="h-3 bg-stone-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-yellow-400 to-amber-400 rounded-full transition-all duration-500" style="width: {{ min($carbPercent, 100) }}%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Macro Distribution --}}
                    <div class="px-8 pb-6">
                        <div class="flex items-center justify-center gap-8 py-4 bg-gradient-to-br from-stone-50 to-stone-100/80 rounded-2xl">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-gradient-to-br from-amber-500 to-amber-600"></div>
                                <span class="text-sm font-semibold text-stone-700">{{ $proteinPercent }}%</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-gradient-to-br from-orange-400 to-orange-500"></div>
                                <span class="text-sm font-semibold text-stone-700">{{ $fatPercent }}%</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-gradient-to-br from-yellow-400 to-amber-400"></div>
                                <span class="text-sm font-semibold text-stone-700">{{ $carbPercent }}%</span>
                            </div>
                        </div>
                    </div>

                    {{-- Back link --}}
                    <div class="px-8 pb-6">
                        <a href="{{ $product->base ? route('product.index') : route('recipe.index') }}"
                           class="text-base text-stone-500 hover:text-amber-700 flex items-center gap-2 transition-colors">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('Show All') }}
                        </a>
                    </div>
                </div>

                @guest
                    {{-- AI Demo --}}
                    <div class="bg-white rounded-3xl shadow-xl shadow-stone-200/50 overflow-hidden border border-stone-100">
                        <div class="px-8 py-6 border-b border-stone-100 bg-gradient-to-br from-stone-50 to-white">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-600 to-amber-700 text-white shadow-lg shadow-amber-600/30">
                                    <i class="fas fa-wand-magic-sparkles text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-stone-900">{{ __('AI Diary Assistant') }}</h3>
                                    <p class="text-base text-stone-500">{{ __('Add food in seconds') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="px-8 py-6">
                            <div class="space-y-4">
                                <div class="flex justify-end">
                                    <div class="px-5 py-3 bg-stone-100 rounded-2xl rounded-tr-lg max-w-[80%]">
                                        <p class="text-base text-stone-800">{{ $product->title }} 150g</p>
                                    </div>
                                </div>
                                <div class="flex justify-start">
                                    <div class="px-5 py-3 bg-gradient-to-br from-amber-600 to-amber-700 rounded-2xl rounded-tl-lg max-w-[80%] shadow-lg shadow-amber-600/20">
                                        <p class="text-base text-white">
                                            ✓ {{ __('Added to') }} {{ __('Lunch') }}: {{ Str::limit($product->title, 20) }}, 150g
                                            ({{ number_format($product->calories * 1.5) }} {{ __('Kcal') }})
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-stone-500 text-center mt-5">
                                {{ __('Type or use voice input') }}
                            </p>
                        </div>
                    </div>

                    {{-- Features --}}
                    <div class="bg-white rounded-3xl shadow-xl shadow-stone-200/50 p-8 border border-stone-100">
                        <h3 class="text-xl font-bold text-stone-900 mb-6 text-center">{{ __('Why Choose Calorize?') }}</h3>
                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 text-amber-700 shadow-md shadow-amber-100 flex-shrink-0">
                                    <i class="fas fa-comments text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-base font-semibold text-stone-900">{{ __('Chat-first logging') }}</p>
                                    <p class="text-sm text-stone-500">{{ __('Text or voice → saved to diary') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 text-amber-700 shadow-md shadow-amber-100 flex-shrink-0">
                                    <i class="fas fa-database text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-base font-semibold text-stone-900">{{ __('85,000+ foods') }}</p>
                                    <p class="text-sm text-stone-500">{{ __('Ukrainian products & local dishes') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 text-amber-700 shadow-md shadow-amber-100 flex-shrink-0">
                                    <i class="fas fa-brain text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-base font-semibold text-stone-900">{{ __('Smarter matches') }}</p>
                                    <p class="text-sm text-stone-500">{{ __('Uses your recent entries to disambiguate') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="bg-gradient-to-br from-amber-600 via-amber-600 to-orange-600 rounded-3xl p-8 text-center shadow-2xl shadow-amber-600/30 relative overflow-hidden">
                        <!-- Decorative elements -->
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-amber-500/30 rounded-full blur-2xl"></div>

                        <div class="relative">
                            <h3 class="text-2xl font-bold text-white mb-4">{{ __('Start tracking without the busywork') }}</h3>
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center px-8 py-4 text-lg font-semibold text-amber-700 bg-white hover:bg-amber-50 rounded-full shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                                {{ __('Start Free') }}
                                <i class="fas fa-arrow-right ml-3"></i>
                            </a>
                            <p class="text-sm text-amber-100 mt-4">
                                {{ __('Free to use') }} · {{ __('No credit card required') }}
                            </p>
                        </div>
                    </div>
                @endguest

                @auth
                    {{-- Quick add for logged in users --}}
                    <div class="bg-white rounded-3xl shadow-xl shadow-stone-200/50 p-8 text-center border border-stone-100">
                        <div class="w-14 h-14 mx-auto mb-4 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 text-amber-700 shadow-md shadow-amber-100">
                            <i class="fas fa-plus text-xl"></i>
                        </div>
                        <p class="text-base text-stone-600 mb-5">
                            {{ __('Add this product to your diary using the AI assistant') }}
                        </p>
                        <a href="{{ route('diary') }}"
                           class="inline-flex items-center justify-center w-full px-6 py-4 text-lg font-semibold text-white bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 rounded-2xl shadow-lg shadow-amber-600/25 transition-all duration-300">
                            <i class="fas fa-plus mr-2"></i>
                            {{ __('Add to the diary') }}
                        </a>
                    </div>
                @endauth

        </div>
    </div>

</x-app-layout>
