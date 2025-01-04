<x-app-layout>

    @section('title', __('About Us — Calorize'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn about the Ukrainian app Calorize, its founders, and mission. A simple and convenient tool for calorie control.') }}">
        <meta name="keywords" content="{{ __('about us, Calorize, Lialia Sakhno, Uliana Sakhno, calorie control, Ukrainian product') }}">
        <meta name="author" content="Calorize">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-3xl font-bold text-center">{{ __('About Us') }}</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <section class="text-center">
                    <img src="{{ asset('images/Lialia&Uliana.jpg') }}" alt="{{ __('Lialia and Uliana Sakhno') }}" class="w-48 h-48 mx-auto rounded-full shadow mb-6 object-cover">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Lialia and Uliana Sakhno') }}</h2>
                    <p class="text-gray-700 text-lg">{{ __('Founders and inspiration behind Calorize') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Our Story') }}</h2>
                    <p class="text-gray-800 leading-relaxed mb-4">
                        {{ __('Calorize was born out of a real need. Seven years ago, I, Lialia Sakhno, decided to lose weight and started searching for the perfect app that met all my requirements: simplicity, scientific accuracy, precision, and no unnecessary features. Unfortunately, I couldn’t find such a tool. All existing apps were either too gamified or lacked precise calculations for custom recipes, including adjustments for evaporation or moisture loss during cooking.') }}
                    </p>
                    <p class="text-gray-800 leading-relaxed">
                        {{ __('That’s why I decided to create my own app with a focus on convenience, functionality, and minimalism. Calorize is the result of my years of programming experience and my desire to help others achieve their healthy eating goals.') }}
                    </p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Our Team') }}</h2>
                    <p class="text-gray-800 leading-relaxed mb-4">
                        {{ __('I am Lialia Sakhno, an experienced Laravel developer with many years of expertise in working on complex projects. In this project, I am responsible for all the code, from the backend to the design. Since I specialize more in backend development, creating the design was a challenge for me, but I thoroughly enjoyed overcoming it.') }}
                    </p>
                    <p class="text-gray-800 leading-relaxed">
                        {{ __('My girlfriend, Uliana Sakhno, helps me test the app and find ways to make it even better. Together, we aim to create a product that becomes a reliable assistant for everyone who has chosen the path to a healthy lifestyle.') }}
                    </p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Our Mission') }}</h2>
                    <p class="text-gray-800 leading-relaxed">
                        {{ __('We believe that everyone deserves a convenient and accurate tool to monitor their diet. Our mission is to help people become healthier and achieve their dietary goals without unnecessary complications.') }}
                    </p>
                    <p class="text-gray-800 leading-relaxed">
                        {{ __('Simplicity, minimalism, precision, and scientific approach are the core values we instill in Calorize.') }}
                    </p>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Why Choose Calorize?') }}</h2>
                    <ul class="list-disc list-inside text-gray-800 leading-relaxed mb-4">
                        <li>{{ __('Simple and intuitive interface') }}</li>
                        <li>{{ __('Accurate calculations of calories, proteins, fats, and carbohydrates') }}</li>
                        <li>{{ __('Unique feature to create custom recipes considering the cooking method') }}</li>
                        <li>{{ __('Tools to track progress and achieve goals') }}</li>
                    </ul>
                </section>

                <section class="my-8">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Our Plans') }}</h2>
                    <p class="text-gray-800 leading-relaxed mb-4">
                        {{ __('In the future, we plan to add new features such as a barcode scanner for easy product addition, AI-powered tools for creating personalized meal plans, and an expanded product database.') }}
                    </p>
                </section>

                <section class="text-center my-8">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Thank You for Choosing Us!') }}</h2>
                    <p class="text-gray-800 leading-relaxed mb-6">
                        {{ __('We believe that together with you, we can create a healthy and inspiring future for everyone.') }}
                    </p>
                    <a href="{{ route('register') }}" class="bg-amber-600 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-amber-700">
                        {{ __('Join Calorize') }}
                    </a>
                </section>
            </div>
        </div>
    </div>

</x-app-layout>
