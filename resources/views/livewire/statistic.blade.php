<div>
    <div class="flex flex-wrap mt-8 mb-4">
        <div class="flex w-full md:w-1/2 lg:w-1/2 space-x-3">
            <!-- Перший дейтпікер -->
            <div class="w-full">
                <label for="start-date" class="block text-sm font-medium text-gray-700">{{__('Start date')}}</label>
                <input
                    wire:model.live="startDate"
                    type="date"
                    id="start-date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                <div class="text-red-600">@error('startDate') {{ $message }} @enderror</div>
            </div>
            <!-- Другий дейтпікер -->
            <div class="w-full">
                <label for="end-date" class="block text-sm font-medium text-gray-700">{{__('End date')}}</label>
                <input
                    wire:model.live="endDate"
                    type="date"
                    id="end-date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                <div class="text-red-600">@error('endDate') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="w-full md:w-1/2 lg:w-1/2 md:pl-3">
            <!-- Select time range -->
            <select wire:model.live="timeRange"
                    class="w-full mt-6 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <option value=""> {{__('Select period')}}</option>
                @foreach($timeRanges as $key => $value)
                    <option value="{{ $key }}">{{ __($value) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="flex flex-col justify-center">
        <div class="flex flex-col shadow justify-between rounded-lg pb-8 xl:p-8 mt-3 bg-white">
            {{--tabs--}}
            <div
                class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mx-6">
                <ul class="flex flex-wrap -mb-px">
                    @foreach($tabs as $key=>$value)
                        <li class="me-2">
                            <a href="#"
                               wire:click.prevent="changeTab('{{$key}}')"
                               @class(['inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500' => $currentTab == $key,
'inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' => $currentTab != $key
])
                               aria-current="page"
                            >{{ __($value) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{--chart--}}
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4 md:text-2xl">{{__($tabs[$currentTab])}} {{__('dynamic for selected period:')}}</h2>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

@script
<script>
    let myChart;

    function createChart(labels, data) {
        const ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'line', // Chart type
            data: {
                labels: labels, // X-axis labels
                datasets: [{
                    data: data, // Y-axis values
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                pointRadius: 5,
                plugins: {
                    legend: {
                        display: false // Hide the legend
                    }
                }
            },
        });
    }

    // Initialize the chart with initial data
    createChart(@json($data['dates']), @json($data['measurements']));

    // Listen for Livewire event to update chart
    Livewire.on('chartDataUpdated', (data) => {
        const canvas = document.getElementById('myChart');

        // Ensure canvas is available and myChart exists
        if (!canvas || !canvas.getContext) {
            console.error("Canvas element is not ready.");
            return;
        }

        // Destroy existing chart if it exists
        if (myChart) {
            myChart.destroy();
        }

        // Recreate the chart with new data
        createChart(data[0], data[1]);
    });

</script>
@endscript

