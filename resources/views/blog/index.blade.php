<x-app-layout>

    @section('title', __('Блог - користні статті про харчування і здоровʼя'))

    @section('meta')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description"
              content="{{ __('Корисні статті про здорове харчування, схуднення та фітнес. Дізнайтеся, як правильно рахувати калорії, які продукти вибирати для схуднення та як додаток Калорайз допоможе вам досягти мети.') }}">
        <meta name="keywords" content="{{ __('статті про харчування, схуднення, здоровʼя, фітнес') }}">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="text-2xl font-bold">{{ __('Корисні статті про харчування та здоровʼя') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <ul class="space-y-4">
                    <li class="p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 transition duration-300">
                        <a href="{{ route('blog-1') }}" class="text-blue-500 underline text-lg font-semibold hover:text-blue-700">
                            {{ __('Як правильно рахувати калорії для схуднення — практичний гід') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>