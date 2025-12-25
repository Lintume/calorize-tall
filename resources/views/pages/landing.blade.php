<x-app-layout>

    @section('title', __('Calorize — AI Food Diary & Calorie Tracker'))

    @section('meta')
        <meta name="description"
              content="{{ __('Calorize is an AI-powered food diary and calorie tracker. Log meals by chat or voice, pick the right product variant from your history, track calories & macros, and use an 85,000+ Ukrainian product database.') }}">
        <meta name="keywords"
              content="{{ __('AI calorie tracker, AI food diary, calorie diary, macro tracker, calorie counting app, nutrition tracker, Ukrainian product database, recipes, weight loss') }}">
        <meta name="author" content="Calorize">
    @endsection

    <!-- Main Header with Gradient -->
    <header class="
        text-black
        py-16
        px-4
        overflow-hidden
        relative"
            data-aos="fade-up" data-aos-duration="1000">

        <!-- Decorative Floating Shapes -->
        <div class="absolute -top-10 -left-20 w-48 h-48 bg-amber-300 rounded-full opacity-30 animate-float"></div>
        <div class="absolute top-20 right-20 w-32 h-32 bg-pink-200 rounded-full opacity-30 animate-float"></div>

        <div class="container mx-auto text-center">
            <div class="flex flex-col items-center">

                <!-- Logo -->
                <img
                    src="/logo.png"
                    alt="Calorize Logo"
                    class="w-40 h-36 md:w-44 md:h-40 object-cover mb-3 z-10 relative"
                    style="object-position: top;"
                    data-aos="zoom-in"
                />

                <!-- Heading -->
                <h1 class="
                    text-4xl
                    md:text-6xl
                    font-bold
                    leading-tight
                    mb-3
                    relative
                    z-10
                " data-aos="fade-up" data-aos-delay="200">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-700 to-pink-800">Calorize</span>
                    <span class="text-gray-900"> {{ __('is an AI food diary') }}</span>
                </h1>

                <!-- Short Description -->
                <div class="mt-2 max-w-2xl mx-auto font-sans relative z-10" data-aos="fade-up" data-aos-delay="400">
                    <p class="text-lg text-gray-800">
                        <span class="font-semibold text-gray-900">{{ __('Type it.') }}</span>
                        <span class="font-semibold text-gray-900">{{ __('Say it.') }}</span>
                        <span>{{ __('The AI logs it — with calories and macros.') }}</span>
                    </p>

                    <div class="mt-4 flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-sm font-medium text-gray-800 shadow-sm border border-gray-200">
                            {{ __('A bowl of borscht') }}
                        </span>
                        <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-sm font-medium text-gray-800 shadow-sm border border-gray-200">
                            {{ __('2 eggs') }}
                        </span>
                        <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-sm font-medium text-gray-800 shadow-sm border border-gray-200">
                            {{ __('coffee with milk') }}
                        </span>
                    </div>

                    <p class="mt-4 text-base text-gray-700">
                        {{ __('Calorize finds the right product (including your usual variant), chooses a sensible portion, and adds it to the correct meal.') }}
                    </p>
                </div>

                <!-- Quick value bullets -->
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3 max-w-3xl w-full" data-aos="fade-up" data-aos-delay="500">
                    <div class="bg-white rounded-xl px-4 py-3 shadow-sm border border-gray-200">
                        <p class="text-sm font-semibold text-gray-900">{{ __('Chat-first logging') }}</p>
                        <p class="text-xs text-gray-600">{{ __('Text or voice → saved to diary') }}</p>
                    </div>
                    <div class="bg-white rounded-xl px-4 py-3 shadow-sm border border-gray-200">
                        <p class="text-sm font-semibold text-gray-900">{{ __('Smarter matches') }}</p>
                        <p class="text-xs text-gray-600">{{ __('Uses your recent entries to disambiguate') }}</p>
                    </div>
                    <div class="bg-white rounded-xl px-4 py-3 shadow-sm border border-gray-200">
                        <p class="text-sm font-semibold text-gray-900">{{ __('85,000+ foods') }}</p>
                        <p class="text-xs text-gray-600">{{ __('Ukrainian products & local dishes') }}</p>
                    </div>
                </div>

                <!-- Call-to-Action Button -->
                <a
                    href="{{ route('register') }}"
                    class="
                        mt-7
                        inline-block
                        bg-amber-700
                        text-white
                        font-semibold
                        px-8
                        py-3
                        rounded-full
                        shadow-lg
                        hover:bg-amber-800
                        transition-colors
                        relative
                        z-10
                    "
                    data-aos="fade-up" data-aos-delay="600"
                >
                    {{ __('Start Free') }}
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="font-sans relative">

        <!-- Decorative Floating Shapes for Section -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-pink-300 rounded-full opacity-20 animate-float"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 bg-amber-400 rounded-full opacity-30 animate-float"></div>

        <!-- Why Choose Calorize -->
        <section class="container mx-auto px-4 py-8 bg-amber-50 rounded-lg shadow-lg">
            <h2 class="
                text-4xl
                md:text-5xl
                font-fancy-heading
                font-bold
                text-center
                mb-12
                text-amber-900
            " data-aos="fade-up">
                {{ __('Why Calorize? Simple, fast, and powered by AI') }}
            </h2>
            <p class="text-lg max-w-3xl mx-auto text-center mb-8 text-gray-800">
                {{ __('Most calorie apps fail because logging is tedious. Calorize flips it: you describe your food in a message, the AI understands it, finds the right product, and updates your diary. You stay consistent — results follow.') }}
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('diary') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-wand-magic-sparkles text-2xl"></i>
                            <span>{{ __('AI Diary Assistant') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Add, edit, delete, or copy meals by chat. Short messages work, and recent history helps pick the right variant — but your words always win (e.g. “lean”).') }}
                        </p>
                    </a>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('product.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-apple-whole text-2xl"></i>
                            <span>{{ __('85,000+ Products (Ukraine)') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Search fast, pick exact matches, and stop guessing. Great for branded foods, supermarket products, and everyday staples.') }}
                        </p>
                    </a>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('recipe.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-utensils text-2xl"></i>
                            <span>{{ __('Recipes that actually work') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Build your recipes from ingredients (even other recipes), keep nutrition per 100g, and let Calorize handle the calculations for calories and macros.') }}
                        </p>
                    </a>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('statistic') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-chart-line text-2xl"></i>
                            <span>{{ __('Calories & macros made visible') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Track calories, proteins, fats, and carbs. See trends, stay on target, and adjust based on real data — not vibes.') }}
                        </p>
                    </a>
                </div>
            </div>
        </section>

        <!-- Built by a real user (trust / story) -->
        <section class="container py-12">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                    <div class="max-w-3xl">
                        <h2 class="text-3xl md:text-4xl font-bold text-amber-900 mb-3" data-aos="fade-up">
                            {{ __('Built with the heart of an engineer — and a daily user') }}
                        </h2>
                        <p class="text-gray-700 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                            {{ __('Calorize was created by a person who tracks food every day and continuously uses the product. The goal is simple: make calorie and macro tracking so effortless that you can stay consistent for months — not days.') }}
                        </p>
                        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="rounded-xl bg-amber-50 p-5">
                                <p class="font-semibold text-amber-900">{{ __('Less friction, more consistency') }}</p>
                                <p class="text-sm text-gray-700 mt-1">{{ __('The AI assistant reduces taps and choices — you just describe what you ate.') }}</p>
                            </div>
                            <div class="rounded-xl bg-amber-50 p-5">
                                <p class="font-semibold text-amber-900">{{ __('Practical features first') }}</p>
                                <p class="text-sm text-gray-700 mt-1">{{ __('Fast search, recipes, copy meals, edits, and a huge Ukrainian database — built for real-life use.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-96 lg:w-[420px]" data-aos="fade-up" data-aos-delay="250">
                        <div class="rounded-2xl bg-gradient-to-br from-amber-50 to-pink-50 border border-gray-100 p-7 text-left">
                            <p class="text-sm font-semibold text-gray-900">{{ __('A promise') }}</p>
                            <p class="mt-2 text-sm text-gray-700 leading-relaxed">
                                {{ __('We keep iterating based on real daily use — so the app stays simple, fast, and useful.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it works (SEO-friendly) -->
        <section class="container">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-3xl md:text-4xl font-bold text-amber-900 mb-4" data-aos="fade-up">
                    {{ __('How the AI calorie diary works') }}
                </h2>
                <p class="text-gray-700 max-w-3xl" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Calorize is a functional calorie counting app with an AI assistant. It understands natural language, finds products, and updates your diary with calories and macros.') }}
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="rounded-xl bg-amber-50 p-5">
                        <p class="font-semibold text-amber-900">{{ __('1) Tell it what you ate') }}</p>
                        <p class="text-sm text-gray-700 mt-1">{{ __('“a bowl of borscht”, “200g chicken”, “coffee with milk”') }}</p>
                    </div>
                    <div class="rounded-xl bg-amber-50 p-5">
                        <p class="font-semibold text-amber-900">{{ __('2) AI finds the right item') }}</p>
                        <p class="text-sm text-gray-700 mt-1">{{ __('Uses search + your recent diary to pick the most likely variant, and asks only when needed.') }}</p>
                    </div>
                    <div class="rounded-xl bg-amber-50 p-5">
                        <p class="font-semibold text-amber-900">{{ __('3) Your diary updates instantly') }}</p>
                        <p class="text-sm text-gray-700 mt-1">{{ __('Saved to the correct meal with grams and macros. Edit later by message.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-gradient-to-r from-red-100 to-yellow-100 py-14 mt-12 rounded-lg shadow-md" data-aos="zoom-in">
            <div class="container text-center px-4">
                <h2 class="text-4xl md:text-5xl font-fancy-heading font-bold mb-6 text-amber-900">
                    {{ __('Start tracking without the busywork') }}
                </h2>
                <p class="text-lg max-w-3xl mx-auto mb-8 leading-relaxed text-gray-800">
                    {{ __('Calorize keeps it simple: quick logging, accurate nutrition, and an AI assistant that helps you stay consistent. Create your account and try it today.') }}
                </p>
                <a
                    href="{{ route('register') }}"
                    class="bg-amber-700 text-white font-semibold px-8 py-3 rounded-full shadow-xl hover:bg-amber-800 transition-colors"
                >
                    {{ __('Create Account') }}
                </a>
            </div>
        </section>

        <!-- Blog Section -->
        <section class="container mx-auto py-16 px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-12 text-amber-900" data-aos="fade-up">
                {{ __('Our Blog') }}
            </h2>
            <div class="relative">
                <div class="carousel flex overflow-x-auto space-x-6 pb-3" data-aos="fade-up" data-aos-delay="200">
                    <!-- Blog Card 1 -->
                    <div class="bg-white rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
                        <img
                            src="/blog/blog-1.webp"
                            alt="{{ __('5 tips for effective weight loss') }}"
                            class="w-full h-40 object-cover rounded-t-xl"
                        />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-4 text-amber-800">
                                {{ __('5 tips for effective weight loss') }}
                            </h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ __('Learn how to achieve your ideal weight without harming your health.') }}
                            </p>
                            <a
                                href="{{ route('blog-2') }}"
                                class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                            >
                                {{ __('Read more') }}
                            </a>
                        </div>
                    </div>
                    <!-- Blog Card 2 -->
                    <div class="bg-white rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
                        <img
                            src="/blog/blog-2.webp"
                            alt="{{ __('How to count calories correctly?') }}"
                            class="w-full h-40 object-cover rounded-t-xl"
                        />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-4 text-amber-800">
                                {{ __('How to count calories correctly?') }}
                            </h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ __('Step by step: Learn how calorie counting can change your life.') }}
                            </p>
                            <a
                                href="{{ route('blog-1') }}"
                                class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                            >
                                {{ __('Read more') }}
                            </a>
                        </div>
                    </div>
                    <!-- Blog Card 3 -->
                    <div class="bg-white rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
                        <img
                            src="/blog/blog-3.webp"
                            alt="{{ __('Top 10 healthy foods') }}"
                            class="w-full h-40 object-cover rounded-t-xl"
                        />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-4 text-amber-800">
                                {{ __('Top 10 healthy foods') }}
                            </h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ __('A list of foods that will help you stay healthy and active.') }}
                            </p>
                            <a
                                href="{{ route('blog-3') }}"
                                class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                            >
                                {{ __('Read more') }}
                            </a>
                        </div>
                    </div>
                    <!-- Blog Card 4 -->
                    <div class="bg-white rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
                        <img
                            src="/blog/blog-4.webp"
                            alt="{{ __('Why is water important for weight loss?') }}"
                            class="w-full h-40 object-cover rounded-t-xl"
                        />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-4 text-amber-800">
                                {{ __('Why is water important for weight loss?') }}
                            </h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ __('Find out why water is your best ally in weight management.') }}
                            </p>
                            <a
                                href="{{ route('blog-4') }}"
                                class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                            >
                                {{ __('Read more') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View All Articles Button -->
            <div class="text-center mt-8">
                <a
                    href="{{ route('blog') }}"
                    class="bg-amber-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-amber-800 transition-colors"
                >
                    {{ __('View All Articles') }}
                </a>
            </div>
        </section>

    </div>

</x-app-layout>
