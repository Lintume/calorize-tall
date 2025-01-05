<x-app-layout>

    @section('title', __('Blog - useful articles about nutrition and health'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description"
              content="{{ __('Useful articles about healthy eating, weight loss, and fitness. Learn how to count calories correctly, which foods to choose for weight loss, and how the Calorize app can help you reach your goals.') }}">
        <meta name="keywords" content="{{ __('Articles about nutrition, weight loss, health, fitness') }}">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-2xl font-bold">{{ __('Useful articles about nutrition and health') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <ul class="space-y-4">
                    <li class="p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 transition duration-300">
                        <a href="{{ route('blog-1') }}"
                           class="text-blue-500 underline text-lg font-semibold hover:text-blue-700">
                            {{ __('How to Count Calories for Weight Loss — A Practical Guide') }}
                        </a>
                    </li>
                    <li class="p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 transition duration-300">
                        <a href="{{ route('blog-2') }}"
                           class="text-blue-500 underline text-lg font-semibold hover:text-blue-700">
                            {{ __('5 Tips for Effective Weight Loss') }}
                        </a>
                    </li>
                    <li class="p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 transition duration-300">
                        <a href="{{ route('blog-3') }}"
                           class="text-blue-500 underline text-lg font-semibold hover:text-blue-700">
                            {{ __('TOP 10 Foods for Healthy Eating') }}
                        </a>
                    </li>
                    <li class="p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 transition duration-300">
                        <a href="{{ route('blog-4') }}"
                           class="text-blue-500 underline text-lg font-semibold hover:text-blue-700">
                            {{ __('Why Water is Important for Weight Loss?') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>