<x-app-layout>

    @section('title', __('Calorize — AI Food Diary & Calorie Tracker'))

    @section('meta')
        <meta name="description"
              content="{{ __('Calorize is an AI-powered food diary and calorie tracker. Log meals by chat or voice, pick the right product variant from your history, track calories & macros, and use an 85,000+ Ukrainian product database.') }}">
        <meta name="keywords"
              content="{{ __('AI calorie tracker, AI food diary, calorie diary, macro tracker, calorie counting app, nutrition tracker, Ukrainian product database, recipes, weight loss') }}">
        <meta name="author" content="Calorize">
    @endsection

    <div class="min-h-screen bg-gradient-to-b from-amber-50/50 via-white to-stone-50">

        <!-- Hero Section -->
        <section class="relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-amber-200/40 to-pink-200/30 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 -left-24 w-80 h-80 bg-gradient-to-tr from-amber-100/50 to-orange-100/40 rounded-full blur-3xl"></div>
            </div>

            <div class="relative max-w-5xl mx-auto px-6 lg:px-8 pt-20 pb-28 lg:pt-28 lg:pb-36">
                <div class="text-center">

                    <!-- Logo (cropped bottom to hide text) -->
                    <div class="mb-6 mx-auto w-36 lg:w-44 overflow-hidden" style="aspect-ratio: 1 / 0.82;">
                <img
                    src="/logo.png"
                    alt="Calorize Logo"
                            class="w-full drop-shadow-lg"
                />
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight mb-8">
                        <span class="bg-gradient-to-r from-amber-600 via-amber-700 to-orange-700 bg-clip-text text-transparent" style="font-family: 'Maven Pro', sans-serif; font-weight: 500;">Calorize</span>
                        <span class="block text-3xl sm:text-4xl lg:text-5xl font-medium text-stone-800 mt-4">
                            {{ __('is an AI food diary') }}
                        </span>
                </h1>

                    <!-- Tagline -->
                    <p class="text-xl sm:text-2xl text-stone-600 max-w-2xl mx-auto leading-relaxed mb-10">
                        <span class="font-semibold text-stone-800">{{ __('Type it.') }}</span>
                        <span class="font-semibold text-stone-800">{{ __('Say it.') }}</span>
                        <br class="hidden sm:block">
                        <span>{{ __('The AI logs it — with calories and macros.') }}</span>
                    </p>

                    <!-- Example chips -->
                    <div class="flex flex-wrap justify-center gap-3 lg:gap-4 mb-12">
                        <span class="px-5 py-2.5 text-base text-stone-700 bg-white/80 backdrop-blur rounded-full shadow-sm border border-stone-200/60">
                            {{ __('A bowl of borscht') }}
                        </span>
                        <span class="px-5 py-2.5 text-base text-stone-700 bg-white/80 backdrop-blur rounded-full shadow-sm border border-stone-200/60">
                            {{ __('2 eggs') }}
                        </span>
                        <span class="px-5 py-2.5 text-base text-stone-700 bg-white/80 backdrop-blur rounded-full shadow-sm border border-stone-200/60">
                            {{ __('coffee with milk') }}
                        </span>
                    </div>

                    <!-- CTA -->
                    <div>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-10 py-5 text-lg font-semibold text-white bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 rounded-full shadow-xl shadow-amber-600/25 hover:shadow-amber-700/30 transition-all duration-300 transform hover:scale-[1.02]">
                            {{ __('Start Free') }}
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                        <p class="text-sm text-stone-500 mt-5">{{ __('Free to use') }} · {{ __('No credit card required') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Value Props -->
        <section class="py-24 lg:py-32 bg-white border-y border-stone-200/80">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-20">
                    <div class="text-center">
                        <div class="w-18 h-18 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 shadow-lg shadow-amber-100/50" style="width: 4.5rem; height: 4.5rem;">
                            <i class="fas fa-comments text-2xl text-amber-700"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-stone-900 mb-3">{{ __('Chat-first logging') }}</h3>
                        <p class="text-base text-stone-500 leading-relaxed">{{ __('Text or voice → saved to diary') }}</p>
                    </div>
                    <div class="text-center">
                        <div class="w-18 h-18 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 shadow-lg shadow-amber-100/50" style="width: 4.5rem; height: 4.5rem;">
                            <i class="fas fa-brain text-2xl text-amber-700"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-stone-900 mb-3">{{ __('Smarter matches') }}</h3>
                        <p class="text-base text-stone-500 leading-relaxed">{{ __('Uses your recent entries to disambiguate') }}</p>
                    </div>
                    <div class="text-center">
                        <div class="w-18 h-18 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 shadow-lg shadow-amber-100/50" style="width: 4.5rem; height: 4.5rem;">
                            <i class="fas fa-database text-2xl text-amber-700"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-stone-900 mb-3">{{ __('85,000+ foods') }}</h3>
                        <p class="text-base text-stone-500 leading-relaxed">{{ __('Ukrainian products & local dishes') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-24 lg:py-32">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16 lg:mb-20">
                    <h2 class="text-4xl sm:text-5xl font-bold text-stone-900 mb-6">
                        {{ __('Why Calorize?') }}
            </h2>
                    <p class="text-xl text-stone-600 max-w-3xl mx-auto leading-relaxed">
                        {{ __('Most calorie apps fail because logging is tedious. Calorize flips it: you describe your food in a message, the AI understands it, finds the right product, and updates your diary.') }}
            </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                    <a href="{{ route('diary') }}" class="group block p-8 lg:p-10 bg-gradient-to-br from-white to-amber-50/30 rounded-3xl border border-stone-200 hover:border-amber-300 hover:shadow-xl hover:shadow-amber-100/50 transition-all duration-300">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-600 to-amber-700 text-white shadow-lg shadow-amber-600/30">
                                <i class="fas fa-wand-magic-sparkles text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-stone-900 group-hover:text-amber-700 transition-colors">
                                {{ __('AI Diary Assistant') }}
                        </h3>
                        </div>
                        <p class="text-base text-stone-600 leading-relaxed">
                            {{ __('Add, edit, delete, or copy meals by chat. Short messages work, and recent history helps pick the right variant — but your words always win (e.g. "lean").') }}
                        </p>
                    </a>

                    <a href="{{ route('product.index') }}" class="group block p-8 lg:p-10 bg-gradient-to-br from-white to-amber-50/30 rounded-3xl border border-stone-200 hover:border-amber-300 hover:shadow-xl hover:shadow-amber-100/50 transition-all duration-300">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-600 to-amber-700 text-white shadow-lg shadow-amber-600/30">
                                <i class="fas fa-apple-whole text-xl"></i>
                </div>
                            <h3 class="text-2xl font-semibold text-stone-900 group-hover:text-amber-700 transition-colors">
                                {{ __('85,000+ Products (Ukraine)') }}
                        </h3>
                        </div>
                        <p class="text-base text-stone-600 leading-relaxed">
                            {{ __('Search fast, pick exact matches, and stop guessing. Great for branded foods, supermarket products, and everyday staples.') }}
                        </p>
                    </a>

                    <a href="{{ route('recipe.index') }}" class="group block p-8 lg:p-10 bg-gradient-to-br from-white to-amber-50/30 rounded-3xl border border-stone-200 hover:border-amber-300 hover:shadow-xl hover:shadow-amber-100/50 transition-all duration-300">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-600 to-amber-700 text-white shadow-lg shadow-amber-600/30">
                                <i class="fas fa-utensils text-xl"></i>
                </div>
                            <h3 class="text-2xl font-semibold text-stone-900 group-hover:text-amber-700 transition-colors">
                                {{ __('Recipes that actually work') }}
                        </h3>
                        </div>
                        <p class="text-base text-stone-600 leading-relaxed">
                            {{ __('Build your recipes from ingredients (even other recipes), keep nutrition per 100g, and let Calorize handle the calculations for calories and macros.') }}
                        </p>
                    </a>

                    <a href="{{ route('statistic') }}" class="group block p-8 lg:p-10 bg-gradient-to-br from-white to-amber-50/30 rounded-3xl border border-stone-200 hover:border-amber-300 hover:shadow-xl hover:shadow-amber-100/50 transition-all duration-300">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-600 to-amber-700 text-white shadow-lg shadow-amber-600/30">
                                <i class="fas fa-chart-line text-xl"></i>
                </div>
                            <h3 class="text-2xl font-semibold text-stone-900 group-hover:text-amber-700 transition-colors">
                                {{ __('Calories & macros made visible') }}
                        </h3>
                        </div>
                        <p class="text-base text-stone-600 leading-relaxed">
                            {{ __('Track calories, proteins, fats, and carbs. See trends, stay on target, and adjust based on real data — not vibes.') }}
                        </p>
                    </a>
                </div>
            </div>
        </section>

        <!-- How it works -->
        <section class="py-24 lg:py-32 bg-gradient-to-br from-stone-900 via-stone-900 to-stone-800 text-white relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-amber-600/10 rounded-full blur-3xl"></div>
            </div>

            <div class="max-w-6xl mx-auto px-6 lg:px-8 relative">
                <div class="text-center mb-16 lg:mb-20">
                    <h2 class="text-4xl sm:text-5xl font-bold mb-6">
                        {{ __('How the AI calorie diary works') }}
                        </h2>
                    <p class="text-xl text-stone-400 max-w-3xl mx-auto leading-relaxed">
                        {{ __('Calorize is a functional calorie counting app with an AI assistant. It understands natural language, finds products, and updates your diary with calories and macros.') }}
                        </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 lg:gap-16">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-full bg-gradient-to-br from-amber-500 to-amber-600 text-white text-3xl font-bold shadow-2xl shadow-amber-500/30">
                            1
                            </div>
                        <h3 class="text-xl font-semibold mb-4">{{ __('1) Tell it what you ate') }}</h3>
                        <p class="text-stone-400 leading-relaxed">{{ __('"a bowl of borscht", "200g chicken", "coffee with milk"') }}</p>
                            </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-full bg-gradient-to-br from-amber-500 to-amber-600 text-white text-3xl font-bold shadow-2xl shadow-amber-500/30">
                            2
                        </div>
                        <h3 class="text-xl font-semibold mb-4">{{ __('2) AI finds the right item') }}</h3>
                        <p class="text-stone-400 leading-relaxed">{{ __('Uses search + your recent diary to pick the most likely variant, and asks only when needed.') }}</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-full bg-gradient-to-br from-amber-500 to-amber-600 text-white text-3xl font-bold shadow-2xl shadow-amber-500/30">
                            3
                        </div>
                        <h3 class="text-xl font-semibold mb-4">{{ __('3) Your diary updates instantly') }}</h3>
                        <p class="text-stone-400 leading-relaxed">{{ __('Saved to the correct meal with grams and macros. Edit later by message.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Story Section -->
        <section class="py-24 lg:py-32">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-14 lg:mb-16">
                    <h2 class="text-4xl sm:text-5xl font-bold text-stone-900 mb-6">
                        {{ __('Built with the heart of an engineer — and a daily user') }}
                </h2>
                    <p class="text-xl text-stone-600 max-w-4xl mx-auto leading-relaxed">
                        {{ __('Calorize was created by a person who tracks food every day and continuously uses the product. The goal is simple: make calorie and macro tracking so effortless that you can stay consistent for months — not days.') }}
                </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 lg:gap-10 max-w-4xl mx-auto">
                    <div class="p-8 lg:p-10 bg-gradient-to-br from-amber-50 to-white rounded-2xl border border-amber-200/50">
                        <div class="w-14 h-14 mb-5 flex items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                            <i class="fas fa-bolt text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-stone-900 mb-3">{{ __('Less friction, more consistency') }}</h3>
                        <p class="text-base text-stone-600 leading-relaxed">{{ __('The AI assistant reduces taps and choices — you just describe what you ate.') }}</p>
                    </div>
                    <div class="p-8 lg:p-10 bg-gradient-to-br from-amber-50 to-white rounded-2xl border border-amber-200/50">
                        <div class="w-14 h-14 mb-5 flex items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                            <i class="fas fa-wrench text-2xl"></i>
                    </div>
                        <h3 class="text-xl font-semibold text-stone-900 mb-3">{{ __('Practical features first') }}</h3>
                        <p class="text-base text-stone-600 leading-relaxed">{{ __('Fast search, recipes, copy meals, edits, and a huge Ukrainian database — built for real-life use.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-28 lg:py-36 bg-gradient-to-br from-amber-600 via-amber-600 to-orange-600 text-white relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500/30 rounded-full blur-3xl"></div>
            </div>

            <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-8">
                    {{ __('Start tracking without the busywork') }}
                </h2>
                <p class="text-xl lg:text-2xl text-amber-100 mb-12 leading-relaxed max-w-3xl mx-auto">
                    {{ __('Calorize keeps it simple: quick logging, accurate nutrition, and an AI assistant that helps you stay consistent. Create your account and try it today.') }}
                </p>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center px-12 py-5 text-lg font-semibold text-amber-700 bg-white hover:bg-amber-50 rounded-full shadow-2xl shadow-black/20 transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('Create Account') }}
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </section>

        <!-- Blog Section -->
        <section class="py-24 lg:py-32 bg-white">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between mb-14 lg:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-stone-900">
                {{ __('Our Blog') }}
            </h2>
                    <a href="{{ route('blog') }}" class="text-base text-amber-700 hover:text-amber-800 font-semibold flex items-center gap-2">
                        {{ __('View All Articles') }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
                    <!-- Blog Card 1 -->
                    <a href="{{ route('blog-2') }}" class="group">
                        <div class="aspect-[4/3] rounded-2xl overflow-hidden mb-5 bg-stone-100 shadow-lg">
                            <img src="/blog/blog-1.webp"
                            alt="{{ __('5 tips for effective weight loss') }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-900 group-hover:text-amber-700 transition-colors mb-2">
                                {{ __('5 tips for effective weight loss') }}
                            </h3>
                        <p class="text-base text-stone-500 line-clamp-2">
                                {{ __('Learn how to achieve your ideal weight without harming your health.') }}
                            </p>
                            </a>

                    <!-- Blog Card 2 -->
                    <a href="{{ route('blog-1') }}" class="group">
                        <div class="aspect-[4/3] rounded-2xl overflow-hidden mb-5 bg-stone-100 shadow-lg">
                            <img src="/blog/blog-2.webp"
                            alt="{{ __('How to count calories correctly?') }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-900 group-hover:text-amber-700 transition-colors mb-2">
                                {{ __('How to count calories correctly?') }}
                            </h3>
                        <p class="text-base text-stone-500 line-clamp-2">
                                {{ __('Step by step: Learn how calorie counting can change your life.') }}
                            </p>
                            </a>

                    <!-- Blog Card 3 -->
                    <a href="{{ route('blog-3') }}" class="group">
                        <div class="aspect-[4/3] rounded-2xl overflow-hidden mb-5 bg-stone-100 shadow-lg">
                            <img src="/blog/blog-3.webp"
                            alt="{{ __('Top 10 healthy foods') }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-900 group-hover:text-amber-700 transition-colors mb-2">
                                {{ __('Top 10 healthy foods') }}
                            </h3>
                        <p class="text-base text-stone-500 line-clamp-2">
                                {{ __('A list of foods that will help you stay healthy and active.') }}
                            </p>
                            </a>

                    <!-- Blog Card 4 -->
                    <a href="{{ route('blog-4') }}" class="group">
                        <div class="aspect-[4/3] rounded-2xl overflow-hidden mb-5 bg-stone-100 shadow-lg">
                            <img src="/blog/blog-4.webp"
                            alt="{{ __('Why is water important for weight loss?') }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        </div>
                        <h3 class="text-lg font-semibold text-stone-900 group-hover:text-amber-700 transition-colors mb-2">
                                {{ __('Why is water important for weight loss?') }}
                            </h3>
                        <p class="text-base text-stone-500 line-clamp-2">
                                {{ __('Find out why water is your best ally in weight management.') }}
                            </p>
                            </a>
                </div>
            </div>
        </section>

    </div>

</x-app-layout>
