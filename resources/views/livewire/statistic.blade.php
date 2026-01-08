<div>
    @section('title', __('Statistic'))

    <!-- Date Range Selector -->
    <div class="mt-8 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Date inputs -->
            <div class="flex flex-1 gap-4">
                <div class="flex-1">
                    <label for="start-date" class="block text-sm font-medium text-stone-600 mb-1.5">{{__('Start date')}}</label>
                <input
                    wire:model.live="startDate"
                    type="date"
                    id="start-date"
                        class="block w-full rounded-xl border-stone-200 bg-white shadow-sm focus:border-amber-500 focus:ring-amber-500 text-stone-800 text-sm py-2.5 px-4"
                />
                    <div class="text-red-600 text-xs mt-1">@error('startDate') {{ $message }} @enderror</div>
            </div>
                <div class="flex-1">
                    <label for="end-date" class="block text-sm font-medium text-stone-600 mb-1.5">{{__('End date')}}</label>
                <input
                    wire:model.live="endDate"
                    type="date"
                    id="end-date"
                        class="block w-full rounded-xl border-stone-200 bg-white shadow-sm focus:border-amber-500 focus:ring-amber-500 text-stone-800 text-sm py-2.5 px-4"
                />
                    <div class="text-red-600 text-xs mt-1">@error('endDate') {{ $message }} @enderror</div>
                </div>
            </div>
            <!-- Period selector -->
            <div class="flex-1 md:max-w-xs">
                <label class="block text-sm font-medium text-stone-600 mb-1.5 invisible">{{__('Period')}}</label>
            <select wire:model.live="timeRange"
                        class="block w-full rounded-xl border-stone-200 bg-white shadow-sm focus:border-amber-500 focus:ring-amber-500 text-stone-800 text-sm py-2.5 px-4">
                    <option value="">{{__('Select period')}}</option>
                @foreach($timeRanges as $key => $value)
                    <option value="{{ $key }}">{{ __($value) }}</option>
                @endforeach
            </select>
            </div>
        </div>
    </div>

    <!-- Average Nutrition Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="rounded-2xl bg-gradient-to-br from-amber-50 to-white border border-amber-100 p-5 shadow-sm">
            <div class="text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">{{ __('Avg kcal / day') }}</div>
            <div class="text-3xl font-bold text-amber-700">{{ $nutrition['avg']['calories'] }}</div>
            <div class="text-xs text-stone-400 mt-1">{{ __('Days: ') }}{{ $nutrition['days'] }}</div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-blue-100 p-5 shadow-sm">
            <div class="text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">{{ __('Avg proteins / day') }}</div>
            <div class="text-3xl font-bold text-blue-700">{{ $nutrition['avg']['proteins'] }}</div>
            <div class="text-xs text-stone-400 mt-1">{{ __('g') }}</div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-orange-50 to-white border border-orange-100 p-5 shadow-sm">
            <div class="text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">{{ __('Avg fats / day') }}</div>
            <div class="text-3xl font-bold text-orange-600">{{ $nutrition['avg']['fats'] }}</div>
            <div class="text-xs text-stone-400 mt-1">{{ __('g') }}</div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 p-5 shadow-sm">
            <div class="text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">{{ __('Avg carbs / day') }}</div>
            <div class="text-3xl font-bold text-emerald-600">{{ $nutrition['avg']['carbohydrates'] }}</div>
            <div class="text-xs text-stone-400 mt-1">{{ __('g') }}</div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="rounded-2xl bg-white border border-stone-200 shadow-sm overflow-hidden">
        <!-- Tabs -->
        <div class="border-b border-stone-200 px-6">
            <nav class="flex gap-1 -mb-px overflow-x-auto" aria-label="Tabs">
                    @foreach($tabs as $key=>$value)
                            <a href="#"
                               wire:click.prevent="changeTab('{{$key}}')"
                       @class([
                           'px-4 py-4 text-sm font-medium border-b-2 transition-colors whitespace-nowrap',
                           'border-amber-500 text-amber-700' => $currentTab == $key,
                           'border-transparent text-stone-500 hover:text-stone-700 hover:border-stone-300' => $currentTab != $key
])
                       aria-current="{{ $currentTab == $key ? 'page' : 'false' }}"
                            >{{ __($value) }}</a>
                    @endforeach
            </nav>
            </div>

        <!-- Chart Content -->
            @if($data['dates'] && $data['measurements'])
                <div class="p-6">
                    <canvas id="myChart" class="w-full"></canvas>
                </div>
            @else
            <div class="p-8 text-center">
                <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-stone-100">
                    <i class="fas fa-chart-line text-2xl text-stone-400"></i>
                </div>
                <h2 class="text-xl font-semibold text-stone-800 mb-2">{{__('No data for selected period')}}</h2>
                <p class="text-stone-500">{{__('Please add measurements in ')}}
                        <a href="{{route('diary')}}"
                       class="text-amber-600 hover:text-amber-700 font-medium hover:underline">{{__('Diary')}}</a>
                    </p>
                </div>
            @endif
    </div>
</div>

@if($data['dates'] && $data['measurements'])
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

    createChart(@json($data['dates']), @json($data['measurements']));

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
