@php
    $recipe = $product ?? null;
    $isEdit = (bool) $recipe;
    $initialSelectedProducts = $selectedProducts ?? [];
@endphp

<div
    class="py-6 sm:py-8 lg:py-10"
    x-data="recipeApp"
    @select-product.window="addProduct($event.detail)"
    x-cloak
>
    @section('title', $isEdit ? __('Edit Recipe') : __('Create Recipe'))

    {{-- Errors --}}
    @if($errors->any())
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm">
                <div class="font-semibold text-sm mb-1">{{ __('Please fix the errors below') }}</div>
                <div class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <div class="text-sm">{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-stone-50">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto space-y-8">

                {{-- Hero --}}
                <div class="relative overflow-hidden rounded-[1.75rem] border border-stone-200 bg-white/95 backdrop-blur shadow-xl shadow-stone-900/5 p-6 sm:p-8">
                    <div class="absolute inset-0 bg-[radial-gradient(1200px_circle_at_10%_-20%,rgba(245,158,11,0.12),transparent_55%),radial-gradient(900px_circle_at_95%_-20%,rgba(14,165,233,0.1),transparent_55%)]"></div>
                    <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-10">
                        <div class="space-y-3 max-w-3xl">
                            <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/80 px-3 py-1.5 text-[11px] font-semibold text-stone-700">
                                <i class="fas {{ $isEdit ? 'fa-pen' : 'fa-plus' }} text-amber-600"></i>
                                <span>{{ $isEdit ? __('Edit Recipe') : __('Create Recipe') }}</span>
                            </div>
                            <h1 class="text-[clamp(2rem,3vw,2.8rem)] font-extrabold leading-[1.05] text-stone-900">
                                {{ __('Вкажи вагу готової страви — отримаєш точну калорійність') }}
                            </h1>
                            <p class="text-sm sm:text-base text-stone-600 leading-relaxed">
                                {{ __('Зваж готову страву після термообробки/води і введи грамовку — тоді ккал/100 г будуть точними, а щоденник та AI працюватимуть без похибок.') }}
                            </p>
                            <div class="flex flex-wrap gap-2 text-[11px] font-semibold text-stone-700">
                                <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                                    <i class="fas fa-fire text-amber-600"></i>{{ __('Thermal/water friendly') }}
                                </span>
                                <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                                    <i class="fas fa-bolt text-emerald-600"></i>{{ __('Accurate kcal per 100 g') }}
                                </span>
                                <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/70 px-3 py-1.5">
                                    <i class="fas fa-robot text-sky-600"></i>{{ __('AI + diary ready') }}
                                </span>
                            </div>
                        </div>
                        <div class="w-full lg:w-auto">
                            <div class="mx-auto w-full max-w-xs">
                                <div class="rounded-[1.5rem] border border-stone-200 bg-white shadow-lg shadow-stone-900/10 p-5 space-y-3">
                                    <div class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500 text-center">{{ __('Ключові кроки') }}</div>
                                    <div class="space-y-2 text-sm text-stone-700">
                                        <div class="flex items-start gap-2">
                                            <span class="h-6 w-6 rounded-lg bg-amber-500/10 border border-amber-200 text-amber-700 grid place-items-center text-xs font-bold">1</span>
                                            <span>{{ __('Додай інгредієнти і їх вагу в сирому/готовому вигляді') }}</span>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <span class="h-6 w-6 rounded-lg bg-amber-500/10 border border-amber-200 text-amber-700 grid place-items-center text-xs font-bold">2</span>
                                            <span>{{ __('Зваж фінальну страву після термообробки/води') }}</span>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <span class="h-6 w-6 rounded-lg bg-amber-500/10 border border-amber-200 text-amber-700 grid place-items-center text-xs font-bold">3</span>
                                            <span>{{ __('Отримай ккал та макроси на 100 г — щоденник і AI беруть їх звідси') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form & helpers --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    <div class="lg:col-span-2 space-y-4">
                        <div class="rounded-[1.5rem] border border-stone-200 bg-white/95 backdrop-blur shadow-lg shadow-stone-900/5 overflow-hidden">
                            <div class="px-5 py-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between border-b border-stone-100">
                                <div class="w-full sm:max-w-lg">
                                    <label class="block text-[12px] font-semibold text-stone-600 uppercase tracking-wide mb-1">{{ __('Recipe name') }}</label>
                                    <div class="relative">
                                        <i class="fas fa-utensils absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"></i>
                                        <input
                                            type="text"
                                            placeholder="{{ __('Enter the recipe name') }}"
                                            class="w-full h-12 pl-10 pr-3 rounded-xl border border-stone-200 bg-white text-sm text-stone-800 shadow-inner shadow-stone-900/5 focus:border-amber-500 focus:ring-amber-500 transition"
                                            wire:model="title"
                                        />
                                    </div>
                                </div>
                                <div class="flex flex-row flex-wrap gap-2 w-full sm:w-auto sm:justify-end">
                                    <button
                                        @click="save"
                                        :disabled="!canSave"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 text-sm font-semibold text-white shadow-lg shadow-amber-700/20 hover:from-amber-700 hover:to-amber-800 active:scale-[0.99] transition disabled:opacity-60 disabled:cursor-not-allowed w-full sm:w-auto"
                                    >
                                        <i class="fas fa-check text-xs"></i>{{ __('Save') }}
                                    </button>
                                    <a href="{{ route('recipe.index') }}"
                                       class="inline-flex items-center justify-center gap-2 h-11 px-4 rounded-xl border border-stone-200 bg-white text-sm font-semibold text-stone-700 hover:bg-stone-100 active:scale-[0.99] transition w-full sm:w-auto">
                                        <i class="fas fa-arrow-left text-xs"></i>{{ __('Back') }}
                                    </a>
                                </div>
                            </div>

                            <div class="p-5 sm:p-6 space-y-5">
                                {{-- Callout about total grams --}}
                                <div class="rounded-2xl border border-amber-200 bg-amber-50/80 px-4 py-3 flex items-start gap-3">
                                    <div class="h-10 w-10 rounded-xl bg-white text-amber-700 grid place-items-center border border-amber-200 shadow-inner shadow-amber-900/10 flex-shrink-0">
                                        <i class="fas fa-scale-balanced"></i>
                                    </div>
                                    <div class="text-sm text-amber-800">
                                        <div class="font-semibold">{{ __('Обовʼязково введи вагу готової страви') }}</div>
                                        <div class="text-amber-700">{{ __('Після термообробки/додавання води зваж готову страву. Ми ділимо суму макросів на цю вагу, щоб отримати точні ккал на 100 г.') }}</div>
                                    </div>
                                </div>

                                {{-- Empty state --}}
                                <template x-if="selectedProducts.length === 0">
                                    <div class="py-10 text-center border-2 border-dashed border-stone-200 rounded-2xl bg-stone-50/60">
                                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white flex items-center justify-center text-stone-400 shadow-inner shadow-stone-900/5">
                                            <i class="fas fa-plus text-2xl"></i>
                                        </div>
                                        <p class="text-stone-700 font-semibold mb-1">{{ __('No ingredients yet') }}</p>
                                        <p class="text-sm text-stone-500">{{ __('Додай продукти нижче — кожен має вагу у страві') }}</p>
                                    </div>
                                </template>

                                {{-- Ingredients table --}}
                                <template x-if="selectedProducts.length > 0">
                                    <div class="overflow-x-auto">
                                        <table class="w-full table-fixed">
                                            <thead>
                                                <tr class="border-b border-stone-100">
                                                    <th class="px-3 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                                    <th class="w-20 px-2 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">{{ __('Grams') }}</th>
                                                    <th class="w-14 px-2 py-3 text-center text-xs font-semibold text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Prot') }}</th>
                                                    <th class="w-14 px-2 py-3 text-center text-xs font-semibold text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Fat') }}</th>
                                                    <th class="w-14 px-2 py-3 text-center text-xs font-semibold text-stone-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Carb') }}</th>
                                                    <th class="w-16 px-2 py-3 text-center text-xs font-semibold text-stone-500 uppercase tracking-wider hidden sm:table-cell">{{ __('Kcal') }}</th>
                                                    <th class="w-10 px-2 py-3"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-stone-50">
                                                <template x-for="selectedProduct in selectedProducts" :key="selectedProduct.id">
                                                    <tr class="hover:bg-stone-50/50 transition-colors">
                                                        <td class="px-3 py-3 text-sm text-stone-800 truncate" x-text="selectedProduct.title"></td>
                                                        <td class="px-2 py-3">
                                                            <input
                                                                type="number"
                                                                min="1"
                                                                class="w-full h-10 px-2 text-sm border border-stone-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 bg-white"
                                                                x-model="selectedProduct.grams"
                                                            >
                                                        </td>
                                                        <td class="px-2 py-3 text-center text-sm text-stone-500 hidden sm:table-cell" x-text="selectedProduct.proteins"></td>
                                                        <td class="px-2 py-3 text-center text-sm text-stone-500 hidden sm:table-cell" x-text="selectedProduct.fats"></td>
                                                        <td class="px-2 py-3 text-center text-sm text-stone-500 hidden sm:table-cell" x-text="selectedProduct.carbohydrates"></td>
                                                        <td class="px-2 py-3 text-center text-sm text-stone-700 hidden sm:table-cell" x-text="selectedProduct.calories"></td>
                                                        <td class="px-2 py-3">
                                                            <button @click.prevent="removeProduct(selectedProduct.id)"
                                                                    class="h-8 w-8 rounded-xl border border-stone-200 bg-white text-stone-300 hover:text-red-500 hover:border-red-200 transition grid place-items-center">
                                                                <i class="fas fa-times text-sm"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </template>

                                                {{-- Total row --}}
                                                <tr class="bg-stone-50/70">
                                                    <td class="px-3 py-3">
                                                        <div class="flex items-center gap-2">
                                                            <span class="text-sm font-semibold text-stone-700">{{ __('Total (final dish weight)') }}</span>
                                                            <div class="relative group">
                                                                <i class="fas fa-info-circle text-stone-400 cursor-pointer hover:text-stone-600 text-xs"></i>
                                                                <div class="absolute left-0 bottom-full mb-2 w-64 bg-stone-800 text-white text-xs rounded-lg shadow-lg px-3 py-2 hidden group-hover:block z-10">
                                                                    {{ __('Введи вагу ГОТОВОЇ страви після термообробки/води. Саме на неї діляться макроси, щоб порахувати ккал на 100 г.') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-2 py-3">
                                                        <input
                                                            type="number"
                                                            min="1"
                                                            class="w-full h-10 px-2 text-sm border border-amber-300 rounded-lg focus:border-amber-500 focus:ring-amber-500 bg-white"
                                                            x-model="calculated.totalGrams"
                                                        >
                                                    </td>
                                                    <td class="px-2 py-3 text-center text-sm font-semibold text-sky-700 hidden sm:table-cell" x-text="calculated.totalProteins"></td>
                                                    <td class="px-2 py-3 text-center text-sm font-semibold text-amber-700 hidden sm:table-cell" x-text="calculated.totalFats"></td>
                                                    <td class="px-2 py-3 text-center text-sm font-semibold text-emerald-700 hidden sm:table-cell" x-text="calculated.totalCarbohydrates"></td>
                                                    <td class="px-2 py-3 text-center text-sm font-bold text-stone-800 hidden sm:table-cell" x-text="calculated.totalCalories"></td>
                                                    <td class="px-2 py-3"></td>
                                                </tr>

                                                {{-- Per 100 g row --}}
                                                <tr class="bg-amber-50/70">
                                                    <td class="px-3 py-3 text-sm font-semibold text-amber-800 sm:hidden">{{ __('Kcal per 100 gram') }}</td>
                                                    <td class="px-3 py-3 text-sm font-semibold text-amber-800 hidden sm:table-cell">{{ __('Per 100 gram') }}</td>
                                                    <td class="px-2 py-3 hidden sm:table-cell"></td>
                                                    <td class="px-2 py-3 text-center text-sm font-semibold text-sky-700 hidden sm:table-cell" x-text="calculated.proteinsPer100g"></td>
                                                    <td class="px-2 py-3 text-center text-sm font-semibold text-amber-700 hidden sm:table-cell" x-text="calculated.fatsPer100g"></td>
                                                    <td class="px-2 py-3 text-center text-sm font-semibold text-emerald-700 hidden sm:table-cell" x-text="calculated.carbohydratesPer100g"></td>
                                                    <td class="px-2 py-3 text-center text-lg font-extrabold text-amber-700" x-text="calculated.kcalPer100g"></td>
                                                    <td class="px-2 py-3"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </template>

                                {{-- Search / Create toggles --}}
                                <div class="mt-6">
                                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                                        <button
                                            type="button"
                                            @click="createProductForm = false"
                                            class="h-11 px-4 rounded-2xl text-sm font-semibold border transition w-full sm:w-auto"
                                            :class="!createProductForm ? 'bg-stone-900 text-white border-stone-900' : 'bg-white text-stone-700 border-stone-200 hover:bg-stone-50'"
                                        >
                                            {{ __('Search ingredients') }}
                                        </button>
                                        <button
                                            type="button"
                                            @click="createProductForm = true"
                                            class="h-11 px-4 rounded-2xl text-sm font-semibold border transition w-full sm:w-auto"
                                            :class="createProductForm ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-stone-700 border-stone-200 hover:bg-stone-50'"
                                        >
                                            {{ __('Create ingredient') }}
                                        </button>
                                    </div>

                                    <div x-show="createProductForm" class="mt-4">
                                        <livewire:product-create />
                                    </div>
                                    <div x-show="!createProductForm" class="mt-4">
                                        <livewire:product-search />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Side tips --}}
                    <div class="space-y-4">
                        <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur shadow-lg shadow-stone-900/5 p-5 space-y-3">
                            <div class="text-sm font-extrabold text-stone-900">{{ __('Чому важлива вага готової страви?') }}</div>
                            <p class="text-sm text-stone-600">
                                {{ __('Після термообробки вода випаровується або додається — ккал на 100 г змінюються. Ми ділимо сумарні макроси на фактичну вагу готової страви.') }}
                            </p>
                        </div>
                        <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur shadow-lg shadow-stone-900/5 p-5 space-y-3">
                            <div class="text-sm font-extrabold text-stone-900">{{ __('Поради') }}</div>
                            <ul class="space-y-2 text-sm text-stone-600">
                                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-[2px]">✓</span>{{ __('Зважуй готову страву, а не лише інгредієнти') }}</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-[2px]">✓</span>{{ __('Якщо страва “зменшилась” при готуванні — ккал/100 г ростуть') }}</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-[2px]">✓</span>{{ __('Для супів/каші врахуй додану воду чи бульйон') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@php
    $recipeInitial = [
        'selectedProducts' => $initialSelectedProducts,
        'totals' => [
            'totalGrams' => optional($recipe)->total_weight ?? 0,
            'proteinsPer100g' => optional($recipe)->proteins ?? 0,
            'fatsPer100g' => optional($recipe)->fats ?? 0,
            'carbohydratesPer100g' => optional($recipe)->carbohydrates ?? 0,
            'kcalPer100g' => optional($recipe)->calories ?? 0,
        ],
    ];
@endphp

<script type="application/json" id="recipe-initial-data">{!! json_encode($recipeInitial, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

<script>
    function recipeApp() {
        const el = document.getElementById('recipe-initial-data');
        const initial = el ? JSON.parse(el.textContent || '{}') : {};

        const initialTotalGrams = Number(initial?.totals?.totalGrams ?? 0);
        const initialProteinsPer100 = Number(initial?.totals?.proteinsPer100g ?? 0);
        const initialFatsPer100 = Number(initial?.totals?.fatsPer100g ?? 0);
        const initialCarbsPer100 = Number(initial?.totals?.carbohydratesPer100g ?? 0);
        const initialKcalPer100 = Number(initial?.totals?.kcalPer100g ?? 0);
        const initialSelectedProducts = initial?.selectedProducts ?? [];

        return {
            selectedProducts: initialSelectedProducts,
            createProductForm: false,

            calculated: {
                totalGrams: initialTotalGrams,

                totalProteins: 0,
                totalFats: 0,
                totalCarbohydrates: 0,
                totalCalories: 0,
                totalKcal: 0,

                proteinsPer100g: initialProteinsPer100,
                fatsPer100g: initialFatsPer100,
                carbohydratesPer100g: initialCarbsPer100,
                kcalPer100g: initialKcalPer100,
            },

            get canSave() {
                return this.selectedProducts.length > 0
                    && Number(this.calculated.totalGrams) > 0
                    && String(this.$wire.title || '').trim().length > 0;
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
                    this.calculated.totalProteins = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.proteins) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalFats = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.fats) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalCarbohydrates = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.carbohydrates) * product.grams / 100, 0).toFixed(2);
                    this.calculated.totalCalories = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.calories) * product.grams / 100, 0).toFixed(2);
                });
            },

            calculateAll() {
                this.calculated.totalGrams = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.grams || 0), 0);
                this.calculated.totalProteins = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.proteins) * product.grams / 100, 0).toFixed(2);
                this.calculated.totalFats = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.fats) * product.grams / 100, 0).toFixed(2);
                this.calculated.totalCarbohydrates = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.carbohydrates) * product.grams / 100, 0).toFixed(2);
                this.calculated.totalCalories = this.selectedProducts.reduce((acc, product) => acc + parseFloat(product.calories) * product.grams / 100, 0).toFixed(2);

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
                if (!this.canSave) return;
                this.$wire.call('save', this.selectedProducts, this.calculated);
            }
        }
    }
</script>
