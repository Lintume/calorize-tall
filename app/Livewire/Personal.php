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
            'growth_cm' => 'nullable|numeric|min:0|max:300',
            'sex' => 'nullable|string|in:male,female',
            'activity_coefficient' => 'nullable|numeric|min:1|max:2',
            'birthday_date' => 'nullable|date',
            'target_kg' => 'nullable|numeric|min:0|max:300',
            'deficit_kcal' => 'nullable|numeric|min:0|max:1500',
        ]);
        Auth::user()->update($validator->validated());

        $validator = Validator::make($calculations, [
            'kcal_per_day' => 'nullable|numeric|min:500|max:6000',
        ]);
        Auth::user()->update($validator->validated());

        $validator = Validator::make($measurements, [
            'weight.value' => 'nullable|numeric|min:0',
            'chest.value' => 'nullable|numeric|min:0',
            'waist.value' => 'nullable|numeric|min:0',
            'thighs.value' => 'nullable|numeric|min:0',
            'wrist.value' => 'nullable|numeric|min:0',
            'neck.value' => 'nullable|numeric|min:0',
            'biceps.value' => 'nullable|numeric|min:0',
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
        // Only save if at least one measurement has a value
        $hasAnyValue = collect($measurements)->filter(fn ($m) => ! empty($m['value']))->isNotEmpty();
        if (! $hasAnyValue) {
            return;
        }

        $measurement = Auth::user()->measurements()->where('date', now()->toDateString())->first();
        if (! $measurement) {
            $measurement = Auth::user()->measurements()->create([
                'date' => now()->toDateString(),
            ]);
        }
        $measurement->update([
            'kg' => $measurements['weight']['value'] ?: 0,
            'chest_cm' => $measurements['chest']['value'] ?: 0,
            'waist_cm' => $measurements['waist']['value'] ?: 0,
            'thighs_cm' => $measurements['thighs']['value'] ?: 0,
            'wrist_cm' => $measurements['wrist']['value'] ?: 0,
            'neck_cm' => $measurements['neck']['value'] ?: 0,
            'biceps_cm' => $measurements['biceps']['value'] ?: 0,
        ]);
    }

    public function render()
    {
        return view('livewire.personal');
    }
}
