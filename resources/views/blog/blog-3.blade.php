<x-app-layout>

    @section('title', __('TOP 10 Foods for Healthy Eating'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Learn about the 10 best foods for healthy eating. Include them in your diet to maintain health and energy.') }}">
        <meta name="keywords" content="{{ __('healthy eating, healthy foods, top 10 foods, nutrition') }}">
        <meta name="author" content="Calorize">
    @endsection

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                {{ __('TOP 10 Foods for Healthy Eating') }}
            </h1>
            <a href="{{ route('blog') }}" class="bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                {{ __('Back to Blog') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <img src="/blog/blog-3.webp" alt="{{ __('TOP 10 Foods for Healthy Eating') }}" class="w-full h-auto mb-8">

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('1. Avocado') }}</h2>
                    <p class="mb-4">{{ __('Avocado is rich in healthy fats, vitamins, and antioxidants. It helps maintain cardiovascular health and lowers cholesterol levels.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('2. Salmon') }}</h2>
                    <p class="mb-4">{{ __('This type of fish is a source of omega-3 fatty acids that support brain, heart, and skin health.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('3. Berries') }}</h2>
                    <p class="mb-4">{{ __('Blueberries, raspberries, and strawberries are superfoods rich in antioxidants that strengthen the immune system and promote skin health.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('4. Nuts') }}</h2>
                    <p class="mb-4">{{ __('Almonds, walnuts, cashews are sources of protein, healthy fats, and minerals that provide energy.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('5. Whole Grains') }}</h2>
                    <p class="mb-4">{{ __('Oats, buckwheat, quinoa are sources of complex carbohydrates and fiber that support digestion and provide long-lasting satiety.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('6. Spinach') }}</h2>
                    <p class="mb-4">{{ __('Spinach is a source of iron, vitamin K, and antioxidants. It helps maintain energy and supports bone health.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('7. Yogurt') }}</h2>
                    <p class="mb-4">{{ __('Natural yogurt is rich in probiotics that support gut health and improve digestion.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('8. Chicken Breast') }}</h2>
                    <p class="mb-4">{{ __('Chicken breast is a source of high-quality protein essential for muscle recovery and energy maintenance.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('9. Eggs') }}</h2>
                    <p class="mb-4">{{ __('Eggs are a versatile product rich in protein, vitamins, and healthy fats that provide energy.') }}</p>
                </section>

                <section class="my-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('10. Sweet Potatoes (Yams)') }}</h2>
                    <p class="mb-4">{{ __('Sweet potatoes contain complex carbohydrates, fiber, and B vitamins that support energy and digestive health.') }}</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">{{ __('Conclusion') }}</h2>
                    <p>{{ __('Including these foods in your diet will help maintain health, energy, and physical fitness. Use the') }} <a href="{{ route('register') }}" class="text-amber-500 underline">{{ __('Calorize') }}</a> {{ __('app to control your nutrition and achieve your goals.') }}</p>
                </section>
            </div>
        </div>
    </div>

</x-app-layout>
