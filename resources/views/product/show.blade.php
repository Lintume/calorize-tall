<x-app-layout>

    @section('title', $product->title . ': ' . __('calories, proteins, fats, and carbohydrates'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    @section('meta')
        <meta name="description" content="{{ $product->title }} - {{ __('Find out the calorie content, proteins, fats and carbohydrates on our website. A simple and convenient tool for monitoring nutrition.') }}">
        <meta name="keywords" content="{{ __('Product, Proteins, Fats, Carbohydrates, Calories') }}, {{ $product->title }}">
        <meta property="og:title" content="{{ $product->title }}">
        <meta property="og:description" content="{{ $product->title }} - {{ __('Product details including proteins, fats, carbohydrates, and calories.') }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ url()->current() }}">

        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "NutritionInformation",
                "name": "{{ $product->title }}",
                "description": "{{ __('Detailed information about') }} {{ $product->title }}",
                "calories": "{{ number_format($product->calories) }} kcal",
                "proteinContent": "{{ number_format($product->proteins, 2) }} g",
                "fatContent": "{{ number_format($product->fats, 2) }} g",
                "carbohydrateContent": "{{ number_format($product->carbohydrates, 2) }} g",
                "servingSize": "100 g",
                "url": "{{ url()->current() }}"
            }
        </script>
    @endsection

    <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 mt-8 mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-bold leading-none text-gray-900">{{ $product->title }}</h1>
            <div>
                <a href="{{ $product->base ? route('product.index') : route('recipe.index') }}" class="ml-2">
                    <x-secondary-button>
                        {{ __('Show All') }}
                    </x-secondary-button>
                </a>
                @if(auth()->check() && $product->user_id === auth()->id())
                    <a class="ml-2" href="{{ route('product.edit', $product->id) }}">
                        <x-secondary-button>
                            <i class="fas fa-edit"></i>
                        </x-secondary-button>
                    </a>
                @endif
            </div>
        </div>

        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                <li class="py-3 sm:py-4 flex justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Proteins') }}
                    </p>
                    <p class="text-sm text-green-900">
                        {{ number_format($product->proteins, 2) }}
                    </p>
                </li>
                <li class="py-3 sm:py-4 flex justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Fats') }}
                    </p>
                    <p class="text-sm text-red-900">
                        {{ number_format($product->fats, 2) }}
                    </p>
                </li>
                <li class="py-3 sm:py-4 flex justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Carbohydrates') }}
                    </p>
                    <p class="text-sm text-blue-900">
                        {{ number_format($product->carbohydrates, 2) }}
                    </p>
                </li>
                <li class="py-3 sm:py-4 flex justify-between text-lg">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Calories') }}
                    </p>
                    <p class=" font-bold text-black">
                        {{ number_format($product->calories, 2) }}
                    </p>
                </li>
            </ul>
        </div>
    </div>
    @guest
        <div class="flex justify-center mt-5">
            <x-primary-button>
                <a href="{{ '/' }}" class="flex items-center justify-center text-lg p-1">
                    {{ __('Add to the diary') }}
                </a>
            </x-primary-button>
        </div>
    @endguest
</x-app-layout>