<?php

namespace App\Livewire;

use App\Models\Measurement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Diary extends Component
{
    public string $date;

    public function mount()
    {
        $this->date = now()->toDateString();
    }

    public function render()
    {
        $breakfast = Auth::user()->foodIntakes()->where('type_food_intake', 1)->where('date', $this->date)->with('product')->get();
        $lunch = Auth::user()->foodIntakes()->where('type_food_intake', 2)->where('date', $this->date)->with('product')->get();
        $dinner = Auth::user()->foodIntakes()->where('type_food_intake', 3)->where('date', $this->date)->with('product')->get();
        $snack = Auth::user()->foodIntakes()->where('type_food_intake', 4)->where('date', $this->date)->with('product')->get();

        $measurement = Measurement::firstOrCreate(
            ['user_id' => Auth::id(), 'date' => $this->date],
            ['date' => $this->date, 'user_id' => Auth::id()]
        );

        return view('livewire.diary', compact('measurement', 'breakfast', 'lunch', 'dinner', 'snack'));
    }
}
