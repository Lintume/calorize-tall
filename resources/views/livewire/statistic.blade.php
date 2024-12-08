<div>
    test
    <canvas id="myChart"></canvas>
</div>

  @script
    <script>

            console.log('Livewire is loaded! 3');
            // Sample chart data
            var ctx = document.getElementById('myChart').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'line', // Choose chart type (line, bar, etc.)
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], // X-axis labels
                    datasets: [{
                        label: 'Sample Data',
                        data: [12, 19, 3, 5, 2, 3, 7], // Y-axis data
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

    </script>
@endscript
