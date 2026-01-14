<div class="pb-24">
    @section('title', __('Statistic'))

    <div class="mt-6 rounded-[1.75rem] border border-stone-200 bg-white/80 backdrop-blur shadow-xl shadow-stone-900/5 overflow-hidden">
        {{-- Header --}}
        <div class="px-4 sm:px-6 py-5 border-b border-stone-200/70 bg-[radial-gradient(900px_circle_at_15%_-10%,rgba(245,158,11,0.18),transparent_55%),radial-gradient(700px_circle_at_90%_0%,rgba(14,165,233,0.12),transparent_55%),linear-gradient(to_bottom,rgba(255,255,255,0.7),rgba(255,255,255,0.7))]">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div class="min-w-0">
                    <div class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-white/70 backdrop-blur px-3.5 py-2 text-xs font-semibold text-stone-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        <span>{{ __('Trends & averages') }}</span>
                    </div>
                    <div class="mt-3">
                        <h1 class="text-xl sm:text-2xl font-extrabold tracking-tight text-stone-900">{{ __('Statistic') }}</h1>
                        <p class="mt-1 text-sm text-stone-600">
                            {{ __('Pick a period to see nutrition averages and body measurements over time.') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a
                        href="{{ route('diary') }}"
                        class="h-10 px-4 rounded-2xl border border-stone-200 bg-white/70 backdrop-blur text-sm font-semibold text-stone-800 hover:bg-white transition inline-flex items-center gap-2"
                    >
                        <i class="fas fa-book-open text-xs text-stone-600"></i>
                        <span>{{ __('Diary') }}</span>
                    </a>
                </div>
            </div>

            <!-- Date Range Selector -->
            <div class="mt-5">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                    <div class="md:col-span-4">
                        <label for="start-date" class="block text-[11px] font-semibold text-stone-500 mb-1">{{ __('Start date') }}</label>
                        <input
                            wire:model.live="startDate"
                            type="date"
                            id="start-date"
                            class="block w-full h-11 rounded-2xl border-stone-200 bg-white/80 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-stone-800 text-sm px-4"
                        />
                        <div class="text-red-600 text-xs mt-1">@error('startDate') {{ $message }} @enderror</div>
                    </div>

                    <div class="md:col-span-4">
                        <label for="end-date" class="block text-[11px] font-semibold text-stone-500 mb-1">{{ __('End date') }}</label>
                        <input
                            wire:model.live="endDate"
                            type="date"
                            id="end-date"
                            class="block w-full h-11 rounded-2xl border-stone-200 bg-white/80 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-stone-800 text-sm px-4"
                        />
                        <div class="text-red-600 text-xs mt-1">@error('endDate') {{ $message }} @enderror</div>
                    </div>

                    <div class="md:col-span-4">
                        <label class="block text-[11px] font-semibold text-stone-500 mb-1">{{ __('Period') }}</label>
                        <select
                            wire:model.live="timeRange"
                            class="block w-full h-11 rounded-2xl border-stone-200 bg-white/80 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-stone-800 text-sm px-4"
                        >
                            <option value="">{{ __('Select period') }}</option>
                            @foreach($timeRanges as $key => $value)
                                <option value="{{ $key }}">{{ __($value) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-4 sm:p-6 space-y-6">
            <!-- Average Nutrition Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <div class="rounded-3xl border border-stone-200 bg-white p-4 sm:p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="text-[11px] font-semibold text-stone-500 uppercase tracking-wide">{{ __('Avg kcal / day') }}</div>
                            <div class="mt-2 text-3xl font-extrabold text-amber-700 tabular-nums">{{ $nutrition['avg']['calories'] }}</div>
                            <div class="mt-1 text-xs text-stone-500">{{ __('Days: ') }}{{ $nutrition['days'] }}</div>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center border border-amber-200">
                            <i class="fas fa-fire text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-stone-200 bg-white p-4 sm:p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="text-[11px] font-semibold text-stone-500 uppercase tracking-wide">{{ __('Avg proteins / day') }}</div>
                            <div class="mt-2 text-3xl font-extrabold text-sky-700 tabular-nums">{{ $nutrition['avg']['proteins'] }}</div>
                            <div class="mt-1 text-xs text-stone-500">{{ __('g') }}</div>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center border border-sky-200">
                            <i class="fas fa-dumbbell text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-stone-200 bg-white p-4 sm:p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="text-[11px] font-semibold text-stone-500 uppercase tracking-wide">{{ __('Avg fats / day') }}</div>
                            <div class="mt-2 text-3xl font-extrabold text-amber-700 tabular-nums">{{ $nutrition['avg']['fats'] }}</div>
                            <div class="mt-1 text-xs text-stone-500">{{ __('g') }}</div>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center border border-amber-200">
                            <i class="fas fa-tint text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-stone-200 bg-white p-4 sm:p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="text-[11px] font-semibold text-stone-500 uppercase tracking-wide">{{ __('Avg carbs / day') }}</div>
                            <div class="mt-2 text-3xl font-extrabold text-emerald-700 tabular-nums">{{ $nutrition['avg']['carbohydrates'] }}</div>
                            <div class="mt-1 text-xs text-stone-500">{{ __('g') }}</div>
                        </div>
                        <div class="h-10 w-10 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center border border-emerald-200">
                            <i class="fas fa-leaf text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="rounded-[1.25rem] bg-white border border-stone-200 shadow-sm overflow-hidden">
                <!-- Tabs -->
                <div class="px-4 sm:px-6 py-3 border-b border-stone-200/70 bg-white/70">
                    <div class="flex items-center justify-between gap-3">
                        <div class="text-sm font-extrabold text-stone-900">{{ __('Measurements') }}</div>
                        <div class="text-xs text-stone-500 hidden sm:block">{{ __('Up to 10 points are shown') }}</div>
                    </div>

                    <nav class="mt-3 flex gap-2 overflow-x-auto pb-1" aria-label="Tabs">
                        @foreach($tabs as $key=>$value)
                            <a
                                href="#"
                                wire:click.prevent="changeTab('{{$key}}')"
                                @class([
                                    'px-3 py-2 text-sm font-semibold rounded-2xl border transition whitespace-nowrap',
                                    'bg-stone-900 text-white border-stone-900' => $currentTab == $key,
                                    'bg-white text-stone-700 border-stone-200 hover:bg-stone-50' => $currentTab != $key
                                ])
                                aria-current="{{ $currentTab == $key ? 'page' : 'false' }}"
                            >{{ __($value) }}</a>
                        @endforeach
                    </nav>
                </div>

                <!-- Chart Content -->
                @if($data['dates'] && $data['measurements'])
                    <div class="relative p-4 sm:p-6">
                        <div
                            wire:loading.delay.flex
                            wire:target="startDate,endDate,timeRange,changeTab"
                            style="display:none"
                            class="absolute inset-0 bg-white/70 backdrop-blur-[1px] items-center justify-center z-10"
                        >
                            <div class="inline-flex items-center gap-2 rounded-2xl border border-stone-200 bg-white px-4 py-2 shadow-sm">
                                <svg class="h-4 w-4 animate-spin text-amber-600" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                                <span class="text-sm font-semibold text-stone-700">{{ __('Updating...') }}</span>
                            </div>
                        </div>

                        <canvas id="myChart" class="w-full"></canvas>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-2xl bg-stone-100 border border-stone-200">
                            <i class="fas fa-chart-line text-2xl text-stone-400"></i>
                        </div>
                        <h2 class="text-xl font-extrabold text-stone-800 mb-2">{{ __('No data for selected period') }}</h2>
                        <p class="text-stone-500">
                            {{ __('Please add measurements in ') }}
                            <a href="{{ route('diary') }}" class="text-amber-700 hover:text-amber-800 font-semibold hover:underline">{{ __('Diary') }}</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($data['dates'] && $data['measurements'])
<script type="application/json" id="statistic-chart-labels">{!! json_encode($data['dates'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/json" id="statistic-chart-values">{!! json_encode($data['measurements'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

@script
<script>
    let myChart;

    function createChart(labels, data) {
        const ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    borderColor: 'rgb(217, 119, 6)', // amber-600
                    backgroundColor: 'rgba(217, 119, 6, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                pointRadius: 4,
                pointBackgroundColor: 'rgb(217, 119, 6)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#78716c' // stone-500
                        }
                    },
                    y: {
                        grid: {
                            color: '#e7e5e4' // stone-200
                        },
                        ticks: {
                            color: '#78716c' // stone-500
                        }
                    }
                }
            },
        });
    }

    const labelsEl = document.getElementById('statistic-chart-labels');
    const valuesEl = document.getElementById('statistic-chart-values');
    const initialLabels = labelsEl ? JSON.parse(labelsEl.textContent || '[]') : [];
    const initialValues = valuesEl ? JSON.parse(valuesEl.textContent || '[]') : [];
    createChart(initialLabels, initialValues);

    Livewire.on('chartDataUpdated', (data) => {
        const canvas = document.getElementById('myChart');

        if (!canvas || !canvas.getContext) {
            console.error("Canvas element is not ready.");
            return;
        }

        if (myChart) {
            myChart.destroy();
        }

        createChart(data[0], data[1]);
    });

</script>
@endscript
@endif
