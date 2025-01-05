<x-app-layout>

    @section('title', __('5 Tips for Effective Weight Loss'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn the 5 most effective tips for weight loss, from creating a calorie deficit to choosing the right foods.') }}">
        <meta name="keywords" content="{{ __('weight loss tips, how to lose weight, calories, weight control, nutrition') }}">
        <meta name="author" content="Calorize">
    @endsection

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">{{ __('5 Tips for Effective Weight Loss') }}</h1>
            <a href="{{ route('blog') }}" class="bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                {{ __('Back to Blog') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="/blog/blog-2.webp" alt="{{ __('5 Tips for Weight Loss') }}" class="w-full h-auto mb-8">

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('1. Create a Calorie Deficit') }}</h2>
                    <p class="mb-4">{{ __('The main principle of weight loss is to consume fewer calories than your body burns. Use the TDEE (Total Daily Energy Expenditure) formula to determine how many calories you need and create a deficit of 10-20% from that number.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('2. Focus on High-Quality Foods') }}</h2>
                    <p class="mb-4">{{ __('Choose foods rich in protein, healthy fats, and complex carbohydrates. For example:') }}</p>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>{{ __('Proteins:') }}</strong> {{ __('chicken, fish, eggs, cheese.') }}</li>
                        <li><strong>{{ __('Fats:') }}</strong> {{ __('avocado, nuts, olive oil.') }}</li>
                        <li><strong>{{ __('Carbohydrates:') }}</strong> {{ __('buckwheat, oats, vegetables.') }}</li>
                    </ul>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('3. Drink More Water') }}</h2>
                    <p class="mb-4">{{ __('Water helps maintain metabolism, cleanse the body, and reduce hunger. Try to drink 1.5-2 liters of water per day.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('4. Physical Activity is Your Ally') }}</h2>
                    <p class="mb-4">{{ __('Regular physical activity helps not only burn calories but also maintain muscle mass. Even daily 30-minute walks will yield results.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('5. Keep a Food Diary') }}</h2>
                    <p class="mb-4">{{ __('Record everything you eat to control calorie intake. Use the') }} <a href="{{ route('register') }}" class="text-blue-500 underline">{{ __('Calorize') }}</a> {{ __('app for simple and convenient food diary management.') }}</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('How Can Calorize Help?') }}</h2>
                    <ul class="list-disc list-inside mb-4">
                        <li><strong>{{ __('Calorie Calculation:') }}</strong> {{ __('determine your calorie norm in seconds.') }}</li>
                        <li><strong>{{ __('Nutrition Control:') }}</strong> {{ __('add meals and foods to your diary.') }}</li>
                        <li><strong>{{ __('Progress Graphs:') }}</strong> {{ __('track changes in your weight.') }}</li>
                    </ul>
                </section>

                <a href="{{ route('register') }}" class="bg-amber-500 text-white font-semibold px-4 py-2 rounded-lg">{{ __('Register Now') }}</a>

            </div>
        </div>
    </div>

</x-app-layout>