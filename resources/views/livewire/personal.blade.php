<div x-data="personalApp()" class="py-8 sm:py-10 lg:py-12 pb-24 bg-stone-50" x-cloak>

    @section('title', __('Personal'))

    {{-- Toast: success --}}
    <div
        x-show="successMessage"
        x-text="successMessage"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="fixed top-20 sm:top-24 left-1/2 -translate-x-1/2 z-50 max-w-[92vw] sm:max-w-md rounded-2xl bg-emerald-600 text-white px-4 py-3 shadow-2xl shadow-emerald-600/20"
    ></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Errors --}}
        @if($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700">
                <div class="font-semibold text-sm mb-2">{{ __('Please fix the errors below') }}</div>
                <div class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <div class="text-sm">{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Hero --}}
        <div class="relative overflow-hidden rounded-[1.75rem] border border-stone-200 bg-white/90 backdrop-blur shadow-xl shadow-stone-900/5">
            <div class="absolute inset-0 bg-[radial-gradient(900px_circle_at_10%_-20%,rgba(245,158,11,0.14),transparent_55%),radial-gradient(700px_circle_at_90%_-10%,rgba(14,165,233,0.12),transparent_55%)]"></div>
            <div class="relative p-6 sm:p-8 space-y-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-start gap-4 min-w-0">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-white text-xl font-extrabold shadow-lg shadow-amber-600/25">
                            {{ mb_strtoupper(mb_substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="space-y-1 min-w-0">
                            <h1 class="text-xl sm:text-2xl font-extrabold text-stone-900">{{ Auth::user()->name }}</h1>
                            <p class="text-sm text-stone-600">{{ __('Personal Settings') }}</p>
                            <p class="text-xs text-stone-500">{{ __('These settings power your daily calorie goal and the diary calculations.') }}</p>
                        </div>
                    </div>

                {{-- Quick stats --}}
                <div class="grid grid-cols-3 gap-2 sm:gap-3 w-full lg:w-auto lg:shrink-0 lg:flex lg:flex-wrap lg:justify-end lg:gap-3">
                        <div class="rounded-2xl border border-stone-200 bg-white/80 backdrop-blur px-4 sm:px-5 py-4 min-w-0 sm:min-w-[7.25rem] lg:w-[8.5rem] lg:shrink-0 text-center">
                            <div class="text-[10px] font-semibold text-stone-500 leading-none whitespace-nowrap" title="{{ __('Your goal') }}">{{ __('personal.stat_goal_short') }}</div>
                            <div class="mt-1.5 flex items-baseline justify-center gap-1.5">
                                <div class="text-[1.05rem] font-extrabold text-stone-900 leading-none">
                                    <span x-show="!error.kcal_per_day" x-text="calculated.kcal_per_day"></span>
                                    <span x-show="error.kcal_per_day" class="text-stone-400">—</span>
                                </div>
                                <div class="text-[10px] font-semibold text-stone-400 whitespace-nowrap">{{ __('kcal/day') }}</div>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-stone-200 bg-white/80 backdrop-blur px-4 sm:px-5 py-4 min-w-0 sm:min-w-[7.25rem] lg:w-[8.5rem] lg:shrink-0 text-center">
                            <div class="text-[10px] font-semibold text-stone-500 leading-none whitespace-nowrap" title="{{ __('With activity') }}">{{ __('personal.stat_with_activity_short') }}</div>
                            <div class="mt-1.5 flex items-baseline justify-center gap-1.5">
                                <div class="text-[1.05rem] font-extrabold text-stone-900 leading-none">
                                    <span x-show="!error.kcal_per_day_normal" x-text="calculated.kcal_per_day_normal"></span>
                                    <span x-show="error.kcal_per_day_normal" class="text-stone-400">—</span>
                                </div>
                                <div class="text-[10px] font-semibold text-stone-400 whitespace-nowrap">{{ __('kcal/day') }}</div>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-stone-200 bg-white/80 backdrop-blur px-4 sm:px-5 py-4 min-w-0 sm:min-w-[7.25rem] lg:w-[8.5rem] lg:shrink-0 text-center">
                            <div class="text-[10px] font-semibold text-stone-500 leading-none whitespace-nowrap" title="{{ __('To target') }}">{{ __('personal.stat_to_target_short') }}</div>
                            <div class="mt-1.5 flex items-baseline justify-center gap-1.5">
                                <div class="text-[1.05rem] font-extrabold text-stone-900 leading-none">
                                    <span x-show="!error.weeks_to_target" x-text="calculated.weeks_to_target"></span>
                                    <span x-show="error.weeks_to_target" class="text-stone-400">—</span>
                                </div>
                                <div class="text-[10px] font-semibold text-stone-400 whitespace-nowrap">{{ __('weeks') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- How it works (compact) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">
            <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="h-10 w-10 rounded-2xl bg-amber-500/10 text-amber-700 border border-amber-200 grid place-items-center shrink-0">
                        <i class="fas fa-sliders text-sm"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-stone-900">{{ __('personal.how_1_title') }}</div>
                        <div class="mt-1 text-sm text-stone-600">{{ __('personal.how_1_text') }}</div>
                    </div>
                </div>
            </div>
            <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="h-10 w-10 rounded-2xl bg-sky-500/10 text-sky-700 border border-sky-200 grid place-items-center shrink-0">
                        <i class="fas fa-calculator text-sm"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-stone-900">{{ __('personal.how_2_title') }}</div>
                        <div class="mt-1 text-sm text-stone-600">{{ __('personal.how_2_text') }}</div>
                    </div>
                </div>
            </div>
            <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="h-10 w-10 rounded-2xl bg-emerald-500/10 text-emerald-700 border border-emerald-200 grid place-items-center shrink-0">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-stone-900">{{ __('personal.how_3_title') }}</div>
                        <div class="mt-1 text-sm text-stone-600">{{ __('personal.how_3_text') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Inputs --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <div class="lg:col-span-2 space-y-6">

                {{-- Profile & goal --}}
                <div class="rounded-[1.5rem] border border-stone-200 bg-white shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="px-5 py-4 border-b border-stone-100 bg-white/80 backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-amber-500/10 text-amber-700 border border-amber-200 grid place-items-center">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <div>
                                <h2 class="text-sm font-extrabold text-stone-900">{{ __('personal.basic_title') }}</h2>
                                <p class="text-xs text-stone-500">{{ __('Keep it minimal — only what affects the math.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-4">
                                <label class="block text-xs font-semibold text-stone-600">
                                    {{ __('Height') }}
                                </label>
                                <div class="mt-2 relative">
                                    <input type="number" x-model="user.growth_cm" min="1" max="300" step="1" inputmode="numeric" placeholder="170"
                                           class="w-full h-11 rounded-xl border-stone-200 bg-white text-sm px-3 pr-12 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500">
                                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-stone-400">cm</span>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-4">
                                <label class="block text-xs font-semibold text-stone-600">
                                    {{ __('Target weight') }}
                                </label>
                                <div class="mt-2 relative">
                                    <input type="number" x-model="user.target_kg" min="0" max="300" step="0.1" inputmode="decimal" placeholder="60"
                                           class="w-full h-11 rounded-xl border-stone-200 bg-white text-sm px-3 pr-12 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500">
                                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-stone-400">kg</span>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-4 min-w-0">
                                <label class="block text-xs font-semibold text-stone-600">
                                    {{ __('Sex') }}
                                </label>
                                <select x-model="user.sex"
                                        class="mt-2 w-full h-11 rounded-xl border-stone-200 bg-white text-sm px-3 pr-10 focus:border-amber-500 focus:ring-amber-500">
                                    <option value="male">{{ __('Male') }}</option>
                                    <option value="female">{{ __('Female') }}</option>
                                </select>
                            </div>

                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-4 min-w-0">
                                <label class="block text-xs font-semibold text-stone-600">
                                    {{ __('Birthday date') }}
                                </label>
                                <input type="date" x-model="user.birthday_date"
                                       class="mt-2 w-full h-11 rounded-xl border-stone-200 bg-white text-sm px-3 focus:border-amber-500 focus:ring-amber-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-4">
                                <label class="block text-xs font-semibold text-stone-600">
                                    {{ __('Activity coefficient') }}
                                </label>
                                <select x-model="user.activity_coefficient"
                                        class="mt-2 w-full h-11 rounded-xl border-stone-200 bg-white text-sm px-3 focus:border-amber-500 focus:ring-amber-500">
                                    <option value="1.2">{{ __('Sedentary') }}</option>
                                    <option value="1.38">{{ __('Lightly active') }}</option>
                                    <option value="1.55">{{ __('Moderately active') }}</option>
                                    <option value="1.73">{{ __('Very active') }}</option>
                                    <option value="1.9">{{ __('Extra active') }}</option>
                                </select>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center rounded-full border border-stone-200 bg-white px-2.5 py-1 text-[11px] font-semibold text-stone-700">
                                        <span>{{ __('personal.activity_coef') }}</span>
                                        <span class="mx-1 text-stone-300">·</span>
                                        <span x-text="user.activity_coefficient"></span>
                                    </span>
                                </div>
                                <p class="mt-2 text-xs text-stone-500" x-text="activityOptions?.[user.activity_coefficient]?.long || ''"></p>
                                <p class="mt-1 text-[11px] text-stone-500">{{ __('This changes your maintenance calories (TDEE).') }}</p>
                            </div>

                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-4">
                                <label class="flex items-center justify-between gap-3 text-xs font-semibold text-stone-600">
                                    <span>{{ __('Deficit kcal') }}</span>
                                    <span
                                        x-show="calculated.kcal_per_day_normal"
                                        class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-2.5 py-1 text-[11px] font-semibold text-amber-800"
                                    >
                                        <span x-text="calculated.recommended_deficit_kcal_from + '–' + calculated.recommended_deficit_kcal_to"></span>
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <input type="number" x-model="user.deficit_kcal" min="0" max="1500" step="1" inputmode="numeric" placeholder="400"
                                           class="w-full h-11 rounded-xl border-stone-200 bg-white text-sm px-3 pr-16 placeholder:text-stone-400 focus:border-amber-500 focus:ring-amber-500">
                                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-xs font-semibold text-stone-400">kcal</span>
                                </div>
                                <p class="mt-2 text-xs text-stone-500">
                                    {{ __('Calories deficit per day. Recommended: ') }}
                                    <span x-show="calculated.kcal_per_day_normal" x-text="calculated.recommended_deficit_kcal_from + ' - ' + calculated.recommended_deficit_kcal_to" class="font-semibold text-amber-700"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Measurements (accordion) --}}
                <div class="rounded-[1.5rem] border border-stone-200 bg-white shadow-xl shadow-stone-900/5 overflow-hidden">
                    <button
                        type="button"
                        @click="active === 'measurements' ? active = null : active = 'measurements'"
                        class="w-full px-5 py-4 flex items-center justify-between gap-4 hover:bg-stone-50/70 transition"
                        :class="active === 'measurements' ? 'bg-amber-50/40' : ''"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl grid place-items-center border transition"
                                 :class="active === 'measurements' ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-stone-700 border-stone-200'">
                                <i class="fas fa-ruler text-sm"></i>
                            </div>
                            <div class="text-left">
                                <div class="text-sm font-extrabold text-stone-900">{{ __('Last Measurements') }}</div>
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
                        class="p-5 sm:p-6"
                    >
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                            <template x-for="(measurement, index) in measurements" :key="index">
                                <div class="space-y-1.5 min-w-0">
                                    <label x-text="measurement.translatable"
                                           class="block text-xs font-semibold text-stone-500 uppercase tracking-wide"></label>
                                    <input type="number" x-model="measurement.value" min="0" step="0.1"
                                           class="w-full h-11 rounded-xl border-stone-200 text-sm px-3 tabular-nums focus:border-amber-500 focus:ring-amber-500"
                                           @focus="if (measurement.value == 0) measurement.value = ''">
                                </div>
                            </template>
                        </div>
                        <p class="mt-4 text-xs text-stone-500">
                            {{ __('Tip: measurements are saved for today. You can update them anytime.') }}
                        </p>
                    </div>
                </div>

                {{-- Save --}}
                <div class="flex justify-end">
                    <button
                        @click="save"
                        class="inline-flex items-center justify-center gap-2 h-11 px-6 rounded-2xl bg-stone-900 text-white text-sm font-semibold shadow-lg shadow-stone-900/10 hover:bg-stone-800 active:scale-[0.99] transition"
                    >
                        <i class="fas fa-check text-xs"></i>{{ __('Save') }}
                    </button>
                </div>
            </div>

            {{-- Calculations --}}
            <div class="space-y-6">
                <div class="rounded-[1.5rem] border border-stone-200 bg-white shadow-xl shadow-stone-900/5 overflow-hidden">
                    <div class="px-5 py-4 border-b border-stone-100 bg-white/80 backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-700 border border-emerald-200 grid place-items-center">
                                <i class="fas fa-calculator text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-extrabold text-stone-900">{{ __('Calculated info') }}</div>
                                <div class="text-xs text-stone-500">{{ __('Instant results as you change inputs') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-3">
                                <div class="text-[11px] font-semibold text-stone-500">{{ __('Body Mass Index (BMI)') }}</div>
                                <div class="mt-1 text-lg font-extrabold text-stone-900">
                                    <span x-show="!error.BMI" x-text="calculated.BMI"></span>
                                    <span x-show="error.BMI" class="text-stone-400">—</span>
                                </div>
                                <div class="text-[11px] text-stone-500" x-show="error.BMI">{{ __('Insufficient data. Please fill weight and growth.') }}</div>
                            </div>
                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-3">
                                <div class="text-[11px] font-semibold text-stone-500">{{ __('Fat percent') }}</div>
                                <div class="mt-1 text-lg font-extrabold text-stone-900">
                                    <span x-show="!error.fat_percent" x-text="calculated.fat_percent + '%'"></span>
                                    <span x-show="error.fat_percent" class="text-stone-400">—</span>
                                </div>
                                <div class="text-[11px] text-stone-500" x-show="error.fat_percent">{{ __('Insufficient data. Please fill waist, neck, hips (for women), height and birth date.') }}</div>
                            </div>
                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-3">
                                <div class="text-[11px] font-semibold text-stone-500">{{ __('Basal metabolic rate (BMR)') }}</div>
                                <div class="mt-1 text-lg font-extrabold text-stone-900">
                                    <span x-show="!error.BMR" x-text="calculated.BMR"></span>
                                    <span x-show="error.BMR" class="text-stone-400">—</span>
                                </div>
                                <div class="text-[11px] text-stone-500" x-show="error.BMR">{{ __('Insufficient data. Please fill weight, height and birth date.') }}</div>
                            </div>
                            <div class="rounded-2xl border border-stone-200 bg-stone-50/60 p-3">
                                <div class="text-[11px] font-semibold text-stone-500">{{ __('Calorie consumption per day with activity') }}</div>
                                <div class="mt-1 text-lg font-extrabold text-stone-900">
                                    <span x-show="!error.kcal_per_day_normal" x-text="calculated.kcal_per_day_normal"></span>
                                    <span x-show="error.kcal_per_day_normal" class="text-stone-400">—</span>
                                </div>
                                <div class="text-[11px] text-stone-500" x-show="error.kcal_per_day_normal">{{ __('Insufficient data. Please fill weight, height and DOB') }}</div>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-amber-200 bg-amber-50/70 p-4">
                            <div class="text-xs font-semibold text-amber-800">{{ __('Your daily calorie limit based on desirable deficit') }}</div>
                            <div class="mt-2 flex items-baseline gap-2">
                                <div class="text-2xl font-extrabold text-amber-800">
                                    <span x-show="!error.kcal_per_day" x-text="calculated.kcal_per_day"></span>
                                    <span x-show="error.kcal_per_day" class="text-amber-500">—</span>
                                </div>
                                <div class="text-sm font-semibold text-amber-700">{{ __('kcal/day') }}</div>
                            </div>
                            <div class="mt-1 text-xs text-amber-700/80" x-show="error.kcal_per_day">
                                {{ __('Insufficient data. Please fill weight, height, DOB and deficit kcal.') }}
                            </div>
                        </div>

                        <div class="rounded-2xl border border-stone-200 bg-white p-4">
                            <div class="flex items-center justify-between">
                                <div class="text-xs font-semibold text-stone-500">{{ __('Weeks to target weight') }}</div>
                                <div class="text-xs text-stone-400">{{ __('approx.') }}</div>
                            </div>
                            <div class="mt-2 flex items-baseline gap-2">
                                <div class="text-2xl font-extrabold text-stone-900">
                                    <span x-show="!error.weeks_to_target" x-text="calculated.weeks_to_target"></span>
                                    <span x-show="error.weeks_to_target" class="text-stone-400">—</span>
                                </div>
                                <div class="text-sm font-semibold text-stone-500">{{ __('weeks') }}</div>
                            </div>
                            <div class="mt-1 text-xs text-stone-500" x-show="error.weeks_to_target">
                                {{ __('Insufficient data. Please fill weight, target weight and deficit kcal.') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur p-5 shadow-lg shadow-stone-900/5">
                    <div class="text-sm font-extrabold text-stone-900">{{ __('Pro tip') }}</div>
                    <p class="mt-2 text-sm text-stone-600">
                        {{ __('Aim for a sustainable deficit. If the plan feels too hard, reduce deficit and stay consistent.') }}
                    </p>
                </div>
            </div>
        </div>

        <x-loading-screen/>
    </div>

    {{-- Sticky mobile save bar --}}
    <div class="sm:hidden fixed inset-x-0 bottom-0 z-40">
        <div class="px-4 pb-4">
            <div class="rounded-2xl border border-stone-200 bg-white/90 backdrop-blur shadow-2xl shadow-stone-900/10 p-3 flex items-center gap-3">
                <div class="flex-1 min-w-0">
                    <div class="text-[11px] font-semibold text-stone-500">{{ __('Your goal') }}</div>
                    <div class="text-base font-extrabold text-stone-900">
                        <span x-show="!error.kcal_per_day" x-text="calculated.kcal_per_day"></span>
                        <span x-show="error.kcal_per_day" class="text-stone-400">—</span>
                        <span class="text-xs font-semibold text-stone-500">{{ __('kcal/day') }}</span>
                    </div>
                </div>
                <button
                    @click="save"
                    class="shrink-0 inline-flex items-center justify-center gap-2 h-11 px-5 rounded-2xl bg-stone-900 text-white text-sm font-semibold shadow-lg shadow-stone-900/10 hover:bg-stone-800 active:scale-[0.99] transition"
                >
                    <i class="fas fa-check text-xs"></i>{{ __('Save') }}
                </button>
            </div>
        </div>
    </div>
</div>
@php
    // Normalize activity coefficient to one of the known keys to avoid float precision issues
    $rawCoef = Auth::user()->activity_coefficient ?? 1.2;
    $knownCoefs = ['1.2', '1.38', '1.55', '1.73', '1.9'];
    $normalizedCoef = '1.2';
    foreach ($knownCoefs as $k) {
        if (abs((float)$k - (float)$rawCoef) < 0.01) {
            $normalizedCoef = $k;
            break;
        }
    }

    $personalInitial = [
        'user' => [
            'growth_cm' => Auth::user()->growth_cm ?? '',
            'sex' => Auth::user()->sex ?? 'male',
            'activity_coefficient' => $normalizedCoef,
            'birthday_date' => Auth::user()->birthday_date ?? '',
            'target_kg' => Auth::user()->target_kg ?? '',
            'deficit_kcal' => Auth::user()->deficit_kcal ?? '',
        ],
        'activity_options' => [
            '1.2' => [
                'short' => __('Sedentary'),
                'long' => __('Sedentary - little or no exercise'),
            ],
            '1.38' => [
                'short' => __('Lightly active'),
                'long' => __('Lightly Active - exercise/sports 1-3 times/week'),
            ],
            '1.55' => [
                'short' => __('Moderately active'),
                'long' => __('Moderately Active - exercise/sports 3-5 times/week'),
            ],
            '1.73' => [
                'short' => __('Very active'),
                'long' => __('Very Active - hard exercise/sports 6-7 times/week'),
            ],
            '1.9' => [
                'short' => __('Extra active'),
                'long' => __('Extra Active - very hard exercise/sports or physical job'),
            ],
        ],
        'labels' => [
            'height' => __('Height'),
            'weight' => __('Weight'),
            'birthday' => __('Birthday date'),
            'activity' => __('Activity coefficient'),
            'target' => __('Target weight'),
            'deficit' => __('Deficit kcal'),
        ],
        'measurements' => $lastMeasurements,
    ];
@endphp

<script type="application/json" id="personal-initial-data">{!! json_encode($personalInitial, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

<script>
    function personalApp() {
        const el = document.getElementById('personal-initial-data');
        const initial = el ? JSON.parse(el.textContent || '{}') : {};

        return {
            active: 'measurements', // expanded by default

            user: initial.user || {
                growth_cm: '',
                sex: 'male',
                activity_coefficient: '1.2',
                birthday_date: '',
                target_kg: '',
                deficit_kcal: '',
            },

            activityOptions: initial.activity_options || {},

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

            labels: initial.labels || {
                height: 'Height',
                weight: 'Weight',
                birthday: 'Birthday date',
                activity: 'Activity coefficient',
                target: 'Target weight',
                deficit: 'Deficit kcal',
            },

            measurements: initial.measurements || {},

            get profileCompletion() {
                const fields = [
                    { key: 'growth_cm', label: this.labels.height, value: this.user.growth_cm },
                    { key: 'weight', label: this.labels.weight, value: this.measurements?.weight?.value },
                    { key: 'birthday_date', label: this.labels.birthday, value: this.user.birthday_date },
                    { key: 'activity_coefficient', label: this.labels.activity, value: this.user.activity_coefficient },
                    { key: 'target_kg', label: this.labels.target, value: this.user.target_kg },
                    { key: 'deficit_kcal', label: this.labels.deficit, value: this.user.deficit_kcal },
                ];

                const filled = fields.filter(f => (String(f.value ?? '').trim() !== '' && Number(f.value ?? 0) > 0) || (f.key === 'birthday_date' && String(f.value ?? '').trim() !== '')).length;
                return Math.round((filled / fields.length) * 100);
            },

            get missingHint() {
                const missing = [];
                if (!(Number(this.user.growth_cm) > 0)) missing.push(this.labels.height);
                if (!(Number(this.measurements?.weight?.value) > 0)) missing.push(this.labels.weight);
                if (!(String(this.user.birthday_date ?? '').trim().length > 0)) missing.push(this.labels.birthday);
                if (!(Number(this.user.activity_coefficient) > 0)) missing.push(this.labels.activity);
                if (!(Number(this.user.target_kg) > 0)) missing.push(this.labels.target);
                if (!(Number(this.user.deficit_kcal) > 0)) missing.push(this.labels.deficit);
                return missing.slice(0, 3).join(', ') + (missing.length > 3 ? '…' : '');
            },

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
