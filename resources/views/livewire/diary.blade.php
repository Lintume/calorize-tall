@php use Illuminate\Support\Str; @endphp
<div x-data="diaryApp()" class="mb-10" @select-product.window="addProduct($event.detail)" x-cloak>

    @section('title', __('Diary'))

    {{-- Success message --}}
    <div x-show="successMessage" x-text="successMessage"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="mt-4 bg-emerald-600 text-white p-3 rounded-xl mb-4 shadow-lg"></div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="mt-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl mb-4">
            @foreach ($errors->all() as $error)
                <div class="text-sm">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Main Content Card --}}
    <div class="rounded-2xl bg-white border border-stone-200 shadow-sm overflow-hidden mt-6">

        {{-- Compact Header: Date + Macros + Save --}}
        <div class="border-b border-stone-100 px-4 py-3">
            <div class="flex items-center justify-between gap-3">
                {{-- Date Navigation --}}
                <div class="flex items-center gap-1.5">
                    <button wire:click="changeDate(-1)"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-stone-500 hover:bg-stone-100 transition-colors">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>

                    <div class="relative">
                        <input wire:model.live="date" type="date" id="date"
                               class="opacity-0 absolute inset-0 w-full h-full cursor-pointer" />
                        <div class="px-3 py-1.5 text-sm font-medium text-stone-800 cursor-pointer hover:text-amber-700 transition-colors">
                            <span x-text="formattedDate"></span>
                        </div>
                    </div>

                    <button wire:click="changeDate(1)"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-stone-500 hover:bg-stone-100 transition-colors">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>

                    <button wire:click="goToToday" x-show="!isToday"
                            class="ml-1 px-2 py-1 text-xs font-medium text-amber-700 hover:bg-amber-50 rounded transition-colors">
                        {{ __('Today') }}
                    </button>
                </div>

                {{-- Macros inline --}}
                <div class="hidden sm:flex items-center gap-4 text-xs">
                    <span class="text-blue-600 font-medium">
                        <span class="text-stone-400">{{ __('Prot') }}:</span>
                        <span x-text="totalProteins"></span>
                    </span>
                    <span class="text-orange-500 font-medium">
                        <span class="text-stone-400">{{ __('Fat') }}:</span>
                        <span x-text="totalFats"></span>
                    </span>
                    <span class="text-emerald-600 font-medium">
                        <span class="text-stone-400">{{ __('Carb') }}:</span>
                        <span x-text="totalCarbohydrates"></span>
                    </span>
                </div>

                {{-- Save button --}}
                <button @click="save"
                        class="px-3 py-1.5 text-sm font-medium text-amber-700 hover:bg-amber-50 rounded-lg transition-colors">
                    <i class="fas fa-check mr-1"></i>
                    {{ __('Save') }}
                </button>
            </div>

            {{-- Mobile macros --}}
            <div class="sm:hidden flex justify-center gap-4 text-xs mt-2 pt-2 border-t border-stone-100">
                <span class="text-blue-600 font-medium">
                    <span class="text-stone-400">{{ __('Prot') }}:</span>
                    <span x-text="totalProteins"></span>
                </span>
                <span class="text-orange-500 font-medium">
                    <span class="text-stone-400">{{ __('Fat') }}:</span>
                    <span x-text="totalFats"></span>
                </span>
                <span class="text-emerald-600 font-medium">
                    <span class="text-stone-400">{{ __('Carb') }}:</span>
                    <span x-text="totalCarbohydrates"></span>
                </span>
            </div>
        </div>

        {{-- Meal Sections --}}
        <div class="p-3 md:p-4 space-y-2">
            @foreach(['breakfast', 'lunch', 'dinner', 'snack'] as $intake)
                {{-- Meal Header --}}
                <div @click="setActiveMeal('{{ $intake }}')"
                     :class="active === '{{ $intake }}' ? 'border-amber-200 bg-amber-50/50' : 'border-stone-100 hover:border-stone-200'"
                     class="rounded-xl border p-3 flex justify-between items-center cursor-pointer transition-all duration-200">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm"
                             :class="active === '{{ $intake }}' ? 'bg-amber-100 text-amber-600' : 'bg-stone-100 text-stone-400'">
                            @if($intake === 'breakfast')
                                <i class="fas fa-sun"></i>
                            @elseif($intake === 'lunch')
                                <i class="fas fa-utensils"></i>
                            @elseif($intake === 'dinner')
                                <i class="fas fa-moon"></i>
                            @else
                                <i class="fas fa-cookie-bite"></i>
                            @endif
                        </div>
                        <span class="font-medium text-stone-800" x-text="foodIntakes.{{ $intake }}.translatable"></span>
                        <span x-text="foodIntakes.{{ $intake }}.totalCalories"
                              :class="foodIntakes.{{ $intake }}.totalCalories > 0 ? 'text-amber-700' : 'text-stone-400'"
                              class="text-sm font-medium">
                        </span>
                    </div>
                    <i :class="active === '{{ $intake }}' ? 'fas fa-chevron-up text-amber-500' : 'fas fa-chevron-down text-stone-300'"
                       class="text-xs"></i>
                </div>

                {{-- Meal Content (expanded) --}}
                <div x-show="active === '{{ $intake }}'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="px-2">

                    {{-- Food Intake Table --}}
                    <template x-if="foodIntakes.{{ $intake }}.products.length">
                        <div class="mt-3 overflow-x-auto">
                            <table class="w-full table-fixed">
                                <thead>
                                    <tr class="border-b border-stone-100">
                                        <th class="px-2 py-2 text-left text-xs font-medium text-stone-400 uppercase">{{ __('Title') }}</th>
                                        <th class="w-16 sm:w-20 px-1 py-2 text-left text-xs font-medium text-stone-400 uppercase">{{ __('Grams') }}</th>
                                        <th class="w-12 sm:w-14 px-1 py-2 text-center text-xs font-medium text-stone-400 uppercase hidden sm:table-cell">{{ __('Prot') }}</th>
                                        <th class="w-12 sm:w-14 px-1 py-2 text-center text-xs font-medium text-stone-400 uppercase hidden sm:table-cell">{{ __('Fat') }}</th>
                                        <th class="w-12 sm:w-14 px-1 py-2 text-center text-xs font-medium text-stone-400 uppercase hidden sm:table-cell">{{ __('Carb') }}</th>
                                        <th class="w-14 sm:w-16 px-2 py-2 text-center text-xs font-medium text-stone-400 uppercase">{{ __('Kcal') }}</th>
                                        <th class="w-8 px-1 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-50">
                                    <template x-for="prod in foodIntakes.{{ $intake }}.products" :key="prod.id">
                                        <tr class="hover:bg-stone-50/50">
                                            <td class="px-2 py-2 text-sm text-stone-700 truncate" x-text="prod.product.title"></td>
                                            <td class="px-1 py-2">
                                                <input type="number" min="0"
                                                       :id="'grams-' + prod.product_id"
                                                       class="w-full h-8 px-2 text-sm border border-stone-200 rounded-lg focus:border-amber-500 focus:ring-amber-500"
                                                       x-model="prod.g">
                                            </td>
                                            <td class="px-1 py-2 text-center text-sm text-stone-400 hidden sm:table-cell" x-text="prod.proteins"></td>
                                            <td class="px-1 py-2 text-center text-sm text-stone-400 hidden sm:table-cell" x-text="prod.fats"></td>
                                            <td class="px-1 py-2 text-center text-sm text-stone-400 hidden sm:table-cell" x-text="prod.carbohydrates"></td>
                                            <td class="px-2 py-2 text-center text-sm font-medium text-stone-600" x-text="prod.calories"></td>
                                            <td class="px-1 py-2">
                                                <button @click.prevent="removeProduct(prod.product_id)"
                                                        class="text-stone-300 hover:text-red-500 transition-colors">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    {{-- Total Row --}}
                                    <tr class="bg-stone-50/50 hidden sm:table-row">
                                        <td class="px-2 py-2 text-sm font-medium text-stone-600">{{ __('Total') }}</td>
                                        <td></td>
                                        <td class="px-1 py-2 text-center text-sm font-medium text-blue-600" x-text="foodIntakes.{{ $intake }}.totalProteins"></td>
                                        <td class="px-1 py-2 text-center text-sm font-medium text-orange-500" x-text="foodIntakes.{{ $intake }}.totalFats"></td>
                                        <td class="px-1 py-2 text-center text-sm font-medium text-emerald-600" x-text="foodIntakes.{{ $intake }}.totalCarbohydrates"></td>
                                        <td class="px-2 py-2 text-center text-sm font-bold text-amber-600" x-text="foodIntakes.{{ $intake }}.totalCalories"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>

                    {{-- Empty State --}}
                    <template x-if="!foodIntakes.{{ $intake }}.products.length">
                        <div class="mt-3 py-4 text-center text-sm text-stone-400">
                            {{ __('No products added yet') }}
                        </div>
                    </template>

                    {{-- Search or Create Product --}}
                    <div x-show="createProductForm" class="mt-3">
                        <livewire:product-create wire:key="productCreate-{{ Str::random() }}"/>
                    </div>
                    <div x-show="!createProductForm" class="mt-3">
                        <livewire:product-search wire:key="productSearch-{{ Str::random() }}"/>
                    </div>
                </div>
            @endforeach

            {{-- Measurements Section --}}
            <div @click="active === 'measurements' ? active = null : active = 'measurements'"
                 :class="active === 'measurements' ? 'border-amber-200 bg-amber-50/50' : 'border-stone-100 hover:border-stone-200'"
                 class="rounded-xl border p-3 flex justify-between items-center cursor-pointer transition-all duration-200">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm"
                         :class="active === 'measurements' ? 'bg-amber-100 text-amber-600' : 'bg-stone-100 text-stone-400'">
                        <i class="fas fa-ruler"></i>
                    </div>
                    <span class="font-medium text-stone-800">{{ __('Measurements') }}</span>
                </div>
                <i :class="active === 'measurements' ? 'fas fa-chevron-up text-amber-500' : 'fas fa-chevron-down text-stone-300'"
                   class="text-xs"></i>
            </div>

            {{-- Measurements Content --}}
            <div x-show="active === 'measurements'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="grid grid-cols-2 sm:grid-cols-4 gap-3 px-2 pt-3">
                <template x-for="(measurement, index) in measurements" :key="index">
                    <div>
                        <label x-text="measurement.translatable"
                               class="block text-xs font-medium text-stone-500 mb-1"></label>
                        <input type="number" x-model="measurement.value" min="1" step="0.1"
                               class="block w-full rounded-lg border-stone-200 text-sm py-2 px-2.5 focus:border-amber-500 focus:ring-amber-500"
                               @focus="if (measurement.value == 0) measurement.value = ''">
                    </div>
                </template>
                <div class="flex items-end">
                    <button @click="save"
                            class="w-full py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Floating Calorie Counter --}}
    <div @click="showRemainingCalories = !showRemainingCalories"
         class="fixed bottom-6 right-6 z-40 cursor-pointer">
        <div :class="{
                'bg-gradient-to-br from-emerald-500 to-emerald-600': showRemainingCalories && remainingCalories >= 0,
                'bg-gradient-to-br from-red-500 to-red-600': showRemainingCalories && remainingCalories < 0,
                'bg-gradient-to-br from-amber-500 to-amber-600': !showRemainingCalories
             }"
             class="w-16 h-16 rounded-full flex flex-col items-center justify-center text-white shadow-lg hover:scale-105 transition-transform">
            <div x-show="!showRemainingCalories" class="text-lg font-bold" x-text="totalCalories"></div>
            <div x-show="showRemainingCalories" class="text-lg font-bold" x-text="remainingCalories"></div>
            <div class="text-[10px] font-medium opacity-80">{{ __('Kcal') }}</div>
        </div>
    </div>

    <x-loading-screen/>

    {{-- AI Chat Assistant --}}
    <livewire:diary-chat :date="$date" />
</div>

<script>
    function diaryApp() {
        return {
            active: null,
            createProductForm: false,
            showRemainingCalories: false,

            totalCalories: 0,
            remainingCalories: 0,

            totalFats: 0,
            totalProteins: 0,
            totalCarbohydrates: 0,

            successMessage: '',

            foodIntakes: {
                breakfast: {
                    translatable: "{{ __('Breakfast') }}",
                    products: @json($breakfast ?? []),
                },
                lunch: {
                    translatable: "{{ __('Lunch') }}",
                    products: @json($lunch ?? []),
                },
                dinner: {
                    translatable: "{{ __('Dinner') }}",
                    products: @json($dinner ?? []),
                },
                snack: {
                    translatable: "{{ __('Snack') }}",
                    products: @json($snack ?? []),
                }
            },
            measurements: {
                weight: {
                    translatable: "{{ __('Weight') }}",
                    value: @json($measurement->kg ?? ''),
                },
                chest: {
                    translatable: "{{ __('Chest') }}",
                    value: @json($measurement->chest_cm ?? ''),
                },
                waist: {
                    translatable: "{{ __('Waist') }}",
                    value: @json($measurement->waist_cm ?? ''),
                },
                thighs: {
                    translatable: "{{ __('Thighs') }}",
                    value: @json($measurement->thighs_cm ?? ''),
                },
                wrist: {
                    translatable: "{!! __('Wrist') !!}",
                    value: @json($measurement->wrist_cm ?? ''),
                },
                neck: {
                    translatable: "{{ __('Neck') }}",
                    value: @json($measurement->neck_cm ?? ''),
                },
                biceps: {
                    translatable: "{{ __('Biceps') }}",
                    value: @json($measurement->biceps_cm ?? ''),
                }
            },

            get formattedDate() {
                const date = new Date(this.$wire.date + 'T00:00:00');
                const options = { weekday: 'short', day: 'numeric', month: 'short' };
                return date.toLocaleDateString('{{ app()->getLocale() }}', options);
            },

            get isToday() {
                const today = new Date();
                const selected = new Date(this.$wire.date + 'T00:00:00');
                return today.toDateString() === selected.toDateString();
            },

            init() {
                this.$nextTick(() => {
                    this.calculate();
                });

                this.$watch('foodIntakes', value => {
                    this.calculate();
                }, {deep: true});

                this.$wire.on('productCreateCancelled', () => {
                    this.createProductForm = false;
                });
                this.$wire.on('updatedDate', (foodIntakes) => {
                    this.foodIntakes.breakfast.products = foodIntakes[0];
                    this.foodIntakes.lunch.products = foodIntakes[1];
                    this.foodIntakes.dinner.products = foodIntakes[2];
                    this.foodIntakes.snack.products = foodIntakes[3];
                    this.calculate();

                    this.measurements.weight.value = foodIntakes[4].kg;
                    this.measurements.chest.value = foodIntakes[4].chest_cm;
                    this.measurements.waist.value = foodIntakes[4].waist_cm;
                    this.measurements.thighs.value = foodIntakes[4].thighs_cm;
                    this.measurements.wrist.value = foodIntakes[4].wrist_cm;
                    this.measurements.neck.value = foodIntakes[4].neck_cm;
                    this.measurements.biceps.value = foodIntakes[4].biceps_cm;

                    Livewire.dispatch('date-changed', { date: this.$wire.date });
                });

                this.$wire.on('success', message => {
                    this.successMessage = message;
                    setTimeout(() => {
                        this.successMessage = '';
                    }, 3000);
                });

                this.$wire.on('productAdded', product => {
                    const productId = product[0].id;
                    this.foodIntakes[this.active].products.push(this.formProductAsFoodIntake(product[0]));
                    this.createProductForm = false;
                    this.$nextTick(() => {
                        const gramsInput = document.getElementById('grams-' + productId);
                        if (gramsInput) {
                            gramsInput.focus();
                            gramsInput.select();
                        }
                    });
                });
            },
            calculate() {
                for (let key in this.foodIntakes) {
                    if (this.foodIntakes.hasOwnProperty(key)) {
                        let intake = this.foodIntakes[key];
                        intake.products.forEach(product => {
                            product.calories = Math.round(product.product.calories * product.g / 100);
                            product.fats = Math.round(product.product.fats * product.g / 100);
                            product.proteins = Math.round(product.product.proteins * product.g / 100);
                            product.carbohydrates = Math.round(product.product.carbohydrates * product.g / 100);
                        });
                        intake.totalCalories = intake.products.reduce((acc, product) => acc + product.calories, 0);
                        intake.totalFats = intake.products.reduce((acc, product) => acc + product.fats, 0);
                        intake.totalProteins = intake.products.reduce((acc, product) => acc + product.proteins, 0);
                        intake.totalCarbohydrates = intake.products.reduce((acc, product) => acc + product.carbohydrates, 0);
                    }
                }
                this.totalCalories = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalCalories, 0);
                this.remainingCalories = Math.round({{ Auth::user()->kcal_per_day ?: 2000 }} - this.totalCalories);
                this.totalFats = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalFats, 0);
                this.totalProteins = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalProteins, 0);
                this.totalCarbohydrates = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalCarbohydrates, 0);
            },
            addProduct(product) {
                product = JSON.parse(product);
                if (this.foodIntakes[this.active].products.find(p => p.product_id === product.id)) {
                    return;
                }
                const productId = product.id;
                this.foodIntakes[this.active].products.push(this.formProductAsFoodIntake(product));
                this.$nextTick(() => {
                    const gramsInput = document.getElementById('grams-' + productId);
                    if (gramsInput) {
                        gramsInput.focus();
                        gramsInput.select();
                    }
                });
            },

            formProductAsFoodIntake(product) {
                let productCopy = JSON.parse(JSON.stringify(product));
                product.g = 100;
                product.product_id = product.id;
                product.product = productCopy;
                return product;
            },

            removeProduct(productId) {
                this.foodIntakes[this.active].products = this.foodIntakes[this.active].products.filter(product => product.product_id !== productId);
            },

            save() {
                this.$wire.call('save', this.foodIntakes, this.measurements);
            },

            refreshDiary() {
                this.$wire.refreshDiary();
            },

            setActiveMeal(meal) {
                this.active = (this.active === meal) ? null : meal;
                Livewire.dispatch('meal-selected', { meal: this.active });
            }
        }
    }
</script>
