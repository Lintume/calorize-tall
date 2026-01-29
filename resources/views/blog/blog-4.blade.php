<x-app-layout :full-width="true">

    @section('title', __('Why Water is Important for Weight Loss?'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn why water is a key factor in the weight loss process. From boosting metabolism to controlling appetite — all about the benefits of water.') }}">
        <meta name="keywords" content="{{ __('water for weight loss, benefits of water, weight loss, hydration') }}">
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
                        <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                        <span>{{ __('Hydration') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('4 min read') }}</span>
                        <span class="text-stone-400">•</span>
                        <time datetime="2025-10-05">{{ \Carbon\Carbon::parse('2025-10-05')->translatedFormat('d M Y') }}</time>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('Why Water is Important for Weight Loss?') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Hydration impacts appetite, digestion, energy, and metabolism — here’s how to use it as a simple advantage.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-4.webp" alt="{{ __('Why Water is Important for Weight Loss?') }}" class="h-full w-full object-cover" />
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-10 text-stone-700 leading-relaxed">
                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('1. Water Stimulates Metabolism') }}</h2>
                                <p class="mt-3">{{ __('Studies have shown that drinking 500 ml of water can increase the metabolic rate by 24-30% over the next few hours. This helps the body burn calories more efficiently.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('2. Appetite Control') }}</h2>
                                <p class="mt-3">{{ __('Often, the body confuses hunger with thirst. Drinking a glass of water before meals can reduce calorie intake and help better control your appetite.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('3. Water Supports Energy') }}</h2>
                                <p class="mt-3">{{ __('Dehydration can lead to fatigue and reduced performance. Proper hydration helps maintain energy and activity, which is important for physical training and daily activities.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('4. Water Improves Digestion') }}</h2>
                                <p class="mt-3">{{ __('Drinking water promotes better digestion, prevents constipation, and supports normal gastrointestinal function. This is essential for healthy weight loss.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('5. Helps Remove Toxins') }}</h2>
                                <p class="mt-3">{{ __('Water helps cleanse the body of toxins that can accumulate due to poor nutrition or insufficient physical activity. This keeps your body in optimal shape.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('How Much Water Should You Drink?') }}</h2>
                                <div class="mt-3 rounded-2xl border border-stone-200 bg-stone-50 px-4 py-3">
                                    <p class="text-sm sm:text-base">{{ __('The recommended norm for an adult is about 1.5-2 liters of water per day. However, this amount may vary depending on activity level, climate, and individual needs.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('How Calorize Can Help?') }}</h2>
                                <ul class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-sky-500 shrink-0"></span>
                                        <span><span class="font-semibold text-stone-900">{{ __('Hydration Tracking:') }}</span> {{ __('monitor your daily water intake.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-sky-500 shrink-0"></span>
                                        <span><span class="font-semibold text-stone-900">{{ __('Progress Charts:') }}</span> {{ __('track your hydration habits along with other data.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-sky-500 shrink-0"></span>
                                        <span><span class="font-semibold text-stone-900">{{ __('Convenient Interface:') }}</span> {{ __('add water to your food diary with just a few clicks.') }}</span>
                                    </li>
                                </ul>
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
