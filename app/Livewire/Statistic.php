<?php

namespace App\Livewire;

use Carbon\Carbon;
use Auth;
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
        'measurements' => []
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
        if (!$firstMeasurement) {
            $this->startDate = Carbon::now()->subWeek()->toDateString();
            $this->endDate = Carbon::now()->toDateString();
            return;
        }
        $firstAvailableDate = $firstMeasurement->date;
        $this->startDate = Carbon::parse($firstAvailableDate)->toDateString();
        $this->endDate = Carbon::now()->toDateString();

        $this->getData();
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
        if(!$timeRange) {
            return;
        }
        $this->startDate = Carbon::now()->{$timeRange}()->toDateString();
        $this->endDate = Carbon::now()->toDateString();
    }

    private function rebuildChartData(): void
    {
        $this->getData();
        // Emit an event to the frontend
        $this->dispatch('chartDataUpdated', $this->data['dates'], $this->data['measurements']);
    }

    function getReducedDates(array $dates): array
    {
        $reduce = 10;
        if (count($dates) <= $reduce) {
            return $dates;
        }
        $totalDates = count($dates);
        $timeframeSize = ceil($totalDates / $reduce);
        $selectedDates = [];

        for ($i = 0; $i < $reduce; $i++) {
            $index = min($i * $timeframeSize, $totalDates - 1);
            $selectedDates[] = $dates[$index];
        }

        // Ensure the last date is included
        if (end($selectedDates) !== end($dates)) {
            $selectedDates[$reduce - 1] = end($dates);
        }

        return $selectedDates;
    }

    public function render()
    {
        return view('livewire.statistic');
    }
}
