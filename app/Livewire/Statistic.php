<?php

namespace App\Livewire;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Statistic extends Component
{
    #[Validate('required|date|before_or_equal:endDate')]
    public string $startDate;

    #[Validate('required|date|after_or_equal:startDate')]
    public string $endDate;

    #[Validate('required|in:kg,thighs_cm,chest_cm,waist_cm,wrist_cm,neck_cm,biceps_cm')]
    public string $currentTab = 'kg';

    public array $tabs = [
        'kg' => 'Weight',
        'chest_cm' => 'Chest',
        'waist_cm' => 'Waist',
        'thighs_cm' => 'Thighs',
        'wrist_cm' => 'Wrist',
        'neck_cm' => 'Neck',
        'biceps_cm' => 'Biceps',
    ];

    public array $data = [
        'dates' => [],
        'measurements' => [],
    ];

    public array $nutrition = [
        'days' => 0,
        'total' => [
            'calories' => 0,
            'proteins' => 0,
            'fats' => 0,
            'carbohydrates' => 0,
        ],
        'avg' => [
            'calories' => 0,
            'proteins' => 0,
            'fats' => 0,
            'carbohydrates' => 0,
        ],
    ];

    #[Validate('nullable|in:subWeek,subMonth,subYear')]
    public string $timeRange = '';

    public array $timeRanges = [
        'subWeek' => 'Last Week',
        'subMonth' => 'Last Month',
        'subYear' => 'Last Year',
    ];

    public function mount()
    {
        $firstMeasurement = Auth::user()
            ->measurements()
            ->orderBy('date', 'ASC')
            ->where($this->currentTab, '!=', 0)
            ->first();
        if (! $firstMeasurement) {
            $this->startDate = Carbon::now()->subWeek()->toDateString();
            $this->endDate = Carbon::now()->toDateString();
            $this->computeNutritionAverages();
            return;
        }
        $firstAvailableDate = $firstMeasurement->date;
        $this->startDate = Carbon::parse($firstAvailableDate)->toDateString();
        $this->endDate = Carbon::now()->toDateString();

        $this->getData();
        $this->computeNutritionAverages();
    }

    public function updated($field)
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->reset('currentTab');
            $this->reset('timeRange');

            return;
        }
        if ($field === 'timeRange') {
            $this->setTimeRange($this->timeRange);
        }
        if ($field === 'startDate' || $field === 'endDate') {
            $this->reset('timeRange');
        }
        $this->rebuildChartData();
    }

    public function changeTab($tab): void
    {
        try {
            $this->currentTab = $tab;
            $this->validate();
        } catch (ValidationException $e) {
            $this->reset('currentTab');

            return;
        }

        $this->rebuildChartData();
    }

    private function getData(): void
    {
        $measurementsCollection = Auth::user()
            ->measurements()
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->where($this->currentTab, '!=', 0)
            ->orderBy('date', 'ASC')
            ->get();
        if ($measurementsCollection->isEmpty()) {
            return;
        }

        $reducedDates = $this->getReducedDates($measurementsCollection->pluck('date')->toArray());

        $measurements = [];
        foreach ($reducedDates as $date) {
            $measurements[] = $measurementsCollection->where('date', $date)->first()->{$this->currentTab};
        }

        $formattedDates = [];
        foreach ($reducedDates as $date) {
            $formattedDates[] = Carbon::parse($date)->format('d M y');
        }

        $this->data['dates'] = $formattedDates;
        $this->data['measurements'] = $measurements;
    }

    public function setTimeRange($timeRange): void
    {
        if (! $timeRange) {
            return;
        }
        $this->startDate = Carbon::now()->{$timeRange}()->toDateString();
        $this->endDate = Carbon::now()->toDateString();
    }

    private function rebuildChartData(): void
    {
        $this->getData();
        $this->computeNutritionAverages();
        // Emit an event to the frontend
        $this->dispatch('chartDataUpdated', $this->data['dates'], $this->data['measurements']);
    }

    private function computeNutritionAverages(): void
    {
        $start = Carbon::parse($this->startDate)->startOfDay();
        $end = Carbon::parse($this->endDate)->startOfDay();
        $days = $start->diffInDays($end) + 1;

        /** @var Collection<int, object{date:string, calories:string|int, proteins:string|int, fats:string|int, carbohydrates:string|int}> $dailyTotals */
        $dailyTotals = Auth::user()
            ->foodIntakes()
            ->selectRaw('date, SUM(calories) as calories, SUM(proteins) as proteins, SUM(fats) as fats, SUM(carbohydrates) as carbohydrates')
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->groupBy('date')
            ->get();

        $totalCalories = (int) $dailyTotals->sum('calories');
        $totalProteins = (int) $dailyTotals->sum('proteins');
        $totalFats = (int) $dailyTotals->sum('fats');
        $totalCarbohydrates = (int) $dailyTotals->sum('carbohydrates');

        $this->nutrition = [
            'days' => $days,
            'total' => [
                'calories' => $totalCalories,
                'proteins' => $totalProteins,
                'fats' => $totalFats,
                'carbohydrates' => $totalCarbohydrates,
            ],
            'avg' => [
                'calories' => $days ? (int) round($totalCalories / $days) : 0,
                'proteins' => $days ? (int) round($totalProteins / $days) : 0,
                'fats' => $days ? (int) round($totalFats / $days) : 0,
                'carbohydrates' => $days ? (int) round($totalCarbohydrates / $days) : 0,
            ],
        ];
    }

    public function getReducedDates(array $dates): array
    {
        $size = 10;
        // If the array has less than or equal to the required size, return it as is.
        if (count($dates) <= $size) {
            return $dates;
        }

        $result = [];
        $totalDates = count($dates);
        $interval = ($totalDates - 1) / ($size - 1); // Calculate the approximate interval.

        for ($i = 0; $i < $size - 1; $i++) {
            // Pick the date at the calculated index.
            $index = round($i * $interval);
            $result[] = $dates[$index];
        }

        // Ensure the last date is included.
        $result[] = $dates[$totalDates - 1];

        return $result;
    }

    public function render()
    {
        return view('livewire.statistic');
    }
}
