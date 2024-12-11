<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 mt-8 mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900">{{ $product->title }}</h5>
            <div>
                <a href="{{ route('products') }}">
                    <x-secondary-button>
                        {{ __('Show All') }}
                    </x-secondary-button>
                </a>
                @if($product->user_id === auth()->id())
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
                    <p class="text-sm text-green-500">
                        {{ number_format($product->proteins, 2) }}
                    </p>
                </li>
                <li class="py-3 sm:py-4 flex justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Fats') }}
                    </p>
                    <p class="text-sm text-red-500">
                        {{ number_format($product->fats, 2) }}
                    </p>
                </li>
                <li class="py-3 sm:py-4 flex justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Carbohydrates') }}
                    </p>
                    <p class="text-sm text-blue-500">
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
</x-app-layout>