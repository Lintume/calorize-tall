<div class="flex flex-col justify-center" x-data="recipeApp" @select-product.window="addProduct($event.detail)">
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
                <x-primary-button
                    class="ml-2 h-10 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    @click="save"
                >
                    {{ __('Save') }}
                </x-primary-button>
            </div>

            <template x-if="selectedProducts.length === 0">
                <div class="mt-5 text-center">{{ __('No products selected.') }}
                    <br> {{ __('Search for the products below.') }}</div>
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
                                    <input type="number"
                                           class="w-full h-10 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                           x-model="selectedProduct.grams">
                                </td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                    x-text="selectedProduct.proteins"></td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                    x-text="selectedProduct.fats"></td>
                                <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                    x-text="selectedProduct.carbohydrates"></td>
                                <td class="px-2 py-3 text-center whitespace-nowrap hidden sm:table-cell"
                                    x-text="selectedProduct.calories"></td>
                                <td class="px-2 py-3 whitespace-nowrap">
                                    <a href="#" @click.prevent="removeProduct(selectedProduct.id)"
                                       class="text-red-500 hover:underline">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </template>
                        <tr class="bg-gray-50">
                            <td class="px-2 py-4 break-words">{{ __('Total') }}</td>
                            <td class="px-2 py-4">
                                <input type="number"
                                       class="w-full h-10 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       x-model="calculated.totalGrams">
                            </td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                x-text="calculated.totalProteins"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                x-text="calculated.totalFats"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                x-text="calculated.totalCarbohydrates"></td>
                            <td class="px-2 py-3 text-center whitespace-nowrap hidden sm:table-cell"
                                x-text="calculated.totalCalories"></td>
                            <td class="px-2 py-3 whitespace-nowrap"></td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="px-2 py-4 break-words">{{ __('Kcal per 100 gram') }}</td>
                            <td class="px-2 py-4 hidden sm:table-cell"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                x-text="calculated.proteinsPer100g"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                x-text="calculated.fatsPer100g"></td>
                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                x-text="calculated.carbohydratesPer100g"></td>
                            <td class="px-2 py-3 text-center font-extrabold whitespace-nowrap"
                                x-text="calculated.kcalPer100g"></td>
                            <td class="px-2 py-3 whitespace-nowrap"></td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <div x-show="createProductForm" class="mt-4">
                <livewire:product-create />
            </div>

            <div x-show="!createProductForm" class="mt-6">
               <livewire:product-search />
            </div>
        </div>
    </div>
</div>

<script>
    function recipeApp() {
        return {
            selectedProducts: @json($selectedProducts),
            createProductForm: false,

            calculated: {
                totalGrams: {{ $product?->total_weight ?? 0 }},

                totalProteins: 0,
                totalFats: 0,
                totalCarbohydrates: 0,
                totalCalories: 0,
                totalKcal: 0,

                proteinsPer100g: {{ $product?->proteins ?? 0 }},
                fatsPer100g: {{ $product?->fats ?? 0 }},
                carbohydratesPer100g: {{ $product?->carbohydrates ?? 0 }},
                kcalPer100g: {{ $product?->calories ?? 0 }},
            },

            init() {
                this.$watch('selectedProducts', value => {
                    this.calculateAll();
                }, {deep: true});

                this.$watch('calculated.totalGrams', value => {
                    this.calculatePer100g();
                });

                // Listen for the Livewire event and add the product to selectedProducts
                this.$wire.on('productAdded', product => {
                    product[0].grams = 100;
                    this.selectedProducts.push(product[0]);
                    this.createProductForm = false;
                });
                this.$wire.on('productCreateCancelled', () => {
                    this.createProductForm = false;
                });

                // Manually call calculateAll after initialization
                this.$nextTick(() => {
                    this.calculated.totalProteins = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.proteins) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalFats = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.fats) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalCarbohydrates = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.carbohydrates) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalCalories = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.calories) * product.grams / 100, 0).toFixed(2);
                });
            },

            calculateAll() {
                this.calculated.totalGrams = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.grams), 0);
                this.calculated.totalProteins = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.proteins) * product.grams / 100, 0).toFixed(2);
                this.calculated.totalFats = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.fats) * product.grams / 100, 0).toFixed(2);
                this.calculated.totalCarbohydrates = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.carbohydrates) * product.grams / 100, 0).toFixed(2);
                this.calculated.totalCalories = this.selectedProducts.reduce((acc, product) => acc + parseInt(product.calories) * product.grams / 100, 0).toFixed(2);

                this.calculatePer100g();
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