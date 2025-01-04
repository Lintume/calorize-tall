<x-app-layout>

    @section('title', __('Calorize - Your assistant in calorie control'))

    @section('meta')
        <meta name="description"
              content="{{ __('Keep a calorie diary easily and effectively with our app. Control your diet, achieve your goals, and track your progress.') }}">
        <meta name="keywords"
              content="{{ __('calorie diary, diet control, weight loss, healthy eating, calorie counting app') }}">
        <meta name="author" content="Calorize">
    @endsection

    <!-- Main Header -->
    <header class="bg-amber-700 text-white py-10 px-4">
        <div class="container mx-auto text-center">
            <div class="flex flex-col items-center">
                <!-- Logo -->
                <img
                    src="/logo.png"
                    alt="Calorize Logo"
                    class="w-28 h-24 object-cover mb-3"
                    style="object-position: top;"
                />

                <!-- H1 Title -->
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Calorize<br>
                    {{ __('Your Companion for Healthy Eating') }}
                </h1>

                <!-- Short Description -->
                <p class="mt-4 text-lg max-w-xl mx-auto">
                    {{ __('Reach your dietary goals faster using our handy') }}
                    <a href="{{ route('register') }}" class="underline hover:text-amber-300">{{ __('calorie diary') }}</a>.
                </p>

                <!-- Action Button -->
                <a
                    href="{{ route('register') }}"
                    class="mt-6 inline-block bg-white text-amber-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-amber-100 transition-colors"
                >
                    {{ __('Register now') }}
                </a>
            </div>
        </div>
    </header>


    <!-- Main Content -->
    <div class="py-12">

        <!-- Why Calorize Section -->
        <section class="container mx-auto px-4 py-8 bg-amber-50 rounded-md">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">
                {{ __('Why choose Calorize?') }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Card 1: Calorie Calculation -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('personal') }}" class="block">
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-calculator text-2xl text-amber-700"></i>
                            <span>{{ __('Calorie calculation') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Determine your daily calorie norm in seconds using scientific formulas.') }}
                        </p>
                    </a>
                </div>

                <!-- Card 2: Large Product Database -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('product.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-apple-whole text-2xl text-amber-700"></i>
                            <span>{{ __('Large product database') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Search thousands of products with detailed information about calories, proteins, fats, and carbohydrates.') }}
                        </p>
                    </a>
                </div>

                <!-- Card 3: Progress Charts -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('statistic') }}" class="block">
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-chart-line text-2xl text-amber-700"></i>
                            <span>{{ __('Progress charts') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Monitor your weight and macronutrients with convenient charts.') }}
                        </p>
                    </a>
                </div>

                <!-- Card 4: Custom Recipes -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <a href="{{ route('recipe.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-2 flex items-center space-x-4">
                            <i class="fa-solid fa-utensils text-2xl text-amber-700"></i>
                            <span>{{ __('Custom recipes') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Create your own recipes and automatically calculate their calories.') }}
                        </p>
                    </a>
                </div>

            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-amber-100 py-12 mt-12 rounded-lg">
            <div class="container mx-auto text-center px-4">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    {{ __('Start your journey to healthy eating today!') }}
                </h2>
                <p class="text-lg max-w-2xl mx-auto mb-6 leading-relaxed">
                    {{ __('Calorize helps you become the best version of yourself. Simple, convenient, and effective.') }}
                </p>
                <a
                    href="{{ route('register') }}"
                    class="bg-amber-700 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-amber-800 transition-colors"
                >
                    {{ __('Create an account') }}
                </a>
            </div>
        </section>

        <!-- Відгуки -->
        <section class="container mx-auto py-12 px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">
                {{ __('Reviews from our users') }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Відгук 1 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <p class="italic text-gray-700">
                        {{ __('“Calorize has become my indispensable assistant in losing weight. Now I can easily control my diet and see results!”') }}
                    </p>
                    <p class="text-right font-semibold mt-4 text-gray-800">
                        – {{ __('Olha, 29 years old') }}
                    </p>
                </div>
                <!-- Відгук 2 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <p class="italic text-gray-700">
                        {{ __('“Finally, an app that meets all my needs. Convenient interface, a huge product database, and the motivation to stick to my plan!”') }}
                    </p>
                    <p class="text-right font-semibold mt-4 text-gray-800">
                        – {{ __('Dmytro, 35 years old') }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Блог (карусель) -->
        <section class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">
                {{ __('Our Blog') }}
            </h2>
            <div class="relative">
                <div class="carousel flex overflow-x-auto space-x-4">
                    <!-- Картка блогу 1 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            {{ __('5 tips for effective weight loss') }}
                        </h3>
                        <p class="text-gray-600">
                            {{ __('Learn how to achieve your ideal weight without harming your health.') }}
                        </p>
                        <a
                            href="{{ route('blog-2') }}"
                            class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                        >
                            {{ __('Read more') }}
                        </a>
                    </div>

                    <!-- Картка блогу 2 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            {{ __('How to count calories correctly?') }}
                        </h3>
                        <p class="text-gray-600">
                            {{ __('Step by step: Learn how calorie counting can change your life.') }}
                        </p>
                        <a
                            href="{{ route('blog-1') }}"
                            class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                        >
                            {{ __('Read more') }}
                        </a>
                    </div>

                    <!-- Картка блогу 3 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            {{ __('Top 10 healthy foods') }}
                        </h3>
                        <p class="text-gray-600">
                            {{ __('A list of foods that will help you stay healthy and active.') }}
                        </p>
                        <a
                            href="{{ route('blog-3') }}"
                            class="text-amber-700 hover:underline mt-4 inline-block font-medium"
                        >
                            {{ __('Read more') }}
                        </a>
                    </div>

                    <!-- Картка блогу 4 -->
                    <div class="bg-white p-6 rounded-lg shadow w-[300px] flex-shrink-0 hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2">
                            {{ __('Why is water important for weight loss?') }}
                        </h3>
                        <p class="text-gray-600">
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
        </section>

    </div>

</x-app-layout>
