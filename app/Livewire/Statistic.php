<?php

namespace App\Livewire;

use Carbon\Carbon;
use Auth;
use Livewire\Component;

class Statistic extends Component
{
    public function render()
    {
        $dayFrom = Carbon::now()->subMonth()->toDateString();
        $dayTo = Carbon::now()->toDateString();
        $measurements = Auth::user()
            ->measurements()
            ->whereBetween('date', [$dayFrom, $dayTo])
            ->orderBy('date', 'DESC')
            ->get();
        $array = $measurements->toArray();
        foreach ($array as &$measurement){
            $measurement['kpd'] = Auth::user()
                ->foodIntakes()
                ->where('date', $measurement['date'])
                ->sum('calories');
            foreach ($measurement as $key => $value){
                if(!$value){
                    unset($measurement[$key]);
                }
            }
        }
        $measurements = $array;

        return view('livewire.statistic');
    }
}
