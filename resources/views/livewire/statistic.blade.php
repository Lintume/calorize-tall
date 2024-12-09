<div>
    <div class="flex items-center justify-center bg-gray-100 my-8">
        <div class="flex items-center space-x-5">
            <!-- Перший дейтпікер -->
            <div class="w-full max-w-xs">
                <label for="start-date" class="block text-sm font-medium text-gray-700">{{__('Start date')}}</label>
                <input
                    wire:model.live="startDate"
                    type="date"
                    id="start-date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                <div>@error('startDate') {{ $message }} @enderror</div>
            </div>

            <!-- Другий дейтпікер -->
            <div class="w-full max-w-xs">
                <label for="end-date" class="block text-sm font-medium text-gray-700">{{__('End date')}}</label>
                <input
                    wire:model.live="endDate"
                    type="date"
                    id="end-date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                <div>@error('endDate') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>



    <div class="flex flex-col justify-center">
            <div class="flex flex-col h-full shadow justify-between rounded-lg pb-8 p-6 xl:p-8 mt-3 bg-gray-50">
                    <h2 class="text-2xl font-bold mb-4">{{__('Weight dynamic')}}</h2>
                    <canvas id="myChart"></canvas>
            </div>
        </div>

</div>

  @script
    <script>
            let ctx = document.getElementById('myChart').getContext('2d');

            let myChart = new Chart(ctx, {
                type: 'line', // Choose chart type (line, bar, etc.)
                data: {
                    labels: @json($data['weight']['dates']), // X-axis labels
                    datasets: [{
                        data: @json($data['weight']['measurements']), // Y-axis values
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: @json(__('Weight, kg')),
                            },
                            beginAtZero: false,
                        }
                    },
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
    </script>
@endscript
