<div x-data="diaryApp()">
    <div class="flex flex-wrap mt-8 mb-4">
        <div class="flex w-full">
            <!-- дейтпікер -->
            <div class="flex w-full">
                <input
                    wire:model.live="date"
                    type="date"
                    id="date"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                <div class="text-red-600">@error('date') {{ $message }} @enderror</div>
                <x-primary-button
                    class="ml-4" @click="save">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </div>
    </div>
    <div class="flex flex-col justify-center">
        <div class="flex flex-col shadow justify-between rounded-lg pb-8 xl:p-8 mt-3 bg-white">
            <div class="block-container p-4 space-y-3">
                <template x-for="(foodIntakeData, index) in foodIntakes" :key="index">
                    <div>
                        <div class="rounded-lg border border-gray-300 p-4 flex justify-between items-center">
                            <div x-text="index"></div>
                            <i class="fas fa-plus"></i>
                        </div>
                        <table class="mt-5 min-w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                    <th class="w-1/12 px-1 py-2 text-xs text-left font-medium text-gray-400 uppercase tracking-wider">{{ __('Grams') }}</th>
                                    <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Prot') }}</th>
                                    <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Fat') }}</th>
                                    <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Carb') }}</th>
                                    <th class="w-1/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">{{ __('Kcal') }}</th>
                                    <th class="w-1/12 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template x-for="prod in foodIntakeData.products" :key="prod.id">
                                    <tr>
                                        <td class="px-2 py-4 break-words" x-text="prod.product.title"></td>
                                        <td class="px-2 py-4">
                                            <input type="number"
                                                   class="w-full h-10 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                   x-model="prod.g">
                                        </td>
                                        <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                            x-text="prod.proteins"></td>
                                        <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                            x-text="prod.fats"></td>
                                        <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                            x-text="prod.carbohydrates"></td>
                                        <td class="px-2 py-3 text-center whitespace-nowrap hidden sm:table-cell"
                                            x-text="prod.calories"></td>
                                        <td class="px-2 py-3 whitespace-nowrap">
                                            <a href="#" @click.prevent="removeProduct(prod.id)"
                                               class="text-red-500 hover:underline">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                                <tr class="bg-gray-50">
                                    <td class="px-2 py-4 break-words">{{ __('Total') }}</td>
                                    <td class="px-2 py-4"></td>
                                    <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                        x-text="foodIntakeData.totalProteins"></td>
                                    <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                        x-text="foodIntakeData.totalFats"></td>
                                    <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                        x-text="foodIntakeData.totalCarbohydrates"></td>
                                    <td class="px-2 py-3 text-center whitespace-nowrap hidden sm:table-cell"
                                        x-text="foodIntakeData.totalCalories"></td>
                                    <td class="px-2 py-3 whitespace-nowrap"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </template>
                <livewire:product-search/>
                <div class="rounded-lg border border-gray-300 p-4 flex justify-around">
                    <div class="text-green-500">
                        {{ __('Proteins: ') }} <span x-text="totalProteins"></span>
                    </div>
                    <div class="text-red-500">
                        {{ __('Fats: ') }} <span x-text="totalFats"></span>
                    </div>
                    <div class="text-yellow-500">
                        {{ __('Carbohydrates: ') }} <span x-text="totalCarbohydrates"></span>
                    </div>
                </div>
                <div class="rounded-lg border border-gray-300 p-4 flex justify-between items-center">
                    <div> {{ __('Measurements') }}</div>
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label for="measurement1"
                                   class="block text-sm font-medium text-gray-700">{{ __('Weight') }}</label>
                            <input type="text" id="measurement1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="measurement2"
                                   class="block text-sm font-medium text-gray-700">{{ __('Chest') }}</label>
                            <input type="text" id="measurement2"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="measurement3"
                                   class="block text-sm font-medium text-gray-700">{{ __('Waist') }}</label>
                            <input type="text" id="measurement3"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="measurement4"
                                   class="block text-sm font-medium text-gray-700">{{ __('Thighs') }}</label>
                            <input type="text" id="measurement4"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="measurement5"
                                   class="block text-sm font-medium text-gray-700">{{ __('Wrist') }}</label>
                            <input type="text" id="measurement5"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="measurement6"
                                   class="block text-sm font-medium text-gray-700">{{ __('Neck') }}</label>
                            <input type="text" id="measurement6"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="measurement6"
                                   class="block text-sm font-medium text-gray-700">{{ __('Biceps') }}</label>
                            <input type="text" id="measurement6"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div @click="showRemainingCalories = !showRemainingCalories"
         :class="{
        'bg-green-600': showRemainingCalories && remainingCalories >= 0,
        'bg-red-600': showRemainingCalories && remainingCalories < 0,
        'bg-yellow-600': !showRemainingCalories
        }"
         class="fixed bottom-0 right-0 mb-4 mr-4 w-20 h-20  rounded-full z-50 flex flex-col items-center justify-center bg-opacity-75 text-white">
        <div x-show="!showRemainingCalories" class="font-bold" x-text="totalCalories">1560</div>
        <div x-show="showRemainingCalories" class="font-bold" x-text="remainingCalories">1360</div>
        <div class="text-xs">Ккал</div>
    </div>
</div>

<script>
    function diaryApp() {
        return {
            date: '{{ $date }}',
            showRemainingCalories: false,
            totalCalories: 0,
            remainingCalories: 0,
            totalFats: 0,
            totalProteins: 0,
            totalCarbohydrates: 0,
            foodIntakes: {
                "{{ __('Breakfast') }}": {
                    products: @json($breakfast ?? []),
                },
                "{{ __('Lunch') }}": {
                    products: @json($lunch ?? []),
                },
                "{{ __('Dinner') }}": {
                    products: @json($dinner ?? []),
                },
                "{{ __('Snack') }}": {
                    products: @json($snack ?? []),
                }
            },
            init() {
                // after initialization
                this.$nextTick(() => {
                    this.calculate();
                });

                this.$watch('foodIntakes', value => {
                    this.calculate();
                }, {deep: true});
            },
            calculate() {
                for (let key in this.foodIntakes) {
                    if (this.foodIntakes.hasOwnProperty(key)) {
                        let intake = this.foodIntakes[key];
                        // calculate all products calories
                        intake.products.forEach(product => {
                            product.calories = Math.round(product.product.calories * product.g / 100);
                        });
                        // calculate total intake calories
                        intake.totalCalories = intake.products.reduce((acc, product) => acc + product.calories, 0);
                        intake.totalFats = intake.products.reduce((acc, product) => acc + product.fats, 0);
                        intake.totalProteins = intake.products.reduce((acc, product) => acc + product.proteins, 0);
                        intake.totalCarbohydrates = intake.products.reduce((acc, product) => acc + product.carbohydrates, 0);
                    }
                }
                this.totalCalories = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalCalories, 0);
                this.remainingCalories = 2000 - this.totalCalories;
                this.totalFats = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalFats, 0);
                this.totalProteins = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalProteins, 0);
                this.totalCarbohydrates = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalCarbohydrates, 0);
            },
        }
    }
</script>