<div class="flex flex-col justify-center mb-10" x-data="recipeApp" @select-product.window="addProduct($event.detail)" x-cloak>

    @section('title', isset($product) ? __('Edit Recipe') : __('Create Recipe'))

    {{-- Errors --}}
    @if($errors->any())
        <div class="mt-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl mb-4">
            @foreach ($errors->all() as $error)
                <div class="text-sm">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between mt-6 mb-4">
        <h1 class="text-2xl font-bold text-stone-800">
            {{ isset($product) ? __('Edit Recipe') : __('Create Recipe') }}
        </h1>
    </div>

    {{-- Main Card --}}
    <div class="rounded-2xl bg-white border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-4 md:p-6">

            {{-- Recipe Name Input --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="flex-1 relative">
                    <i class="fas fa-utensils absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"></i>
                    <input
                        type="text"
                        placeholder="{{ __('Enter the recipe name') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-stone-200 rounded-xl text-sm focus:border-amber-500 focus:ring-amber-500"
                        wire:model="title"
                    />
                </div>
                <button @click="save"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 rounded-xl transition-colors shadow-sm">
                    <i class="fas fa-check mr-2"></i>{{ __('Save') }}
                </button>
            </div>

            {{-- Empty State --}}
            <template x-if="selectedProducts.length === 0">
                <div class="py-12 text-center border-2 border-dashed border-stone-200 rounded-xl">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-stone-100 flex items-center justify-center text-stone-400">
                        <i class="fas fa-plus text-2xl"></i>
                    </div>
                    <p class="text-stone-500 mb-1">{{ __('No products selected.') }}</p>
                    <p class="text-sm text-stone-400">{{ __('Search for the products below.') }}</p>
                </div>
            </template>

            {{-- Products Table --}}
            <template x-if="selectedProducts.length > 0">
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="border-b border-stone-100">
                                <th class="px-2 md:px-4 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                <th class="w-16 sm:w-20 px-2 py-3 text-left text-xs font-medium text-stone-500 uppercase tracking-wider">{{ __('Grams') }}</th>
                                <th class="w-12 sm:w-14 px-2 py-3 text-center text-xs font-medium text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Prot') }}</th>
                                <th class="w-12 sm:w-14 px-2 py-3 text-center text-xs font-medium text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Fat') }}</th>
                                <th class="w-12 sm:w-14 px-2 py-3 text-center text-xs font-medium text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Carb') }}</th>
                                <th class="w-14 sm:w-16 px-2 py-3 text-center text-xs font-medium text-stone-500 uppercase tracking-wider hidden sm:table-cell">{{ __('Kcal') }}</th>
                                <th class="w-8 px-2 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50">
                            <template x-for="selectedProduct in selectedProducts" :key="selectedProduct.id">
                                <tr class="hover:bg-stone-50/50 transition-colors">
                                    <td class="px-2 md:px-4 py-3 text-sm text-stone-700 truncate" x-text="selectedProduct.title"></td>
                                    <td class="px-2 py-3">
                                        <input type="number" min="1"
                                               class="w-full h-8 px-2 text-sm border border-stone-200 rounded-lg focus:border-amber-500 focus:ring-amber-500"
                                               x-model="selectedProduct.grams">
                                    </td>
                                    <td class="px-2 py-3 text-center text-sm text-stone-400 hidden sm:table-cell" x-text="selectedProduct.proteins"></td>
                                    <td class="px-2 py-3 text-center text-sm text-stone-400 hidden sm:table-cell" x-text="selectedProduct.fats"></td>
                                    <td class="px-2 py-3 text-center text-sm text-stone-400 hidden sm:table-cell" x-text="selectedProduct.carbohydrates"></td>
                                    <td class="px-2 py-3 text-center text-sm text-stone-600 hidden sm:table-cell" x-text="selectedProduct.calories"></td>
                                    <td class="px-2 py-3">
                                        <button @click.prevent="removeProduct(selectedProduct.id)"
                                                class="text-stone-300 hover:text-red-500 transition-colors">
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    </td>
                                </tr>
                            </template>

                            {{-- Total Row --}}
                            <tr class="bg-stone-50/50">
                                <td class="px-2 md:px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium text-stone-700">{{ __('Total') }}</span>
                                        <div class="relative group">
                                            <i class="fas fa-info-circle text-stone-400 cursor-pointer hover:text-stone-600 text-xs"></i>
                                            <div class="absolute left-0 bottom-full mb-2 w-64 bg-stone-800 text-white text-xs rounded-lg shadow-lg px-3 py-2 hidden group-hover:block z-10">
                                                {{ __('Enter the total weight of the finished dish after cooking or adding water. Ensure to re-weigh the dish after any thermal processing or liquid addition to get accurate results.') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-3">
                                    <input type="number" min="1"
                                           class="w-full h-8 px-2 text-sm border border-stone-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 bg-white"
                                           x-model="calculated.totalGrams">
                                </td>
                                <td class="px-2 py-3 text-center text-sm font-medium text-blue-600 hidden sm:table-cell" x-text="calculated.totalProteins"></td>
                                <td class="px-2 py-3 text-center text-sm font-medium text-orange-500 hidden sm:table-cell" x-text="calculated.totalFats"></td>
                                <td class="px-2 py-3 text-center text-sm font-medium text-emerald-600 hidden sm:table-cell" x-text="calculated.totalCarbohydrates"></td>
                                <td class="px-2 py-3 text-center text-sm font-bold text-amber-600 hidden sm:table-cell" x-text="calculated.totalCalories"></td>
                                <td class="px-2 py-3"></td>
                            </tr>

                            {{-- Per 100g Row --}}
                            <tr class="bg-amber-50/50">
                                <td class="px-2 md:px-4 py-3 text-sm font-semibold text-amber-800 sm:hidden">{{ __('Kcal per 100 gram') }}</td>
                                <td class="px-2 md:px-4 py-3 text-sm font-semibold text-amber-800 hidden sm:table-cell">{{ __('Per 100 gram') }}</td>
                                <td class="px-2 py-3 hidden sm:table-cell"></td>
                                <td class="px-2 py-3 text-center text-sm font-medium text-blue-600 hidden sm:table-cell" x-text="calculated.proteinsPer100g"></td>
                                <td class="px-2 py-3 text-center text-sm font-medium text-orange-500 hidden sm:table-cell" x-text="calculated.fatsPer100g"></td>
                                <td class="px-2 py-3 text-center text-sm font-medium text-emerald-600 hidden sm:table-cell" x-text="calculated.carbohydratesPer100g"></td>
                                <td class="px-2 py-3 text-center text-lg font-bold text-amber-700" x-text="calculated.kcalPer100g"></td>
                                <td class="px-2 py-3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>

            {{-- Product Search --}}
            <div x-show="createProductForm" class="mt-6">
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

                this.$wire.on('productAdded', product => {
                    product[0].grams = 100;
                    this.selectedProducts.push(product[0]);
                    this.createProductForm = false;
                });
                this.$wire.on('productCreateCancelled', () => {
                    this.createProductForm = false;
                });

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
