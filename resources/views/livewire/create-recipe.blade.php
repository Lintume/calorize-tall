<div class="flex flex-col justify-center" x-data="recipeApp()">
    <div class="text-red-600">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    <div class="flex flex-col shadow justify-between rounded-lg mt-5 bg-white mb-1">
        <div class="p-5 md:p-10">

            <div class="flex items-center">
                <input
                    type="text"
                    placeholder="{{ __('Enter the recipe name') }}"
                    class="w-full h-10 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    wire:model="title"
                />
                <div class="text-red-600">@error('title') {{ $message }} @enderror</div>
                <x-secondary-button
                    class="ml-2 h-10 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    @click="save"
                >
                    {{ __('Save') }}
                </x-secondary-button>
            </div>

            <template x-if="selectedProducts.length === 0">
                <div class="mt-5 text-center">{{ __('No products selected.') }}
                    <br> {{ __('Select products from the list below.') }}</div>
            </template>
            <template x-if="selectedProducts.length > 0">
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
                        <template x-for="selectedProduct in selectedProducts" :key="selectedProduct.id">
                            <tr>
                                <td class="px-2 py-4 break-words" x-text="selectedProduct.title"></td>
                                <td class="px-2 py-4">
                                    <input type="number" class="w-full h-10 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" x-model="selectedProduct.grams">
                                </td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="selectedProduct.proteins"></td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="selectedProduct.fats"></td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="selectedProduct.carbohydrates"></td>
                                <td class="px-2 py-3 text-center whitespace-nowrap hidden sm:table-cell" x-text="selectedProduct.calories"></td>
                                <td class="px-2 py-3 whitespace-nowrap">
                                    <a href="#" @click.prevent="removeProduct(selectedProduct.id)" class="text-red-500 hover:underline">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </template>
                        <tr class="bg-gray-50">
                            <td class="px-2 py-4 break-words">{{ __('Total') }}</td>
                            <td class="px-2 py-4">
                                <input type="number" class="w-full h-10 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" x-model="calculated.totalGrams">
                            </td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="calculated.totalProteins"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="calculated.totalFats"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="calculated.totalCarbohydrates"></td>
                            <td class="px-2 py-3 text-center whitespace-nowrap hidden sm:table-cell" x-text="calculated.totalCalories"></td>
                            <td class="px-2 py-3 whitespace-nowrap"></td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="px-2 py-4 break-words">{{ __('Kcal per 100 gram') }}</td>
                            <td class="px-2 py-4 hidden sm:table-cell"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="calculated.proteinsPer100g"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="calculated.fatsPer100g"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell" x-text="calculated.carbohydratesPer100g"></td>
                            <td class="px-2 py-3 text-center font-extrabold whitespace-nowrap" x-text="calculated.kcalPer100g"></td>
                            <td class="px-2 py-3 whitespace-nowrap"></td>
                        </tr>
                    </tbody>
                </table>
            </template>

            <!-- Search bar -->
            <div class="mt-5 mb-5 md:mt-10">
                <input
                    type="text"
                    placeholder="{{ __('Search...') }}"
                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    wire:model.live.debounce.500ms="search"
                />
                <div class="text-red-600">@error('search') {{ $message }} @enderror</div>
            </div>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                            <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Prot') }}</th>
                            <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Fat') }}</th>
                            <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Carb') }}</th>
                            <th class="w-1/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Kcal') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($products as $product)
                            <tr @click="addProduct('{{ $product }}')" class="cursor-pointer" wire:key="{{ $product->id }}">
                                <td class="px-2 py-4 break-words">{{ $product->title }}</td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->proteins }}</td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->fats }}</td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->carbohydrates }}</td>
                                <td class="px-2 py-3 text-center whitespace-nowrap">{{ $product->calories }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function recipeApp() {
        return {
            selectedProducts: [],

            calculated: {
                totalGrams: 0,

                totalProteins: 0,
                totalFats: 0,
                totalCarbohydrates: 0,
                totalCalories: 0,
                totalKcal: 0,

                proteinsPer100g: 0,
                fatsPer100g: 0,
                carbohydratesPer100g: 0,
                kcalPer100g: 0,
            },

            init() {
                this.$watch('selectedProducts', value => {
                    this.calculated.totalGrams = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.grams), 0);
                    this.calculated.totalProteins = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.proteins) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalFats = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.fats) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalCarbohydrates = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.carbohydrates) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalCalories = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.calories) * product.grams / 100, 0).toFixed(2);

                    this.calculatePer100g();
                }, { deep: true });

                this.$watch('calculated.totalGrams', value => {
                    this.calculatePer100g();
                });
            },

            calculatePer100g() {
                if (this.calculated.totalGrams > 0) {
                    this.calculated.proteinsPer100g = (this.calculated.totalProteins / this.calculated.totalGrams * 100).toFixed(2);
                    this.calculated.fatsPer100g = (this.calculated.totalFats / this.calculated.totalGrams * 100).toFixed(2);
                    this.calculated.carbohydratesPer100g = (this.calculated.totalCarbohydrates / this.calculated.totalGrams * 100).toFixed(2);
                    this.calculated.kcalPer100g = (this.calculated.totalCalories / this.calculated.totalGrams * 100).toFixed(2);
                } else {
                    this.calculated.proteinsPer100g = 0;
                    this.calculated.fatsPer100g = 0;
                    this.calculated.carbohydratesPer100g = 0;
                    this.calculated.kcalPer100g = 0;
                }
            },

            addProduct(product) {
                product = JSON.parse(product);
                if (this.selectedProducts.find(p => p.id === product.id)) {
                    return;
                }
                product.grams = 100;
                this.selectedProducts.push(product);
            },
            removeProduct(productId) {
                this.selectedProducts = this.selectedProducts.filter(product => product.id !== productId);
            },

            save() {
                this.$wire.call('save', this.selectedProducts, this.calculated);
            }
        }
    }
</script>