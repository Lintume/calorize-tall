@php use Illuminate\Support\Str; @endphp
<div x-data="diaryApp()" class="mb-10" @select-product.window="addProduct($event.detail)" x-cloak>

    @section('title', __('Diary'))

    {{--    success message--}}
    <div x-show="successMessage" x-text="successMessage" class="mt-4 bg-green-600 text-white p-2 rounded mb-4"></div>

{{--    errors--}}
    <div class="text-red-600">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    <div class="flex flex-wrap mt-8 mb-4">
        <div class="flex w-full items-center">
            <!-- Previous button -->
            <button wire:click="changeDate(-1)"
                class="px-4 py-2 rounded-l-md">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Datepicker -->
            <input
                wire:model.live="date"
                type="date"
                id="date"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            />
            <div class="text-red-600">@error('date') {{ $message }} @enderror</div>

            <!-- Next button -->
            <button wire:click="changeDate(1)"
                class="px-4 py-2 rounded-r-md">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Save button -->
            <x-primary-button class="ml-4" @click="save">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </div>
    <div class="flex flex-col justify-center">
        <div class="flex flex-col shadow justify-between rounded-lg pb-4 xl:p-8 mt-3 bg-white">
            <div class="block-container p-4 md:p-8 xl:p-10 space-y-3">
                @foreach(['breakfast', 'lunch', 'dinner', 'snack'] as $intake)

                    {{--food intake label--}}
                    <div @click="(active === '{{ $intake }}') ? (active = null) : (active = '{{ $intake }}')"
                         class="rounded-lg border border-gray-300 p-4 flex justify-between items-center cursor-pointer">
                        <div class="flex items-center">
                            <div class="text-xl" x-text="foodIntakes.{{ $intake }}.translatable"></div>
                            <div x-text="foodIntakes.{{ $intake }}.totalCalories"
                                 class="ml-3 inline-flex px-2 items-center bg-gray-400 border border-transparent rounded-md font-semibold text-white tracking-widest">
                            </div>
                        </div>
                        <i x-show="active !== '{{ $intake }}'" class="fas fa-plus"></i>
                        <i x-show="active === '{{ $intake }}'" class="fas fa-minus"></i>
                    </div>

                    <div x-show="active === '{{ $intake }}'">

                        {{--food intake table--}}
                        <template x-if="foodIntakes.{{ $intake }}.products.length">
                            <table class="mt-5 min-w-full divide-y divide-gray-200 table-fixed">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                        <th class="w-1/12 px-1 py-2 text-xs text-left font-medium text-gray-400 uppercase tracking-wider">{{ __('Grams') }}</th>
                                        <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Prot') }}</th>
                                        <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Fat') }}</th>
                                        <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider hidden sm:table-cell">{{ __('Carb') }}</th>
                                        <th class="w-1/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider sm:table-cell">{{ __('Kcal') }}</th>
                                        <th class="w-1/12 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="prod in foodIntakes.{{ $intake }}.products" :key="prod.id">
                                        <tr>
                                            <td class="px-2 py-4 break-words" x-text="prod.product.title"></td>
                                            <td class="px-2 py-4">
                                                <input type="number" min="0"
                                                       class="w-full h-10 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                       x-model="prod.g">
                                            </td>
                                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                                x-text="prod.proteins"></td>
                                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                                x-text="prod.fats"></td>
                                            <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                                x-text="prod.carbohydrates"></td>
                                            <td class="px-2 py-3 text-center whitespace-nowrap sm:table-cell"
                                                x-text="prod.calories"></td>
                                            <td class="px-2 py-3 whitespace-nowrap">
                                                <a href="#" @click.prevent="removeProduct(prod.product_id)"
                                                   class="text-red-500 hover:underline">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr class="bg-gray-50 hidden sm:table-row">
                                        <td class="px-2 py-4 break-words">{{ __('Total') }}</td>
                                        <td class="px-2 py-4"></td>
                                        <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                            x-text="foodIntakes.{{ $intake }}.totalProteins"></td>
                                        <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                            x-text="foodIntakes.{{ $intake }}.totalFats"></td>
                                        <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap hidden sm:table-cell"
                                            x-text="foodIntakes.{{ $intake }}.totalCarbohydrates"></td>
                                        <td class="px-2 py-3 text-center whitespace-nowrap sm:table-cell"
                                            x-text="foodIntakes.{{ $intake }}.totalCalories"></td>
                                        <td class="px-2 py-3 whitespace-nowrap"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>

                        {{--search or create product--}}
                        <div x-show="createProductForm" class="mt-5">
                            <livewire:product-create wire:key="productCreate-{{ Str::random() }}"/>
                        </div>
                        <div x-show="!createProductForm" class="mt-5">
                            <livewire:product-search wire:key="productSearch-{{ Str::random() }}"/>
                        </div>
                    </div>
                @endforeach
                <div class="rounded-lg border border-gray-300 p-2 flex justify-around">
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

                {{--measurements--}}
                <div @click="active === 'measurements' ? active = null : active = 'measurements'"
                     class="rounded-lg border border-gray-300 p-4 flex justify-between items-center cursor-pointer">
                    <div> {{ __('Measurements') }}</div>
                    <i x-show="active !== 'measurements'" class="fas fa-plus"></i>
                    <i x-show="active === 'measurements'" class="fas fa-minus"></i>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-4 gap-4" x-show="active === 'measurements'">
                    <template x-for="(measurement, index) in measurements" :key="index">
                        <div>
                            <label x-text="measurement.translatable"
                                   class="block text-sm font-medium text-gray-700"></label>
                            <input type="number" x-model="measurement.value" min="1" step="0.1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                   @focus="if (measurement.value == 0) measurement.value = ''">
                        </div>
                    </template>
                    <div class="flex flex-col justify-end h-full">
                        <x-primary-button @click="save"
                            class="self-end">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div @click="toggleRemainingCalories">
        <div @mouseover="showTooltip = true" @mouseleave="showTooltip = false"
             :class="{
            'bg-green-600': showRemainingCalories && remainingCalories >= 0,
            'bg-red-600': showRemainingCalories && remainingCalories < 0,
            'bg-yellow-600': !showRemainingCalories
         }"
             class="fixed bottom-0 right-0 mb-4 mr-4 w-20 h-20 rounded-full z-50 flex flex-col items-center justify-center bg-opacity-75 text-white">
            <div x-show="!showRemainingCalories" class="font-bold" x-text="totalCalories"></div>
            <div x-show="showRemainingCalories" class="font-bold" x-text="remainingCalories"></div>
            <div class="text-xs">{{ __('Kcal') }}</div>
        </div>
        <div x-show="showTooltip" class="absolute bottom-24 right-0 mb-4 mr-4 w-48 p-2 bg-gray-800 text-white rounded shadow-lg">
            <div class="flex justify-between items-center">
                <span>{{ __('Click circle to see remaining calories') }}</span>
            </div>
        </div>
    </div>
    <x-loading-screen/>
</div>

<script>
    function diaryApp() {
        return {
            active: null, // breakfast, lunch, dinner, snack, measurements
            showRemainingCalories: false,
            createProductForm: false,

            totalCalories: 0,
            remainingCalories: 0,
            showTooltip: false,

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
            init() {
                // after initialization
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
                });

                this.$wire.on('success', message => {
                    this.successMessage = message;
                    setTimeout(() => {
                        this.successMessage = '';
                    }, 3000); // Hide after 3 seconds
                });

                this.$wire.on('productAdded', product => {
                    this.foodIntakes[this.active].products.push(this.formProductAsFoodIntake(product[0]));
                    this.createProductForm = false;
                });

                const lastShown = localStorage.getItem('tooltipLastShown');
                const now = new Date();
                if (!lastShown || (now - new Date(lastShown)) > 30 * 24 * 60 * 60 * 1000) {
                    this.showTooltip = true;
                    localStorage.setItem('tooltipLastShown', now);
                }
            },
            calculate() {
                for (let key in this.foodIntakes) {
                    if (this.foodIntakes.hasOwnProperty(key)) {
                        let intake = this.foodIntakes[key];
                        // calculate all products calories
                        intake.products.forEach(product => {
                            product.calories = Math.round(product.product.calories * product.g / 100);
                            product.fats = Math.round(product.product.fats * product.g / 100);
                            product.proteins = Math.round(product.product.proteins * product.g / 100);
                            product.carbohydrates = Math.round(product.product.carbohydrates * product.g / 100);
                        });
                        // calculate total intake calories
                        intake.totalCalories = intake.products.reduce((acc, product) => acc + product.calories, 0);
                        intake.totalFats = intake.products.reduce((acc, product) => acc + product.fats, 0);
                        intake.totalProteins = intake.products.reduce((acc, product) => acc + product.proteins, 0);
                        intake.totalCarbohydrates = intake.products.reduce((acc, product) => acc + product.carbohydrates, 0);
                    }
                }
                this.totalCalories = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalCalories, 0);
                this.remainingCalories = Math.round({{ Auth::user()->kcal_per_day }} - this.totalCalories);
                this.totalFats = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalFats, 0);
                this.totalProteins = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalProteins, 0);
                this.totalCarbohydrates = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalCarbohydrates, 0);
            },
            addProduct(product) {
                product = JSON.parse(product);
                if (this.foodIntakes[this.active].products.find(p => p.product_id === product.id)) {
                    return;
                }
                this.foodIntakes[this.active].products.push(this.formProductAsFoodIntake(product));
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

            toggleRemainingCalories() {
                this.showRemainingCalories = !this.showRemainingCalories;
                this.showTooltip = false;
            }
        }
    }
</script>