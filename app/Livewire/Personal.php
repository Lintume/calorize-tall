<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Personal extends Component
{
    public array $lastMeasurements = [
        'weight' => [],
        'chest' => [],
        'waist' => [],
        'thighs' => [],
        'wrist' => [],
        'neck' => [],
        'biceps' => [],
    ];

    public function mount()
    {
        $this->getLastMeasurements();
    }

    private function getLastMeasurements(): void
    {
        $this->lastMeasurements['weight']['translatable'] = __('Weight');
        $this->lastMeasurements['chest']['translatable'] = __('Chest');
        $this->lastMeasurements['waist']['translatable'] = __('Waist');
        $this->lastMeasurements['thighs']['translatable'] = __('Thighs');
        $this->lastMeasurements['wrist']['translatable'] = __('Wrist');
        $this->lastMeasurements['neck']['translatable'] = __('Neck');
        $this->lastMeasurements['biceps']['translatable'] = __('Biceps');

        $this->lastMeasurements['weight']['value'] = Auth::user()->measurements()->where('kg', '>', 0)->orderBy('date', 'DESC')->value('kg');
        $this->lastMeasurements['chest']['value'] = Auth::user()->measurements()->where('chest_cm', '>', 0)->orderBy('date', 'DESC')->value('chest_cm');
        $this->lastMeasurements['waist']['value'] = Auth::user()->measurements()->where('waist_cm', '>', 0)->orderBy('date', 'DESC')->value('waist_cm');
        $this->lastMeasurements['thighs']['value'] = Auth::user()->measurements()->where('thighs_cm', '>', 0)->orderBy('date', 'DESC')->value('thighs_cm');
        $this->lastMeasurements['wrist']['value'] = Auth::user()->measurements()->where('wrist_cm', '>', 0)->orderBy('date', 'DESC')->value('wrist_cm');
        $this->lastMeasurements['neck']['value'] = Auth::user()->measurements()->where('neck_cm', '>', 0)->orderBy('date', 'DESC')->value('neck_cm');
        $this->lastMeasurements['biceps']['value'] = Auth::user()->measurements()->where('biceps_cm', '>', 0)->orderBy('date', 'DESC')->value('biceps_cm');
    }

    /**
     * @throws ValidationException
     */
    public function save(array $user, array $calculations, array $measurements)
    {
        $validator = Validator::make($user, [
            'growth_cm' => 'required|numeric|min:0|max:300',
            'sex' => 'required|string|in:male,female',
            'activity_coefficient' => 'required|numeric|min:1|max:2',
            'birthday_date' => 'required|date',
            'target_kg' => 'required|numeric|min:0|max:300',
            'deficit_kcal' => 'required|numeric|min:0|max:1500',
        ]);
        Auth::user()->update($validator->validated());

        $validator = Validator::make($calculations, [
            'kcal_per_day' => 'required|numeric|min:500|max:6000',
        ]);
        Auth::user()->update($validator->validated());

        $validator = Validator::make($measurements, [
            'weight.value' => 'required|numeric|min:0',
            'chest.value' => 'required|numeric|min:0',
            'waist.value' => 'required|numeric|min:0',
            'thighs.value' => 'required|numeric|min:0',
            'wrist.value' => 'required|numeric|min:0',
            'neck.value' => 'required|numeric|min:0',
            'biceps.value' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            $this->setErrorBag($validator->errors());
            throw new ValidationException($validator);
        }

        DB::transaction(function () use ($measurements) {
            $this->saveMeasurements($measurements);
        });

        $this->dispatch('success', __('Data saved successfully!'));
    }

    private function saveMeasurements(array $measurements): void
    {
        $measurement = Auth::user()->measurements()->where('date', now()->toDateString())->first();
        if (! $measurement) {
            $measurement = Auth::user()->measurements()->create([
                'date' => now()->toDateString(),
            ]);
        }
        $measurement->update([
            'kg' => $measurements['weight']['value'],
            'chest_cm' => $measurements['chest']['value'],
            'waist_cm' => $measurements['waist']['value'],
            'thighs_cm' => $measurements['thighs']['value'],
            'wrist_cm' => $measurements['wrist']['value'],
            'neck_cm' => $measurements['neck']['value'],
            'biceps_cm' => $measurements['biceps']['value'],
        ]);
    }

    public function render()
    {
        return view('livewire.personal');
    }
}
