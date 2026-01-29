<x-app-layout :full-width="true">

    @section('title', __('5 Tips for Effective Weight Loss'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn the 5 most effective tips for weight loss, from creating a calorie deficit to choosing the right foods.') }}">
        <meta name="keywords" content="{{ __('weight loss tips, how to lose weight, calories, weight control, nutrition') }}">
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
                        <span>{{ __('Habits') }}</span>
                        <span class="text-stone-400">•</span>
                        <span>{{ __('5 min read') }}</span>
                        <span class="text-stone-400">•</span>
                        <time datetime="2025-09-05">{{ \Carbon\Carbon::parse('2025-09-05')->translatedFormat('d M Y') }}</time>
                    </div>

                    <h1 class="mt-4 text-[clamp(2rem,4.6vw,3rem)] leading-[1.06] font-extrabold tracking-tight text-stone-900">
                        <span class="bg-gradient-to-b from-stone-900 to-stone-700 bg-clip-text text-transparent">
                            {{ __('5 Tips for Effective Weight Loss') }}
                        </span>
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-relaxed text-stone-600">
                        {{ __('Five practical habits you can repeat every week — the boring basics that actually work.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 pb-14">
            <div class="max-w-3xl mx-auto">
                <div class="-mt-4 sm:-mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="aspect-[16/9] bg-stone-100 overflow-hidden">
                        <img src="/images/blog/blog-2.webp" alt="{{ __('5 Tips for Weight Loss') }}" class="h-full w-full object-cover" />
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="space-y-10 text-stone-700 leading-relaxed">
                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('1. Create a Calorie Deficit') }}</h2>
                                <p class="mt-3">{{ __('The main principle of weight loss is to consume fewer calories than your body burns. Use the TDEE (Total Daily Energy Expenditure) formula to determine how many calories you need and create a deficit of 10-20% from that number.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('2. Focus on High-Quality Foods') }}</h2>
                                <div class="mt-3 space-y-3">
                                    <p>{{ __('Choose foods rich in protein, healthy fats, and complex carbohydrates. For example:') }}</p>
                                    <ul class="mt-2 space-y-2">
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                            <span><span class="font-semibold text-stone-900">{{ __('Proteins:') }}</span> {{ __('chicken, fish, eggs, cheese.') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                            <span><span class="font-semibold text-stone-900">{{ __('Fats:') }}</span> {{ __('avocado, nuts, olive oil.') }}</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-sky-500 shrink-0"></span>
                                            <span><span class="font-semibold text-stone-900">{{ __('Carbohydrates:') }}</span> {{ __('buckwheat, oats, vegetables.') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('3. Drink More Water') }}</h2>
                                <p class="mt-3">{{ __('Water helps maintain metabolism, cleanse the body, and reduce hunger. Try to drink 1.5-2 liters of water per day.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('4. Physical Activity is Your Ally') }}</h2>
                                <p class="mt-3">{{ __('Regular physical activity helps not only burn calories but also maintain muscle mass. Even daily 30-minute walks will yield results.') }}</p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('5. Keep a Food Diary') }}</h2>
                                <p class="mt-3">
                                    {{ __('Record everything you eat to control calorie intake. Use the') }}
                                    <a href="{{ $primaryUrl }}" class="font-semibold text-amber-700 hover:text-amber-800 underline">{{ __('Calorize') }}</a>
                                    {{ __('app for simple and convenient food diary management.') }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight text-stone-900">{{ __('How Can Calorize Help?') }}</h2>
                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="rounded-2xl border border-stone-200 bg-white p-4">
                                        <div class="text-xs font-semibold text-stone-500">{{ __('Calorie Calculation') }}</div>
                                        <div class="mt-1 text-sm font-semibold text-stone-800">{{ __('Determine your calorie norm') }}</div>
                                    </div>
                                    <div class="rounded-2xl border border-stone-200 bg-white p-4">
                                        <div class="text-xs font-semibold text-stone-500">{{ __('Nutrition Control') }}</div>
                                        <div class="mt-1 text-sm font-semibold text-stone-800">{{ __('Log meals in seconds') }}</div>
                                    </div>
                                    <div class="rounded-2xl border border-stone-200 bg-white p-4">
                                        <div class="text-xs font-semibold text-stone-500">{{ __('Progress') }}</div>
                                        <div class="mt-1 text-sm font-semibold text-stone-800">{{ __('Track weight changes') }}</div>
                                    </div>
                                </div>
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