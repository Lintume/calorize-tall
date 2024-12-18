<?php

namespace App\Livewire;

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
        return view('livewire.diary');
    }
}
