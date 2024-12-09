<?php

namespace App\Livewire;

use Carbon\Carbon;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Statistic extends Component
{
    #[Validate('required|date')]
    public string $startDate;

    #[Validate('required|date')]
    public string $endDate;

    public array $data = [
        'weight' => [
            'dates' => [],
            'measurements' => []
        ],
        'thighs' => [
            'dates' => [],
            'measurements' => []
        ],
        'chest' => [
            'dates' => [],
            'measurements' => []
        ],
        'waist' => [
            'dates' => [],
            'measurements' => []
        ],
        'wrist' => [
            'dates' => [],
            'measurements' => []
        ],
        'neck' => [
            'dates' => [],
            'measurements' => []
        ],
        'biceps' => [
            'dates' => [],
            'measurements' => []
        ],
    ];

    public function mount()
    {
        $this->startDate = Carbon::now()->subYears(2)->toDateString();
        $this->endDate = Carbon::now()->toDateString();
        $this->getWeightData();
    }

    public function updated($field)
    {
        $this->validate();
        $this->getWeightData();
    }

    private function getWeightData()
    {
        $measurements = Auth::user()
            ->measurements()
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->orderBy('date', 'ASC')
            ->get();

        $kgMeasurements = $measurements->where('kg', '!=', 0);

        $kgDates = $this->getReducedDates($kgMeasurements->pluck('date')->toArray());

        $kgWeights = [];
        foreach ($kgDates as $date) {
            $kgWeights[] = $kgMeasurements->where('date', $date)->first()['kg'];
        }

        $formattedKgDates = [];
        foreach ($kgDates as $date) {
            $formattedKgDates[] = Carbon::parse($date)->format('d M y');
        }

        $this->data['weight']['dates'] = $formattedKgDates;
        $this->data['weight']['measurements'] = $kgWeights;
    }

    public function render()
    {

        return view('livewire.statistic');
    }

    function getReducedDates(array $dates)
    {
        $reduce = 10;
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
}
