<x-app-layout>

    @section('title', __('Calorize - Your Ultimate Path to Healthy Eating'))

    @section('meta')
        <meta name="description"
              content="{{ __('Calorize is your intuitive daily calorie diary with an extensive product database (85,000+ items) from Ukrainian supermarkets and local dishes. Achieve your goals easily.') }}">
        <meta name="keywords"
              content="{{ __('calorie diary, diet control, weight loss, healthy eating, calorie counting app, Ukrainian cuisine, large product database') }}">
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
        <div class="container mx-auto text-center">
            <div class="flex flex-col items-center">

                <!-- Logo -->
                <img
                    src="/logo.png"
                    alt="Calorize Logo"
                    class="w-28 h-24 object-cover mb-4 z-10 relative"
                    style="object-position: top;"
                    data-aos="zoom-in"
                />

                <h1 class="text-5xl md:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-700 to-pink-800 mb-3">
                    Calorize
                </h1>
                <!-- Heading -->
                <h1 class="
                    text-5xl
                    md:text-6xl
                    font-bold
                    leading-tight
                    mb-4
                    relative
                    z-10
                " data-aos="fade-up" data-aos-delay="200">

                    {{ __('The Easiest Way to Master Your Diet') }}
                </h1>

                <!-- Short Description -->
                <p class="mt-2 text-lg max-w-2xl mx-auto font-sans relative z-10" data-aos="fade-up" data-aos-delay="400">
                    {{ __('Discover a whole new level of simplicity in tracking your nutrition. With an impressive database of over 85,000 items—from supermarket staples to homemade Ukrainian recipes—Calorize has you covered.') }}
                </p>

                <!-- Call-to-Action Button -->
                <a
                    href="{{ route('register') }}"
                    class="
                        mt-8
                        inline-block
                        bg-white
                        text-amber-700
                        font-semibold
                        px-8
                        py-3
                        rounded-full
                        shadow-lg
                        hover:bg-amber-100
                        transition-colors
                        relative
                        z-10
                    "
                    data-aos="fade-up" data-aos-delay="600"
                >
                    {{ __('Register Now') }}
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="font-sans">

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
                {{ __('Why Choose Calorize?') }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('personal') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-calendar-check text-2xl"></i>
                            <span>{{ __('Intuitive Daily Diary') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Log your meals in seconds without any hassle. We’ve streamlined the process so you can focus on your goals—not on tedious data entry.') }}
                        </p>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('product.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-apple-whole text-2xl"></i>
                            <span>{{ __('85,000+ Products') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Access the largest collection of items—from everyday supermarket brands to iconic Ukrainian dishes. Track calories, proteins, fats, and carbs with ease.') }}
                        </p>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('recipe.index') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-utensils text-2xl"></i>
                            <span>{{ __('Surgical Recipe Precision') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Create or combine your own recipes with pinpoint accuracy. Include existing recipes as ingredients, account for cooking methods, and let Calorize handle the math.') }}
                        </p>
                    </a>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('statistic') }}" class="block">
                        <h3 class="text-xl font-semibold mb-3 flex items-center space-x-4 text-amber-800">
                            <i class="fa-solid fa-chart-line text-2xl"></i>
                            <span>{{ __('Visual Progress Tracking') }}</span>
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ __('Stay motivated with clear graphs that display your progress. Monitor weight changes, macros, and more—all in a single dashboard.') }}
                        </p>
                    </a>
                </div>

            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-gradient-to-r from-red-100 to-yellow-100 py-14 mt-12 rounded-lg shadow-md" data-aos="zoom-in">
            <div class="container mx-auto text-center px-4">
                <h2 class="text-4xl md:text-5xl font-fancy-heading font-bold mb-6 text-amber-900">
                    {{ __('Take Control of Your Diet Today!') }}
                </h2>
                <p class="text-lg max-w-3xl mx-auto mb-8 leading-relaxed text-gray-800">
                    {{ __('Join thousands of users who’ve transformed their eating habits. Whether you aim to lose weight, gain muscle, or simply eat healthier—Calorize is your partner every step of the way.') }}
                </p>
                <a
                    href="{{ route('register') }}"
                    class="bg-amber-700 text-white font-semibold px-8 py-3 rounded-full shadow-xl hover:bg-amber-800 transition-colors"
                >
                    {{ __('Create My Account') }}
                </a>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="container mx-auto py-12 px-4 bg-amber-50 rounded-lg shadow-lg mt-16">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-12 text-amber-900" data-aos="fade-up">
                {{ __('Reviews from our users') }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-up" data-aos-delay="200">
                <!-- Review 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow">
                    <p class="italic text-gray-700 leading-relaxed">
                        {{ __('“Calorize has become my indispensable assistant in losing weight. Now I can easily control my diet and see results!”') }}
                    </p>
                    <p class="text-right font-semibold mt-4 text-amber-800">
                        – {{ __('Olha, 29 years old') }}
                    </p>
                </div>
                <!-- Review 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow">
                    <p class="italic text-gray-700 leading-relaxed">
                        {{ __('“Finally, an app that meets all my needs. Convenient interface, a huge product database, and the motivation to stick to my plan!”') }}
                    </p>
                    <p class="text-right font-semibold mt-4 text-amber-800">
                        – {{ __('Dmytro, 35 years old') }}
                    </p>
                </div>
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
                    <div class="bg-white p-8 rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
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
                    <!-- Blog Card 2 -->
                    <div class="bg-white p-8 rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
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
                    <!-- Blog Card 3 -->
                    <div class="bg-white p-8 rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
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
                    <!-- Blog Card 4 -->
                    <div class="bg-white p-8 rounded-xl shadow-lg w-[300px] flex-shrink-0 hover:shadow-2xl transition-shadow">
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
        </section>


    </div>

</x-app-layout>
