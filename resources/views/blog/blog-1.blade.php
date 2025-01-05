<x-app-layout>

    @section('title', __('How to Count Calories for Weight Loss — A Practical Guide'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn how to count calories for weight loss. A simple guide, useful tips, and how the Calorize app can help you achieve your goals.') }}">
        <meta name="keywords" content="{{ __('how to count calories, weight loss, product calorie content, calorie counting apps') }}">
        <meta name="author" content="Calorize">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">{{ __('How to Count Calories for Weight Loss? A Beginner\'s Guide') }}</h1>
                <a href="{{ route('blog') }}" class="bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    {{ __('Back to Blog') }}
                </a>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="/blog/blog-1.webp" alt="{{ __('How to count calories for weight loss') }}" class="w-full h-auto mb-8">

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('What are Calories and Why Are They Important?') }}</h2>
                    <p class="mb-4">{{ __('Calories are a unit of energy obtained from food and drinks. Your body uses calories to maintain vital functions: breathing, heart activity, movement, and even thinking.') }}</p>
                    <p>{{ __('When you consume more calories than you burn, the excess is stored as fat. Conversely, burning more than you consume leads to weight loss.') }}</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How to Determine Your Calorie Norm?') }}</h2>
                    <p class="mb-4"><strong>{{ __('Calculate your Basal Metabolic Rate (BMR):') }}</strong></p>
                    <p class="mb-4">{{ __('For women:') }} <code>BMR = 10 × weight (kg) + 6.25 × height (cm) − 5 × age (years) − 161</code></p>
                    <p class="mb-4">{{ __('For men:') }} <code>BMR = 10 × weight (kg) + 6.25 × height (cm) − 5 × age (years) + 5</code></p>
                    <p class="mb-4"><strong>{{ __('Multiply BMR by your activity level:') }}</strong></p>
                    <ul class="list-disc list-inside mb-4">
                        <li>{{ __('Minimal activity: × 1.2') }}</li>
                        <li>{{ __('Light activity: × 1.375') }}</li>
                        <li>{{ __('Moderate activity: × 1.55') }}</li>
                        <li>{{ __('High activity: × 1.725') }}</li>
                    </ul>
                    <p>{{ __('This number is your Total Daily Energy Expenditure (TDEE). To lose weight, create a deficit of 10-20% from TDEE.') }}</p>
                    <p>{{ __('You can easily perform all these calculations in our app here:') }} <a href="{{ route('personal') }}" class="text-blue-500 underline">{{ __('Personal Calculations') }}</a>.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('What Foods to Choose for Weight Loss?') }}</h2>
                    <p class="mb-4">{{ __('Pay attention to foods with high nutritional value:') }}</p>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>{{ __('Proteins:') }}</strong> {{ __('chicken, eggs, cheese, legumes.') }}</li>
                        <li><strong>{{ __('Healthy Fats:') }}</strong> {{ __('avocado, nuts, olive oil.') }}</li>
                        <li><strong>{{ __('Complex Carbohydrates:') }}</strong> {{ __('whole-grain bread, vegetables, grains.') }}</li>
                    </ul>
                    <p>{{ __('Avoid ultra-processed foods with "empty" calories: chips, sweets, soft drinks.') }}</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How Can Calorize Help You?') }}</h2>
                    <p class="mb-4">{{ __('Our app simplifies the entire process. Here\'s what you can do:') }}</p>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong><a href="{{ route('personal') }}">{{ __('Calculate your calorie norm') }}</a></strong> {{ __('in just seconds. Additionally, calculate BMI, fat percentage, BMR, and weight norm. Determine the weeks required to achieve your target weight based on entered data.') }}</li>
                        <li><strong><a href="{{ route('diary') }}">{{ __('Keep a food diary:') }}</a></strong> {{ __('just add products and meals from our extensive database.') }}</li>
                        <li><strong><a href="{{ route('statistic') }}">{{ __('Build progress graphs:') }}</a></strong> {{ __('track your weight, calories, and macronutrients (BMR).') }}</li>
                        <li><strong><a href="{{ route('recipe.create') }}">{{ __('Save your own recipes:') }}</a></strong> {{ __('enter data about your favorite meals without worrying about manual calorie counting.') }}</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('Tips for Effective Weight Loss') }}</h2>
                    <ol class="list-decimal list-inside mb-4">
                        <li>{{ __('Don\'t create too large a calorie deficit — this can lead to muscle loss.') }}</li>
                        <li>{{ __('Don\'t forget about physical activity — even walks can significantly increase calorie expenditure.') }}</li>
                        <li>{{ __('Keep a food diary. Even small "snacks" can seriously affect your diet.') }}</li>
                    </ol>
                </section>

                <section>
                    <h2 class="text-xl font-semibold mb-4">{{ __('Additional Resources') }}</h2>
                    <p>{{ __('For more information on healthy eating, visit the official website of the') }} <a href="https://www.who.int/" target="_blank" rel="noopener" class="text-blue-500 underline">{{ __('World Health Organization (WHO)') }}</a>.</p>
                </section>

            </div>
        </div>
    </div>

</x-app-layout>
