@php use Illuminate\Support\Str; @endphp

<div x-data="diaryApp()"
     x-init="init()"
     class="pb-24"
     @select-product.window="addProduct($event.detail)"
     x-cloak
>
    @section('title', __('Diary'))

    {{-- Toast: success --}}
    <div
        x-show="successMessage"
        x-text="successMessage"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="fixed top-20 sm:top-24 left-1/2 -translate-x-1/2 z-50 max-w-[92vw] sm:max-w-md rounded-2xl bg-emerald-600 text-white px-4 py-3 shadow-2xl shadow-emerald-600/20"
    ></div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="mt-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700">
            <div class="font-semibold text-sm mb-2">{{ __('Please fix the errors below') }}</div>
            <div class="space-y-1">
                @foreach ($errors->all() as $error)
                    <div class="text-sm">{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
        {{-- Header --}}
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-stone-200/70 bg-[radial-gradient(900px_circle_at_15%_-10%,rgba(245,158,11,0.18),transparent_55%),radial-gradient(700px_circle_at_90%_0%,rgba(14,165,233,0.12),transparent_55%),linear-gradient(to_bottom,rgba(255,255,255,0.7),rgba(255,255,255,0.7))]">
            <div class="flex items-center gap-3">
                {{-- Date nav --}}
                <div class="flex-1 min-w-0 flex items-center rounded-2xl border border-stone-200 bg-white/70 backdrop-blur p-1 shadow-sm">
                    <button
                        wire:click="changeDate(-1)"
                        class="h-10 w-10 rounded-xl grid place-items-center text-stone-700 hover:bg-stone-50 active:scale-[0.98] transition shrink-0"
                        aria-label="{{ __('Previous day') }}"
                    >
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>

                    <div class="relative px-2 sm:px-3 min-w-[96px] sm:min-w-[120px] text-center flex-1">
                        <input
                            wire:model.live="date"
                            type="date"
                            id="date"
                            class="opacity-0 absolute inset-0 w-full h-full cursor-pointer"
                        />
                        <div class="text-xs text-stone-500 font-semibold">{{ __('Date') }}</div>
                        <div class="text-sm sm:text-base font-extrabold text-stone-900 whitespace-nowrap" x-text="formattedDate"></div>
                    </div>

                    <button
                        wire:click="changeDate(1)"
                        class="h-10 w-10 rounded-xl grid place-items-center text-stone-700 hover:bg-stone-50 active:scale-[0.98] transition shrink-0"
                        aria-label="{{ __('Next day') }}"
                    >
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>

                {{-- Desktop macros (compact) --}}
                <div class="hidden lg:flex items-center gap-2">
                    <div class="inline-flex items-center gap-2 rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-3 py-2">
                        <span class="text-xs font-semibold text-stone-500">{{ __('Prot') }}</span>
                        <span class="text-sm font-extrabold text-sky-700" x-text="totalProteins"></span>
                    </div>
                    <div class="inline-flex items-center gap-2 rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-3 py-2">
                        <span class="text-xs font-semibold text-stone-500">{{ __('Fat') }}</span>
                        <span class="text-sm font-extrabold text-amber-700" x-text="totalFats"></span>
                    </div>
                    <div class="inline-flex items-center gap-2 rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-3 py-2">
                        <span class="text-xs font-semibold text-stone-500">{{ __('Carb') }}</span>
                        <span class="text-sm font-extrabold text-emerald-700" x-text="totalCarbohydrates"></span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 shrink-0">
                    <button
                        wire:click="goToToday"
                        :class="isToday ? 'opacity-0 pointer-events-none' : 'opacity-100'"
                        class="h-10 w-10 sm:w-auto sm:px-4 rounded-2xl border border-stone-200 bg-white/70 backdrop-blur text-sm font-semibold text-stone-800 hover:bg-white transition grid place-items-center sm:inline-flex sm:items-center sm:gap-2"
                        aria-label="{{ __('Today') }}"
                    >
                        <i class="fas fa-calendar-day text-sm sm:text-xs"></i>
                        <span class="hidden sm:inline">{{ __('Today') }}</span>
                    </button>

                    <button
                        @click="save"
                        class="h-10 w-10 sm:w-auto sm:px-4 rounded-2xl bg-stone-900 text-white text-sm font-semibold shadow-lg shadow-stone-900/10 hover:bg-stone-800 active:scale-[0.98] transition grid place-items-center sm:inline-flex sm:items-center sm:gap-2"
                    >
                        <i class="fas fa-check text-xs"></i>
                        <span class="hidden sm:inline">{{ __('Save') }}</span>
                    </button>
                </div>
            </div>

            {{-- Mobile macros --}}
            <div class="mt-3 grid grid-cols-3 gap-2 lg:hidden">
                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-3 py-2">
                    <div class="text-[11px] font-semibold text-stone-500">{{ __('Prot') }}</div>
                    <div class="text-sm font-extrabold text-sky-700 leading-tight" x-text="totalProteins"></div>
                </div>
                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-3 py-2">
                    <div class="text-[11px] font-semibold text-stone-500">{{ __('Fat') }}</div>
                    <div class="text-sm font-extrabold text-amber-700 leading-tight" x-text="totalFats"></div>
                </div>
                <div class="rounded-2xl border border-stone-200 bg-white/70 backdrop-blur px-3 py-2">
                    <div class="text-[11px] font-semibold text-stone-500">{{ __('Carb') }}</div>
                    <div class="text-sm font-extrabold text-emerald-700 leading-tight" x-text="totalCarbohydrates"></div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-3 sm:p-4 space-y-3">
            @foreach(['breakfast', 'lunch', 'dinner', 'snack'] as $intake)
                @php
                    $icon = match ($intake) {
                        'breakfast' => 'fa-sun',
                        'lunch' => 'fa-utensils',
                        'dinner' => 'fa-moon',
                        default => 'fa-cookie-bite',
                    };
                @endphp

                <div class="rounded-[1.25rem] border border-stone-200 bg-white overflow-hidden">
                    {{-- Meal header --}}
                    <button
                        type="button"
                        @click="setActiveMeal('{{ $intake }}')"
                        class="w-full px-4 py-3 flex items-center justify-between gap-3 hover:bg-stone-50/50 transition"
                        :class="active === '{{ $intake }}' ? 'bg-amber-50/40' : ''"
                    >
                        <div class="flex items-center gap-3 min-w-0">
                            <div
                                class="h-10 w-10 rounded-2xl grid place-items-center border"
                                :class="active === '{{ $intake }}' ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-stone-700 border-stone-200'"
                            >
                                <i class="fas {{ $icon }} text-sm"></i>
                            </div>

                            <div class="min-w-0 text-left">
                                <div class="text-sm font-extrabold text-stone-900 truncate" x-text="foodIntakes.{{ $intake }}.translatable"></div>
                                <div class="text-xs text-stone-500">
                                    <span x-text="foodIntakes.{{ $intake }}.products.length"></span>
                                    <span class="ml-1">{{ __('items') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            <div
                                class="px-3 py-1.5 rounded-2xl border text-xs font-extrabold"
                                :class="foodIntakes.{{ $intake }}.totalCalories > 0 ? 'bg-amber-50 border-amber-200 text-amber-800' : 'bg-stone-50 border-stone-200 text-stone-500'"
                            >
                                <span x-text="foodIntakes.{{ $intake }}.totalCalories"></span>
                                <span class="font-semibold">kcal</span>
                            </div>
                            <i
                                class="fas text-stone-400 text-xs"
                                :class="active === '{{ $intake }}' ? 'fa-chevron-up' : 'fa-chevron-down'"
                            ></i>
                        </div>
                    </button>

                    {{-- Meal content --}}
                    <div
                        x-show="active === '{{ $intake }}'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="px-4 pb-4"
                    >
                        {{-- Items table --}}
                        <template x-if="foodIntakes.{{ $intake }}.products.length">
                            <div class="mt-3 overflow-x-auto">
                                <table class="w-full table-fixed">
                                    <thead>
                                    <tr class="border-b border-stone-200/60">
                                        <th class="px-2 py-2 text-left text-[11px] font-semibold text-stone-500 uppercase">{{ __('Title') }}</th>
                                        <th class="w-20 px-2 py-2 text-left text-[11px] font-semibold text-stone-500 uppercase">{{ __('Grams') }}</th>
                                        <th class="w-14 px-2 py-2 text-center text-[11px] font-semibold text-stone-500 uppercase hidden sm:table-cell">{{ __('Prot') }}</th>
                                        <th class="w-14 px-2 py-2 text-center text-[11px] font-semibold text-stone-500 uppercase hidden sm:table-cell">{{ __('Fat') }}</th>
                                        <th class="w-14 px-2 py-2 text-center text-[11px] font-semibold text-stone-500 uppercase hidden sm:table-cell">{{ __('Carb') }}</th>
                                        <th class="w-16 px-2 py-2 text-center text-[11px] font-semibold text-stone-500 uppercase">{{ __('Kcal') }}</th>
                                        <th class="w-10 px-2 py-2"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-stone-100">
                                    <template x-for="(prod, idx) in foodIntakes.{{ $intake }}.products" :key="prod.id || (prod.product_id + '-' + idx)">
                                        <tr class="hover:bg-stone-50/50">
                                            <td class="px-2 py-2 text-sm text-stone-800 truncate" x-text="prod.product.title"></td>
                                            <td class="px-2 py-2">
                                                <input
                                                    type="number"
                                                    min="0"
                                                    :id="'grams-' + prod.product_id"
                                                    class="w-full h-9 rounded-xl border-stone-200 text-sm px-2 focus:border-amber-500 focus:ring-amber-500"
                                                    x-model="prod.g"
                                                >
                                            </td>
                                            <td class="px-2 py-2 text-center text-sm text-sky-700 hidden sm:table-cell" x-text="prod.proteins"></td>
                                            <td class="px-2 py-2 text-center text-sm text-amber-700 hidden sm:table-cell" x-text="prod.fats"></td>
                                            <td class="px-2 py-2 text-center text-sm text-emerald-700 hidden sm:table-cell" x-text="prod.carbohydrates"></td>
                                            <td class="px-2 py-2 text-center text-sm font-semibold text-stone-700" x-text="prod.calories"></td>
                                            <td class="px-2 py-2 text-right">
                                                <button
                                                    type="button"
                                                    @click.prevent="removeProduct(prod.product_id)"
                                                    class="h-8 w-8 rounded-xl border border-stone-200 bg-white grid place-items-center text-stone-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition"
                                                    aria-label="{{ __('Remove') }}"
                                                >
                                                    <i class="fas fa-times text-[10px]"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr class="bg-stone-50/50 hidden sm:table-row">
                                        <td class="px-2 py-2 text-sm font-semibold text-stone-600">{{ __('Total') }}</td>
                                        <td></td>
                                        <td class="px-2 py-2 text-center text-sm font-semibold text-sky-700" x-text="foodIntakes.{{ $intake }}.totalProteins"></td>
                                        <td class="px-2 py-2 text-center text-sm font-semibold text-amber-700" x-text="foodIntakes.{{ $intake }}.totalFats"></td>
                                        <td class="px-2 py-2 text-center text-sm font-semibold text-emerald-700" x-text="foodIntakes.{{ $intake }}.totalCarbohydrates"></td>
                                        <td class="px-2 py-2 text-center text-sm font-extrabold text-amber-700" x-text="foodIntakes.{{ $intake }}.totalCalories"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </template>

                        {{-- Empty --}}
                        <template x-if="!foodIntakes.{{ $intake }}.products.length">
                            <div class="mt-3 rounded-2xl border border-dashed border-stone-200 bg-stone-50 px-4 py-6 text-center">
                                <div class="text-sm font-semibold text-stone-700">{{ __('No products added yet') }}</div>
                                <div class="mt-1 text-xs text-stone-500">{{ __('Use search below or tell the AI assistant.') }}</div>
                            </div>
                        </template>

                        {{-- Search/Create --}}
                        <div class="mt-4">
                            <div class="flex items-center gap-2">
                                <button
                                    type="button"
                                    @click="createProductForm = false"
                                    class="h-10 px-4 rounded-2xl text-sm font-semibold border transition"
                                    :class="!createProductForm ? 'bg-stone-900 text-white border-stone-900' : 'bg-white text-stone-700 border-stone-200 hover:bg-stone-50'"
                                >
                                    {{ __('Search') }}
                                </button>
                                <button
                                    type="button"
                                    @click="createProductForm = true"
                                    class="h-10 px-4 rounded-2xl text-sm font-semibold border transition"
                                    :class="createProductForm ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-stone-700 border-stone-200 hover:bg-stone-50'"
                                >
                                    {{ __('Create') }}
                                </button>
                            </div>

                            <div x-show="createProductForm" class="mt-3">
                                <livewire:product-create wire:key="productCreate-{{ Str::random() }}"/>
                            </div>
                            <div x-show="!createProductForm" class="mt-3">
                                <livewire:product-search wire:key="productSearch-{{ Str::random() }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Measurements --}}
            <div class="rounded-[1.25rem] border border-stone-200 bg-white overflow-hidden">
                <button
                    type="button"
                    @click="active === 'measurements' ? active = null : active = 'measurements'"
                    class="w-full px-4 py-3 flex items-center justify-between gap-3 hover:bg-stone-50/50 transition"
                    :class="active === 'measurements' ? 'bg-amber-50/40' : ''"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="h-10 w-10 rounded-2xl grid place-items-center border"
                            :class="active === 'measurements' ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-stone-700 border-stone-200'"
                        >
                            <i class="fas fa-ruler text-sm"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-sm font-extrabold text-stone-900">{{ __('Measurements') }}</div>
                            <div class="text-xs text-stone-500">{{ __('Track progress, not vibes') }}</div>
                        </div>
                    </div>
                    <i class="fas text-stone-400 text-xs" :class="active === 'measurements' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>

                <div
                    x-show="active === 'measurements'"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="px-4 pb-4"
                >
                    <div class="mt-3 grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <template x-for="(measurement, index) in measurements" :key="index">
                            <div>
                                <label x-text="measurement.translatable" class="block text-[11px] font-semibold text-stone-500 mb-1"></label>
                                <input
                                    type="number"
                                    x-model="measurement.value"
                                    min="0"
                                    step="0.1"
                                    class="block w-full h-11 rounded-2xl border-stone-200 text-sm px-3 focus:border-amber-500 focus:ring-amber-500"
                                    @focus="if (measurement.value == 0) measurement.value = ''"
                                >
                            </div>
                        </template>
                    </div>

                    <button
                        type="button"
                        @click="save"
                        class="mt-4 w-full h-11 rounded-2xl bg-stone-900 text-white text-sm font-semibold hover:bg-stone-800 active:scale-[0.98] transition"
                    >
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Floating calories --}}
    <button
        type="button"
        @click="showRemainingCalories = !showRemainingCalories"
        class="fixed bottom-6 right-6 z-40 group"
        aria-label="{{ __('Calories') }}"
    >
        <div class="relative">
            {{-- Glow halo (improves contrast on light backgrounds) --}}
            <div class="absolute -inset-1 rounded-3xl bg-emerald-400/25 blur-md opacity-60 group-hover:opacity-80 transition-opacity"></div>

            <div
                class="relative w-16 h-16 rounded-3xl bg-white border-2 ring-1 ring-black/5 shadow-2xl shadow-stone-900/20 flex flex-col items-center justify-center overflow-hidden hover:scale-[1.02] active:scale-[0.98] transition-transform duration-200"
                :class="showRemainingCalories
                    ? (remainingCalories < 0 ? 'border-red-500/60' : 'border-emerald-500/60')
                    : 'border-amber-500/60'"
            >
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(245,158,11,0.12),transparent_55%)]"></div>

                {{-- Mode chip --}}
        

                {{-- Value --}}
                <div
                    class="relative mt-2 text-xl font-extrabold leading-none"
                    :class="showRemainingCalories
                        ? (remainingCalories < 0 ? 'text-red-700' : 'text-emerald-700')
                        : 'text-stone-900'"
                    x-text="showRemainingCalories ? remainingCalories : totalCalories"
                ></div>
                <div class="relative text-[10px] font-semibold text-stone-500">{{ __('Kcal') }}</div>
            </div>
        </div>
    </button>

    <x-loading-screen/>

    {{-- AI Chat Assistant --}}
    <livewire:diary-chat :date="$date" />
</div>

@php
    $diaryInitial = [
        'goal' => (int) (Auth::user()->kcal_per_day ?: 2000),
        'locale' => (string) app()->getLocale(),
        'labels' => [
            'breakfast' => __('Breakfast'),
            'lunch' => __('Lunch'),
            'dinner' => __('Dinner'),
            'snack' => __('Snack'),
            'weight' => __('Weight'),
            'chest' => __('Chest'),
            'waist' => __('Waist'),
            'thighs' => __('Thighs'),
            'wrist' => __('Wrist'),
            'neck' => __('Neck'),
            'biceps' => __('Biceps'),
        ],
        'foodIntakes' => [
            'breakfast' => ['products' => $breakfast ?? []],
            'lunch' => ['products' => $lunch ?? []],
            'dinner' => ['products' => $dinner ?? []],
            'snack' => ['products' => $snack ?? []],
        ],
        'measurements' => [
            'weight' => ['value' => $measurement->kg ?? ''],
            'chest' => ['value' => $measurement->chest_cm ?? ''],
            'waist' => ['value' => $measurement->waist_cm ?? ''],
            'thighs' => ['value' => $measurement->thighs_cm ?? ''],
            'wrist' => ['value' => $measurement->wrist_cm ?? ''],
            'neck' => ['value' => $measurement->neck_cm ?? ''],
            'biceps' => ['value' => $measurement->biceps_cm ?? ''],
        ],
    ];
@endphp

<script type="application/json" id="diary-initial-data">{!! json_encode($diaryInitial, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

<script>
    function diaryApp() {
        const el = document.getElementById('diary-initial-data');
        const initial = el ? JSON.parse(el.textContent || '{}') : {};
        const goal = Number(initial.goal || 2000);
        const locale = String(initial.locale || 'en');
        const labels = initial.labels || {};

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
                    translatable: String(labels.breakfast || 'Breakfast'),
                    products: (initial.foodIntakes?.breakfast?.products ?? []),
                },
                lunch: {
                    translatable: String(labels.lunch || 'Lunch'),
                    products: (initial.foodIntakes?.lunch?.products ?? []),
                },
                dinner: {
                    translatable: String(labels.dinner || 'Dinner'),
                    products: (initial.foodIntakes?.dinner?.products ?? []),
                },
                snack: {
                    translatable: String(labels.snack || 'Snack'),
                    products: (initial.foodIntakes?.snack?.products ?? []),
                }
            },
            measurements: {
                weight: {
                    translatable: String(labels.weight || 'Weight'),
                    value: (initial.measurements?.weight?.value ?? ''),
                },
                chest: {
                    translatable: String(labels.chest || 'Chest'),
                    value: (initial.measurements?.chest?.value ?? ''),
                },
                waist: {
                    translatable: String(labels.waist || 'Waist'),
                    value: (initial.measurements?.waist?.value ?? ''),
                },
                thighs: {
                    translatable: String(labels.thighs || 'Thighs'),
                    value: (initial.measurements?.thighs?.value ?? ''),
                },
                wrist: {
                    translatable: String(labels.wrist || 'Wrist'),
                    value: (initial.measurements?.wrist?.value ?? ''),
                },
                neck: {
                    translatable: String(labels.neck || 'Neck'),
                    value: (initial.measurements?.neck?.value ?? ''),
                },
                biceps: {
                    translatable: String(labels.biceps || 'Biceps'),
                    value: (initial.measurements?.biceps?.value ?? ''),
                }
            },

            get formattedDate() {
                const date = new Date(this.$wire.date + 'T00:00:00');
                const options = { weekday: 'short', day: 'numeric', month: 'short' };
                return date.toLocaleDateString(locale, options);
            },

            get isToday() {
                const today = new Date();
                const selected = new Date(this.$wire.date + 'T00:00:00');
                return today.toDateString() === selected.toDateString();
            },

            get calorieProgress() {
                return Math.round((this.totalCalories / goal) * 100);
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
                    }, 2500);
                });

                this.$wire.on('productAdded', product => {
                    const productId = product[0].id;
                    if (!this.active) {
                        this.active = 'breakfast';
                        Livewire.dispatch('meal-selected', { meal: this.active });
                    }
                    // Check for duplicate before adding
                    if (this.foodIntakes[this.active].products.find(p => p.product_id === productId)) {
                        this.createProductForm = false;
                        return;
                    }
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
                this.remainingCalories = Math.round(goal - this.totalCalories);
                this.totalFats = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalFats, 0);
                this.totalProteins = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalProteins, 0);
                this.totalCarbohydrates = Object.values(this.foodIntakes).reduce((acc, intake) => acc + intake.totalCarbohydrates, 0);
            },
            addProduct(product) {
                product = JSON.parse(product);
                if (!this.active) {
                    this.active = 'breakfast';
                    Livewire.dispatch('meal-selected', { meal: this.active });
                }
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
                if (!this.active) return;
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

