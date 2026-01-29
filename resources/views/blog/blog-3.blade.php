<x-app-layout :full-width="true">

    @section('title', __('TOP 10 Foods for Healthy Eating'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn about the 10 best foods for healthy eating. Include them in your diet to maintain health and energy.') }}">
        <meta name="keywords" content="{{ __('healthy eating, healthy foods, top 10 foods, nutrition') }}">
        <meta name="author" content="Calorize">
    @endsection

    @php
        $primaryUrl = auth()->check() ? route('diary') : route('register');
        $primaryLabel = auth()->check() ? __('Go to Diary') : __('Start for free');
    @endphp

    <div class="bg-[radial-gradient(1100px_circle_at_20%_-10%,rgba(245,158,11,0.16),transparent_55%),radial-gradient(900px_circle_at_90%_10%,rgba(14,165,233,0.12),transparent_50%),linear-gradient(to_bottom,rgba(250,250,249,1),rgba(255,255,255,1))]">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto pt-8 sm:pt-10 lg:pt-12 pb-10">
                <a href="{{ route('blog') }}"
                   class="inline-flex items-center gap-2 rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-4 py-2 text-sm font-semibold text-stone-700 hover:bg-white transition"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>{{ __('Back to Blog') }}</span>
                </a>

                <div class="mt-6 max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3.5 py-2 text-xs font-semibold text-stone-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        <span>{{ __('Foods') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('4 min read') }}</span>
                        <span class="text-stone-400">•</span>
                        <time datetime="2025-09-20">{{ \Carbon\Carbon::parse('2025-09-20')->translatedFormat('d M Y') }}</time>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('TOP 10 Foods for Healthy Eating') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('A quick, balanced list of foods that cover protein, fiber, healthy fats, and micronutrients.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-3.webp" alt="{{ __('TOP 10 Foods for Healthy Eating') }}" class="h-full w-full object-cover" />
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-10 text-stone-700 leading-relaxed">
                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('1. Avocado') }}</h2>
                                <p class="mt-3">{{ __('Avocado is rich in healthy fats, vitamins, and antioxidants. It helps maintain cardiovascular health and lowers cholesterol levels.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('2. Salmon') }}</h2>
                                <p class="mt-3">{{ __('This type of fish is a source of omega-3 fatty acids that support brain, heart, and skin health.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('3. Berries') }}</h2>
                                <p class="mt-3">{{ __('Blueberries, raspberries, and strawberries are superfoods rich in antioxidants that strengthen the immune system and promote skin health.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('4. Nuts') }}</h2>
                                <p class="mt-3">{{ __('Almonds, walnuts, cashews are sources of protein, healthy fats, and minerals that provide energy.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('5. Whole Grains') }}</h2>
                                <p class="mt-3">{{ __('Oats, buckwheat, quinoa are sources of complex carbohydrates and fiber that support digestion and provide long-lasting satiety.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('6. Spinach') }}</h2>
                                <p class="mt-3">{{ __('Spinach is a source of iron, vitamin K, and antioxidants. It helps maintain energy and supports bone health.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('7. Yogurt') }}</h2>
                                <p class="mt-3">{{ __('Natural yogurt is rich in probiotics that support gut health and improve digestion.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('8. Chicken Breast') }}</h2>
                                <p class="mt-3">{{ __('Chicken breast is a source of high-quality protein essential for muscle recovery and energy maintenance.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('9. Eggs') }}</h2>
                                <p class="mt-3">{{ __('Eggs are a versatile product rich in protein, vitamins, and healthy fats that provide energy.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('10. Sweet Potatoes (Yams)') }}</h2>
                                <p class="mt-3">{{ __('Sweet potatoes contain complex carbohydrates, fiber, and B vitamins that support energy and digestive health.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Conclusion') }}</h2>
                                <p class="mt-3">
                                    {{ __('Including these foods in your diet will help maintain health, energy, and physical fitness. Use the') }}
                                    <a href="{{ $primaryUrl }}" class="font-semibold text-amber-700 hover:text-amber-800 underline">{{ __('Calorize') }}</a>
                                    {{ __('app to control your nutrition and achieve your goals.') }}
                                </p>
                            </section>
                        </div>

                        <div class="mt-10 flex flex-col sm:flex-row gap-3">
                            <a href="{{ $primaryUrl }}" class="inline-flex items-center justify-center rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-stone-900/10 hover:bg-stone-800 transition">
                                {{ $primaryLabel }}
                            </a>
                            <a href="{{ route('blog') }}" class="inline-flex items-center justify-center rounded-2xl border border-stone-200 bg-white px-5 py-3 text-sm font-semibold text-stone-800 hover:bg-white transition">
                                {{ __('Back to Blog') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
