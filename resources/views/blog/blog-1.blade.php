<x-app-layout :full-width="true">

    @section('title', __('How to Count Calories for Weight Loss — A Practical Guide'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn how to count calories for weight loss. A simple guide, useful tips, and how the Calorize app can help you achieve your goals.') }}">
        <meta name="keywords" content="{{ __('how to count calories, weight loss, product calorie content, calorie counting apps') }}">
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
                        <span>{{ __('Calories') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('7 min read') }}</span>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('How to Count Calories for Weight Loss? A Beginner\'s Guide') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('A simple, practical way to calculate your norm, create a safe deficit, and stay consistent with food tracking.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-1.webp"
                             alt="{{ __('How to count calories for weight loss') }}"
                             class="h-full w-full object-cover"
                        />
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-10 text-stone-700 leading-relaxed">
                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('What are Calories and Why Are They Important?') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Calories are a unit of energy obtained from food and drinks. Your body uses calories to maintain vital functions: breathing, heart activity, movement, and even thinking.') }}</p>
                                    <p>{{ __('When you consume more calories than you burn, the excess is stored as fat. Conversely, burning more than you consume leads to weight loss.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('How to Determine Your Calorie Norm?') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p><span class="font-semibold text-stone-900">{{ __('Calculate your Basal Metabolic Rate (BMR):') }}</span></p>
                                    <p class="rounded-2xl border border-stone-200 bg-stone-50 px-4 py-3 text-sm sm:text-base">
                                        <span class="font-semibold text-stone-900">{{ __('For women:') }}</span>
                                        <span class="ml-1 font-mono">BMR = 10 × weight (kg) + 6.25 × height (cm) − 5 × age (years) − 161</span>
                                    </p>
                                    <p class="rounded-2xl border border-stone-200 bg-stone-50 px-4 py-3 text-sm sm:text-base">
                                        <span class="font-semibold text-stone-900">{{ __('For men:') }}</span>
                                        <span class="ml-1 font-mono">BMR = 10 × weight (kg) + 6.25 × height (cm) − 5 × age (years) + 5</span>
                                    </p>

                                    <p><span class="font-semibold text-stone-900">{{ __('Multiply BMR by your activity level:') }}</span></p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                            <span>{{ __('Minimal activity: × 1.2') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                            <span>{{ __('Light activity: × 1.375') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                            <span>{{ __('Moderate activity: × 1.55') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                            <span>{{ __('High activity: × 1.725') }}</span>
                                        </li>
                                    </ul>

                                    <p>{{ __('This number is your Total Daily Energy Expenditure (TDEE). To lose weight, create a deficit of 10-20% from TDEE.') }}</p>
                                    <p>
                                        {{ __('You can easily perform all these calculations in our app here:') }}
                                        <a href="{{ route('personal') }}" class="font-semibold text-amber-700 hover:text-amber-800 underline">
                                            {{ __('Personal Calculations') }}
                                        </a>.
                                    </p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('What Foods to Choose for Weight Loss?') }}
                                </h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Pay attention to foods with high nutritional value:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span><span class="font-semibold text-stone-900">{{ __('Proteins:') }}</span> {{ __('chicken, eggs, cheese, legumes.') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                            <span><span class="font-semibold text-stone-900">{{ __('Healthy Fats:') }}</span> {{ __('avocado, nuts, olive oil.') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-sky-500 shrink-0"></span>
                                            <span><span class="font-semibold text-stone-900">{{ __('Complex Carbohydrates:') }}</span> {{ __('whole-grain bread, vegetables, grains.') }}</span>
                                        </li>
                                    </ul>
                                    <p>{{ __('Avoid ultra-processed foods with "empty" calories: chips, sweets, soft drinks.') }}</p>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('How Can Calorize Help You?') }}
                                </h2>
                                <div class="mt-3 space-y-4">
                                    <p>{{ __('Our app simplifies the entire process. Here\'s what you can do:') }}</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <a href="{{ route('personal') }}" class="rounded-2xl border border-stone-200 bg-white p-4 hover:bg-stone-50 transition">
                                            <div class="text-sm font-extrabold text-stone-900">{{ __('Calculate your calorie norm') }}</div>
                                            <div class="mt-1 text-sm text-stone-600">{{ __('BMR/TDEE, BMI, fat %, target timeline.') }}</div>
                                        </a>
                                        <a href="{{ route('diary') }}" class="rounded-2xl border border-stone-200 bg-white p-4 hover:bg-stone-50 transition">
                                            <div class="text-sm font-extrabold text-stone-900">{{ __('Keep a food diary') }}</div>
                                            <div class="mt-1 text-sm text-stone-600">{{ __('Add products and meals from a large database.') }}</div>
                                        </a>
                                        <a href="{{ route('statistic') }}" class="rounded-2xl border border-stone-200 bg-white p-4 hover:bg-stone-50 transition">
                                            <div class="text-sm font-extrabold text-stone-900">{{ __('Build progress graphs') }}</div>
                                            <div class="mt-1 text-sm text-stone-600">{{ __('Track weight, calories and macros.') }}</div>
                                        </a>
                                        <a href="{{ route('recipe.create') }}" class="rounded-2xl border border-stone-200 bg-white p-4 hover:bg-stone-50 transition">
                                            <div class="text-sm font-extrabold text-stone-900">{{ __('Save your own recipes') }}</div>
                                            <div class="mt-1 text-sm text-stone-600">{{ __('No manual calorie math for favorite meals.') }}</div>
                                        </a>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Tips for Effective Weight Loss') }}
                                </h2>
                                <ol class="mt-3 space-y-2">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-extrabold text-xs shrink-0">1</span>
                                        <span>{{ __('Don\'t create too large a calorie deficit — this can lead to muscle loss.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-extrabold text-xs shrink-0">2</span>
                                        <span>{{ __('Don\'t forget about physical activity — even walks can significantly increase calorie expenditure.') }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-extrabold text-xs shrink-0">3</span>
                                        <span>{{ __('Keep a food diary. Even small "snacks" can seriously affect your diet.') }}</span>
                                    </li>
                                </ol>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">
                                    {{ __('Additional Resources') }}
                                </h2>
                                <p class="mt-3">
                                    {{ __('For more information on healthy eating, visit the official website of the') }}
                                    <a href="https://www.who.int/" target="_blank" rel="noopener" class="font-semibold text-amber-700 hover:text-amber-800 underline">
                                        {{ __('World Health Organization (WHO)') }}
                                    </a>.
                                </p>
                            </section>
                        </div>

                        <div class="mt-10 rounded-[1.5rem] border border-stone-200 bg-stone-50 p-5 sm:p-6">
                            <div class="text-sm font-semibold text-stone-500">{{ __('Next step') }}</div>
                            <div class="mt-1 text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('Track your meals for a week') }}</div>
                            <div class="mt-2 text-sm sm:text-base text-stone-600">{{ __('Awareness beats perfection. Start logging — you’ll learn your real baseline fast.') }}</div>
                            <div class="mt-5 flex flex-col sm:flex-row gap-3">
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
    </div>

</x-app-layout>
