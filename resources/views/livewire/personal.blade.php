<div x-data="personalApp()" class="mb-10" x-cloak>

    @section('title', __('Personal'))

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

    <div class="mt-6 space-y-6">

        {{-- Header Card with Avatar --}}
        <div class="bg-gradient-to-r from-amber-50 via-orange-50/50 to-amber-50 rounded-2xl p-6 border border-amber-100/50">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-xl font-bold text-stone-800">{{ Auth::user()->name }}</h1>
                    <p class="text-sm text-stone-500">{{ __('Personal Settings') }}</p>
                </div>
            </div>
        </div>

        {{-- Basic Info Card --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-stone-100 bg-stone-50/50">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-user text-amber-600 text-sm"></i>
                    </div>
                    <h2 class="font-semibold text-stone-800">{{ __('Basic Information') }}</h2>
                </div>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide">
                            {{ __('Height') }} (см)
                        </label>
                        <input type="number" x-model="user.growth_cm" min="1"
                               class="w-full rounded-lg border-stone-200 text-sm py-2.5 px-3 focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide">
                            {{ __('Target weight') }} (кг)
                        </label>
                        <input type="number" x-model="user.target_kg" min="1"
                               class="w-full rounded-lg border-stone-200 text-sm py-2.5 px-3 focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide">
                            {{ __('Sex') }}
                        </label>
                        <select x-model="user.sex"
                                class="w-full rounded-lg border-stone-200 text-sm py-2.5 px-3 focus:border-amber-500 focus:ring-amber-500">
                            <option value="male">{{ __('Male') }}</option>
                            <option value="female">{{ __('Female') }}</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide">
                            {{ __('Birthday date') }}
                        </label>
                        <input type="date" x-model="user.birthday_date"
                               class="w-full rounded-lg border-stone-200 text-sm py-2.5 px-3 focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div class="col-span-2 space-y-1.5">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide">
                            {{ __('Activity coefficient') }}
                        </label>
                        <select x-model="user.activity_coefficient"
                                class="w-full rounded-lg border-stone-200 text-sm py-2.5 px-3 focus:border-amber-500 focus:ring-amber-500">
                            <option value="1.2">{{ __('Sedentary - little or no exercise') }}</option>
                            <option value="1.38">{{ __('Lightly Active - exercise/sports 1-3 times/week') }}</option>
                            <option value="1.55">{{ __('Moderately Active - exercise/sports 3-5 times/week') }}</option>
                            <option value="1.73">{{ __('Very Active - hard exercise/sports 6-7 times/week') }}</option>
                            <option value="1.9">{{ __('Extra Active - very hard exercise/sports or physical job') }}</option>
                        </select>
                    </div>
                    <div class="col-span-2 space-y-1.5">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide">
                            {{ __('Deficit kcal') }}
                        </label>
                        <input type="number" x-model="user.deficit_kcal" min="1"
                               class="w-full rounded-lg border-stone-200 text-sm py-2.5 px-3 focus:border-amber-500 focus:ring-amber-500">
                        <p class="text-xs text-stone-400 mt-1">
                            {{ __('Calories deficit per day. Recommended: ') }}
                            <span x-show="calculated.kcal_per_day_normal"
                                  x-text="calculated.recommended_deficit_kcal_from + ' - ' + calculated.recommended_deficit_kcal_to"
                                  class="font-medium text-amber-600"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Measurements Card --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div @click="active === 'measurements' ? active = null : active = 'measurements'"
                 class="px-5 py-4 border-b border-stone-100 bg-stone-50/50 cursor-pointer hover:bg-stone-100/50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-all"
                             :class="active === 'measurements' ? 'bg-amber-500 text-white' : 'bg-stone-100 text-stone-400'">
                            <i class="fas fa-ruler text-sm"></i>
                        </div>
                        <h2 class="font-semibold text-stone-800">{{ __('Last Measurements') }}</h2>
                    </div>
                    <i :class="active === 'measurements' ? 'fas fa-chevron-up text-amber-500' : 'fas fa-chevron-down text-stone-300'"
                       class="text-xs transition-transform"></i>
                </div>
            </div>
            <div x-show="active === 'measurements'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="p-5">
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-4">
                    <template x-for="(measurement, index) in measurements" :key="index">
                        <div class="space-y-1.5">
                            <label x-text="measurement.translatable"
                                   class="block text-xs font-medium text-stone-500 uppercase tracking-wide"></label>
                            <input type="number" x-model="measurement.value" min="1" step="0.1"
                                   class="w-full rounded-lg border-stone-200 text-sm py-2.5 px-3 focus:border-amber-500 focus:ring-amber-500"
                                   @focus="if (measurement.value == 0) measurement.value = ''">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Calculated Results --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-stone-100 bg-stone-50/50">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                        <i class="fas fa-calculator text-emerald-600 text-sm"></i>
                    </div>
                    <h2 class="font-semibold text-stone-800">{{ __('Calculated info') }}</h2>
                </div>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- BMI Card --}}
                    <div class="rounded-xl p-4 transition-all"
                         :class="error.BMI ? 'bg-stone-50 border border-dashed border-stone-200' : 'bg-gradient-to-br from-sky-50 to-blue-50 border border-sky-100'">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-weight text-sky-500 text-sm"></i>
                            <span class="text-xs font-medium text-stone-500">{{ __('Body Mass Index (BMI)') }}</span>
                        </div>
                        <div x-show="!error.BMI">
                            <p class="text-2xl font-bold text-sky-600" x-text="calculated.BMI"></p>
                            <p x-show="calculated.BMI < 18.5" class="text-xs text-sky-500 mt-1">{{ __('Underweight') }}</p>
                            <p x-show="calculated.BMI >= 18.5 && calculated.BMI < 24.9" class="text-xs text-emerald-500 mt-1">{{ __('Normal weight') }}</p>
                            <p x-show="calculated.BMI >= 25 && calculated.BMI < 29.9" class="text-xs text-amber-500 mt-1">{{ __('Overweight') }}</p>
                            <p x-show="calculated.BMI >= 30 && calculated.BMI < 34.9" class="text-xs text-orange-500 mt-1">{{ __('Obesity I') }}</p>
                            <p x-show="calculated.BMI >= 35 && calculated.BMI < 39.9" class="text-xs text-red-500 mt-1">{{ __('Obesity II') }}</p>
                            <p x-show="calculated.BMI >= 40" class="text-xs text-red-600 mt-1">{{ __('Obesity III') }}</p>
                        </div>
                        <p x-show="error.BMI" class="text-xs text-stone-400 mt-1">
                            {{ __('Insufficient data. Please fill weight and growth.') }}
                        </p>
                    </div>

                    {{-- Fat Percent Card --}}
                    <div class="rounded-xl p-4 transition-all"
                         :class="error.fat_percent ? 'bg-stone-50 border border-dashed border-stone-200' : 'bg-gradient-to-br from-violet-50 to-purple-50 border border-violet-100'">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-percentage text-violet-500 text-sm"></i>
                            <span class="text-xs font-medium text-stone-500">{{ __('Fat percent') }}</span>
                        </div>
                        <div x-show="!error.fat_percent">
                            <p class="text-2xl font-bold text-violet-600" x-text="calculated.fat_percent + '%'"></p>
                            <template x-if="user.sex === 'male'">
                                <div>
                                    <p x-show="calculated.fat_percent < 6" class="text-xs text-violet-500 mt-1">{{ __('Essential fat') }}</p>
                                    <p x-show="calculated.fat_percent >= 6 && calculated.fat_percent < 14" class="text-xs text-sky-500 mt-1">{{ __('Athletes') }}</p>
                                    <p x-show="calculated.fat_percent >= 14 && calculated.fat_percent < 18" class="text-xs text-emerald-500 mt-1">{{ __('Fitness') }}</p>
                                    <p x-show="calculated.fat_percent >= 18 && calculated.fat_percent < 25" class="text-xs text-amber-500 mt-1">{{ __('Average') }}</p>
                                    <p x-show="calculated.fat_percent >= 25" class="text-xs text-red-500 mt-1">{{ __('Obese') }}</p>
                                </div>
                            </template>
                            <template x-if="user.sex === 'female'">
                                <div>
                                    <p x-show="calculated.fat_percent < 14" class="text-xs text-violet-500 mt-1">{{ __('Essential fat') }}</p>
                                    <p x-show="calculated.fat_percent >= 14 && calculated.fat_percent < 21" class="text-xs text-sky-500 mt-1">{{ __('Athletes') }}</p>
                                    <p x-show="calculated.fat_percent >= 21 && calculated.fat_percent < 25" class="text-xs text-emerald-500 mt-1">{{ __('Fitness') }}</p>
                                    <p x-show="calculated.fat_percent >= 25 && calculated.fat_percent < 32" class="text-xs text-amber-500 mt-1">{{ __('Average') }}</p>
                                    <p x-show="calculated.fat_percent >= 32" class="text-xs text-red-500 mt-1">{{ __('Obese') }}</p>
                                </div>
                            </template>
                        </div>
                        <p x-show="error.fat_percent" class="text-xs text-stone-400 mt-1">
                            {{ __('Insufficient data. Please fill waist, neck, hips (for women), height and birth date.') }}
                        </p>
                    </div>

                    {{-- BMR Card --}}
                    <div class="rounded-xl p-4 transition-all"
                         :class="error.BMR ? 'bg-stone-50 border border-dashed border-stone-200' : 'bg-gradient-to-br from-rose-50 to-pink-50 border border-rose-100'">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-fire text-rose-500 text-sm"></i>
                            <span class="text-xs font-medium text-stone-500">{{ __('Basal metabolic rate (BMR)') }}</span>
                        </div>
                        <div x-show="!error.BMR">
                            <p class="text-2xl font-bold text-rose-600" x-text="calculated.BMR"></p>
                            <p class="text-xs text-stone-400 mt-1">{{ __('kcal/day at rest') }}</p>
                        </div>
                        <p x-show="error.BMR" class="text-xs text-stone-400 mt-1">
                            {{ __('Insufficient data. Please fill weight, height and birth date.') }}
                        </p>
                    </div>

                    {{-- Normal Weight Card --}}
                    <div class="rounded-xl p-4 transition-all"
                         :class="error.normal_weight ? 'bg-stone-50 border border-dashed border-stone-200' : 'bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-100'">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-balance-scale text-emerald-500 text-sm"></i>
                            <span class="text-xs font-medium text-stone-500">{{ __('Normal weight') }}</span>
                        </div>
                        <div x-show="!error.normal_weight">
                            <p class="text-2xl font-bold text-emerald-600" x-text="calculated.normal_weight_from + '-' + calculated.normal_weight_to"></p>
                            <p class="text-xs text-stone-400 mt-1">кг</p>
                        </div>
                        <p x-show="error.normal_weight" class="text-xs text-stone-400 mt-1">
                            {{ __('Insufficient data. Please fill height.') }}
                        </p>
                    </div>

                    {{-- TDEE Card --}}
                    <div class="rounded-xl p-4 transition-all"
                         :class="error.kcal_per_day_normal ? 'bg-stone-50 border border-dashed border-stone-200' : 'bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-100'">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-bolt text-amber-500 text-sm"></i>
                            <span class="text-xs font-medium text-stone-500">{{ __('Calorie consumption per day with activity') }}</span>
                        </div>
                        <div x-show="!error.kcal_per_day_normal">
                            <p class="text-2xl font-bold text-amber-600" x-text="calculated.kcal_per_day_normal"></p>
                            <p class="text-xs text-stone-400 mt-1">{{ __('kcal/day') }}</p>
                        </div>
                        <p x-show="error.kcal_per_day_normal" class="text-xs text-stone-400 mt-1">
                            {{ __('Insufficient data. Please fill weight, height and DOB') }}
                        </p>
                    </div>

                    {{-- Daily Limit Card --}}
                    <div class="rounded-xl p-4 transition-all"
                         :class="error.kcal_per_day ? 'bg-stone-50 border border-dashed border-stone-200' : 'bg-gradient-to-br from-cyan-50 to-sky-50 border border-cyan-100'">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-bullseye text-cyan-500 text-sm"></i>
                            <span class="text-xs font-medium text-stone-500">{{ __('Your daily calorie limit based on desirable deficit') }}</span>
                        </div>
                        <div x-show="!error.kcal_per_day">
                            <p class="text-2xl font-bold text-cyan-600" x-text="calculated.kcal_per_day"></p>
                            <p class="text-xs text-stone-400 mt-1">{{ __('kcal/day') }}</p>
                        </div>
                        <p x-show="error.kcal_per_day" class="text-xs text-stone-400 mt-1">
                            {{ __('Insufficient data. Please fill weight, height, DOB and deficit kcal.') }}
                        </p>
                    </div>

                    {{-- Weeks to Target Card --}}
                    <div class="rounded-xl p-4 transition-all col-span-2"
                         :class="error.weeks_to_target ? 'bg-stone-50 border border-dashed border-stone-200' : 'bg-gradient-to-br from-indigo-50 to-violet-50 border border-indigo-100'">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-flag-checkered text-indigo-500 text-sm"></i>
                            <span class="text-xs font-medium text-stone-500">{{ __('Weeks to target weight') }}</span>
                        </div>
                        <div x-show="!error.weeks_to_target" class="flex items-baseline gap-2">
                            <p class="text-3xl font-bold text-indigo-600" x-text="calculated.weeks_to_target"></p>
                            <span class="text-sm text-indigo-400">{{ __('weeks') }}</span>
                        </div>
                        <p x-show="error.weeks_to_target" class="text-xs text-stone-400 mt-1">
                            {{ __('Insufficient data. Please fill weight, target weight and deficit kcal.') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex justify-end">
            <button @click="save"
                    class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 rounded-xl shadow-lg hover:shadow-xl transition-all">
                <i class="fas fa-check mr-2"></i>
                {{ __('Save') }}
            </button>
        </div>

    </div>

    <x-loading-screen/>
</div>
<script>
    function personalApp() {
        return {
            active: null, // measurements

            user: {
                growth_cm: @json(Auth::user()->growth_cm ?? ''),
                sex:@json(Auth::user()->sex ?? 'male'),
                activity_coefficient: @json(Auth::user()->activity_coefficient ?? '1.2'),
                birthday_date: @json(Auth::user()->birthday_date ?? ''),
                target_kg: @json(Auth::user()->target_kg ?? ''),
                deficit_kcal: @json(Auth::user()->deficit_kcal ?? ''),
            },

            calculated: {
                BMR: 0,
                BMI: 0,
                fat_percent: 0,
                normal_weight_from: 0,
                normal_weight_to: 0,
                kcal_per_day_normal: 0,
                kcal_per_day: 0,
                weeks_to_target: 0,
                recommended_deficit_kcal_from: 0,
                recommended_deficit_kcal_to: 0,
            },

            error: {
                BMR: false,
                BMI: false,
                fat_percent: false,
                normal_weight: false,
                kcal_per_day_normal: false,
                kcal_per_day: false,
                weeks_to_target: false,
            },

            successMessage: '',

            measurements: @json($lastMeasurements),

            init() {
                this.$wire.on('success', message => {
                    this.successMessage = message;
                    setTimeout(() => {
                        this.successMessage = '';
                    }, 3000); // Hide after 3 seconds
                });

                // after initialization
                this.$nextTick(() => {
                    this.calculate();
                });

                this.$watch('user', value => {
                    this.calculate();
                }, {deep: true});

                this.$watch('measurements', value => {
                    this.calculate();
                }, {deep: true});
            },

            calculateAge(birthday) {
                let ageDifMs = Date.now() - birthday.getTime();
                let ageDate = new Date(ageDifMs);
                return Math.abs(ageDate.getUTCFullYear() - 1970);
            },

            calculate() {

                // BMI
                if (!(this.user.growth_cm && this.measurements.weight.value)) {
                    this.error.BMI = true;
                } else {
                    this.error.BMI = false;
                    this.calculated.BMI = (
                        this.measurements.weight.value / ((this.user.growth_cm / 100) * (this.user.growth_cm / 100))
                    ).toFixed(2);
                }

                // Fat percent calculation
                if (this.user.sex === 'female') {
                    if (!(
                        Number(this.measurements.waist.value) > 0 &&
                        Number(this.measurements.neck.value) > 0 &&
                        Number(this.measurements.thighs.value) > 0 &&
                        (Number(this.measurements.waist.value) > Number(this.measurements.neck.value)) // Validate waist > neck
                    )) {
                        this.error.fat_percent = true;
                    } else {
                        this.error.fat_percent = false;
                        const waist = Number(this.measurements.waist.value);
                        const neck = Number(this.measurements.neck.value);
                        const thighs = Number(this.measurements.thighs.value);
                        const height = Number(this.user.growth_cm); // Keep height in cm

                        this.calculated.fat_percent = (
                            (495 / (
                                    1.29579 - 0.35004 * Math.log10(waist + thighs - neck) +
                                    0.22100 * Math.log10(height)
                                )
                            ) - 450
                        ).toFixed(2);
                    }
                } else {
                    if (!(
                        Number(this.measurements.waist.value) > 0 &&
                        Number(this.measurements.neck.value) > 0 &&
                        Number(this.user.growth_cm) > 0 &&
                        (Number(this.measurements.waist.value) > Number(this.measurements.neck.value)) // Validate waist > neck
                    )) {
                        this.error.fat_percent = true;
                    } else {
                        this.error.fat_percent = false;
                        const waist = Number(this.measurements.waist.value);
                        const neck = Number(this.measurements.neck.value);
                        const height = Number(this.user.growth_cm); // Keep height in cm

                        this.calculated.fat_percent = (
                            (495 / (
                                    1.0324 - 0.19077 * Math.log10(waist - neck) +
                                    0.15456 * Math.log10(height)
                                )
                            ) - 450
                        ).toFixed(2);
                    }
                }

                // BMR
                if (!(this.user.sex && this.measurements.weight.value && this.user.growth_cm && this.user.birthday_date)) {
                    this.error.BMR = true;
                } else {
                    this.error.BMR = false;
                    this.calculated.BMR = (
                        10 * this.measurements.weight.value + 6.25 *
                        this.user.growth_cm - 5 *
                        this.calculateAge(new Date(this.user.birthday_date)) +
                        (this.user.sex === 'male' ? 5 : -161)
                    ).toFixed(0);
                }

                // Normal Weight From To
                if (!this.user.growth_cm) {
                    this.error.normal_weight = true;
                } else {
                    this.error.normal_weight = false;
                    this.calculated.normal_weight_from = (
                        18.5 * (this.user.growth_cm / 100 * this.user.growth_cm / 100)
                    ).toFixed();
                    this.calculated.normal_weight_to = (
                        25 * (this.user.growth_cm / 100 * this.user.growth_cm / 100)
                    ).toFixed();
                }

                // KPDN
                if (!(this.user.sex && this.measurements.weight.value && this.user.growth_cm && this.user.birthday_date && this.user.activity_coefficient)) {
                    this.error.kcal_per_day_normal = true;
                } else {
                    this.error.kcal_per_day_normal = false;
                    this.calculated.kcal_per_day_normal = (
                        this.calculated.BMR * this.user.activity_coefficient
                    ).toFixed();
                }

                // Weeks
                if (!(this.user.target_kg && this.measurements.weight.value && this.user.deficit_kcal)) {
                    this.error.weeks_to_target = true;
                } else {
                    this.error.weeks_to_target = false;
                    this.calculated.weeks_to_target = (
                        ((this.measurements.weight.value - this.user.target_kg) * 9000 / this.user.deficit_kcal) / 7
                    ).toFixed();
                }

                // KPD
                if (!(this.user.sex && this.measurements.weight.value && this.user.growth_cm && this.user.birthday_date && this.user.activity_coefficient && this.user.deficit_kcal)) {
                    this.error.kcal_per_day = true;
                } else {
                    this.error.kcal_per_day = false;
                    this.calculated.kcal_per_day = (
                        this.calculated.kcal_per_day_normal - this.user.deficit_kcal
                    ).toFixed(0);
                }

                // Recommended deficit kcal (10-20% from kcal_per_day_normal)
                this.calculated.recommended_deficit_kcal_from = (this.calculated.kcal_per_day_normal * 0.1).toFixed(0);
                this.calculated.recommended_deficit_kcal_to = (this.calculated.kcal_per_day_normal * 0.2).toFixed(0);
            },

            save() {
                this.$wire.call('save', this.user, this.calculated, this.measurements);
            }
        }
    }
</script>
