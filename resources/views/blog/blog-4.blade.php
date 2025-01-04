<x-app-layout>

    @section('title', __('Why Water is Important for Weight Loss?'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn why water is a key factor in the weight loss process. From boosting metabolism to controlling appetite — all about the benefits of water.') }}">
        <meta name="keywords" content="{{ __('water for weight loss, benefits of water, weight loss, hydration') }}">
        <meta name="author" content="Calorize">
    @endsection

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                {{ __('Why Water is Important for Weight Loss?') }}
            </h1>
            <a href="{{ route('blog') }}" class="bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                {{ __('Back to Blog') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="https://i.ibb.co/VWVvQ9z/c3cff601-8932-40a8-a68e-86bb16da78e0.webp" alt="{{ __('Why Water is Important for Weight Loss?') }}" class="w-full h-auto mb-8">

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('1. Water Stimulates Metabolism') }}</h2>
                    <p class="mb-4">{{ __('Studies have shown that drinking 500 ml of water can increase the metabolic rate by 24-30% over the next few hours. This helps the body burn calories more efficiently.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('2. Appetite Control') }}</h2>
                    <p class="mb-4">{{ __('Often, the body confuses hunger with thirst. Drinking a glass of water before meals can reduce calorie intake and help better control your appetite.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('3. Water Supports Energy') }}</h2>
                    <p class="mb-4">{{ __('Dehydration can lead to fatigue and reduced performance. Proper hydration helps maintain energy and activity, which is important for physical training and daily activities.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('4. Water Improves Digestion') }}</h2>
                    <p class="mb-4">{{ __('Drinking water promotes better digestion, prevents constipation, and supports normal gastrointestinal function. This is essential for healthy weight loss.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('5. Helps Remove Toxins') }}</h2>
                    <p class="mb-4">{{ __('Water helps cleanse the body of toxins that can accumulate due to poor nutrition or insufficient physical activity. This keeps your body in optimal shape.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How Much Water Should You Drink?') }}</h2>
                    <p class="mb-4">{{ __('The recommended norm for an adult is about 1.5-2 liters of water per day. However, this amount may vary depending on activity level, climate, and individual needs.') }}</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How Calorize Can Help?') }}</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>{{ __('Hydration Tracking:') }}</strong> {{ __('monitor your daily water intake.') }}</li>
                        <li><strong>{{ __('Progress Charts:') }}</strong> {{ __('track your hydration habits along with other data.') }}</li>
                        <li><strong>{{ __('Convenient Interface:') }}</strong> {{ __('add water to your food diary with just a few clicks.') }}</li>
                    </ul>
                </section>
                <a href="{{ route('register') }}" class="bg-amber-500 text-white font-semibold px-4 py-2 rounded-lg">{{ __('Register Now') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
