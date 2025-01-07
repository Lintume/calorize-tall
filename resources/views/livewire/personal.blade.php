<div x-data="personalApp()" class="mb-10" x-cloak>

    @section('title', __('Personal'))

    {{--    success message--}}
    <div x-show="successMessage" x-text="successMessage" class="mt-4 bg-green-600 text-white p-2 rounded mb-4" x-cloak></div>

    {{--    errors--}}
    <div class="text-red-600">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    <div class="flex flex-col justify-center">
        <div class="flex flex-col shadow justify-between rounded-lg pb-4 xl:p-8 mt-3 bg-white">
            <div class="p-4 md:p-8 xl:p-10">

                <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-4 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Height') }}
                        </label>
                        <input type="number" x-model="user.growth_cm" min="1"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Target weight') }}
                        </label>
                        <input type="number" x-model="user.target_kg" min="1"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Sex') }}
                        </label>
                        <select x-model="user.sex"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="male">{{ __('Male') }}</option>
                            <option value="female">{{ __('Female') }}</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Activity coefficient') }}
                        </label>
                        <select x-model="user.activity_coefficient"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="1.2">{{ __('Sedentary - little or no exercise') }}</option>
                            <option value="1.38">{{ __('Lightly Active - exercise/sports 1-3 times/week') }}</option>
                            <option value="1.55">{{ __('Moderately Active - exercise/sports 3-5 times/week') }}</option>
                            <option value="1.73">{{ __('Very Active - hard exercise/sports 6-7 times/week') }}</option>
                            <option value="1.9">{{ __('Extra Active - very hard exercise/sports or physical job') }}</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Birthday date') }}
                        </label>
                        <input type="date" x-model="user.birthday_date"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                {{--last measurements--}}
                <div @click="active === 'measurements' ? active = null : active = 'measurements'"
                     class="rounded-lg border border-gray-300 p-4 flex justify-between items-center cursor-pointer">
                    <div> {{ __('Last Measurements') }}</div>
                    <i x-show="active !== 'measurements'" class="fas fa-plus"></i>
                    <i x-show="active === 'measurements'" class="fas fa-minus"></i>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-7 gap-4 mt-4"
                     x-show="active === 'measurements'">
                    <template x-for="(measurement, index) in measurements" :key="index">
                        <div>
                            <label x-text="measurement.translatable"
                                   class="block text-sm font-medium text-gray-700"></label>
                            <input type="number" x-model="measurement.value" min="1" step="0.1"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                   @focus="if (measurement.value == 0) measurement.value = ''">
                        </div>
                    </template>
                </div>

                {{--calculated info--}}
                <div class="bold mt-7 text-xl mb-2">{{ __('Calculated info') }}</div>
                <div class="grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-4 gap-4 border-t pt-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('Body Mass Index (BMI)') }}</p>
                        <p x-text="calculated.BMI" class="text-lg font-bold"></p>
                        <p x-show="error.BMI"
                           class="text-red-600 text-xs">{{ __('Insufficient data. Please fill weight and growth.') }}</p>
                        <p x-show="!error.BMI && calculated.BMI < 18.5" class="text-xs text-gray-500">{{ __('Underweight') }}</p>
                        <p x-show="!error.BMI && calculated.BMI >= 18.5 && calculated.BMI < 24.9" class="text-xs text-gray-500">{{ __('Normal weight') }}</p>
                        <p x-show="!error.BMI && calculated.BMI >= 25 && calculated.BMI < 29.9" class="text-xs text-gray-500">{{ __('Overweight') }}</p>
                        <p x-show="!error.BMI && calculated.BMI >= 30 && calculated.BMI < 34.9" class="text-xs text-gray-500">{{ __('Obesity I') }}</p>
                        <p x-show="!error.BMI && calculated.BMI >= 35 && calculated.BMI < 39.9" class="text-xs text-gray-500">{{ __('Obesity II') }}</p>
                        <p x-show="!error.BMI && calculated.BMI >= 40" class="text-xs text-gray-500">{{ __('Obesity III') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('Fat percent') }}</p>
                        <p x-text="calculated.fat_percent + '%'" class="text-lg font-bold"></p>
                        <p x-show="error.fat_percent"
                           class="text-red-600 text-xs">{{ __('Insufficient data. Please fill waist, neck, hips (for women), height and birth date.') }}</p>
                        <template x-if="!error.fat_percent && user.sex === 'male'">
                            <div>
                                <p x-show="calculated.fat_percent < 6" class="text-xs text-gray-500">{{ __('Essential fat') }}</p>
                                <p x-show="calculated.fat_percent >= 6 && calculated.fat_percent < 14" class="text-xs text-gray-500">{{ __('Athletes') }}</p>
                                <p x-show="calculated.fat_percent >= 14 && calculated.fat_percent < 18" class="text-xs text-gray-500">{{ __('Fitness') }}</p>
                                <p x-show="calculated.fat_percent >= 18 && calculated.fat_percent < 25" class="text-xs text-gray-500">{{ __('Average') }}</p>
                                <p x-show="calculated.fat_percent >= 25" class="text-xs text-gray-500">{{ __('Obese') }}</p>
                            </div>
                        </template>
                        <template x-if="!error.fat_percent && user.sex === 'female'">
                            <div>
                                <p x-show="calculated.fat_percent < 14" class="text-xs text-gray-500">{{ __('Essential fat') }}</p>
                                <p x-show="calculated.fat_percent >= 14 && calculated.fat_percent < 21" class="text-xs text-gray-500">{{ __('Athletes') }}</p>
                                <p x-show="calculated.fat_percent >= 21 && calculated.fat_percent < 25" class="text-xs text-gray-500">{{ __('Fitness') }}</p>
                                <p x-show="calculated.fat_percent >= 25 && calculated.fat_percent < 32" class="text-xs text-gray-500">{{ __('Average') }}</p>
                                <p x-show="calculated.fat_percent >= 32" class="text-xs text-gray-500">{{ __('Obese') }}</p>
                            </div>
                        </template>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('Basal metabolic rate (BMR)') }}</p>
                        <p x-text="calculated.BMR" class="text-lg font-bold"></p>
                        <p x-show="error.BMR"
                           class="text-red-600 text-xs">{{ __('Insufficient data. Please fill weight, height and birth date.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('Normal weight') }}</p>
                        <p x-text="calculated.normal_weight_from + ' - ' + calculated.normal_weight_to + ' kg'"
                           class="text-lg font-bold"></p>
                        <p x-show="error.normal_weight"
                           class="text-red-600 text-xs">{{ __('Insufficient data. Please fill height.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('Calorie consumption per day with activity') }}</p>
                        <p x-text="calculated.kcal_per_day_normal" class="text-lg font-bold"></p>
                        <p x-show="error.kcal_per_day_normal"
                           class="text-red-600 text-xs">{{ __('Insufficient data. Please fill weight, height and DOB') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('Calorie consumption per day minus desirable deficit') }}</p>
                        <p x-text="calculated.kcal_per_day" class="text-lg font-bold"></p>
                        <p x-show="error.kcal_per_day"
                           class="text-red-600 text-xs">{{ __('Insufficient data. Please fill weight, height, DOB and deficit kcal.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('Weeks to target weight') }}</p>
                        <p x-text="calculated.weeks_to_target" class="text-lg font-bold"></p>
                        <p x-show="error.weeks_to_target"DOB
                           class="text-red-600 text-xs">{{ __('Insufficient data. Please fill weight, target weight and deficit kcal.') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Deficit kcal') }}
                        </label>
                        <input type="number" x-model="user.deficit_kcal" min="1"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <p class="text-xs text-gray-500">{{ __('Calories deficit per day. Recommended: ') }} <span x-show="calculated.kcal_per_day_normal"
                                x-text="calculated.recommended_deficit_kcal_from + ' - ' + calculated.recommended_deficit_kcal_to"></span>
                    </div>
                </div>

                <div class="flex flex-col justify-end h-full">
                    <x-primary-button @click="save" class="self-end mt-3">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </div>
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