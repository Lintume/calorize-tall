<?php

namespace App\Livewire;

use App\Models\Measurement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Personal extends Component
{
    public ?Measurement $measurement;

    public function mount()
    {
        $this->setMeasurement();
    }

    private function setMeasurement(): void
    {
        //get the last measurement record for today for the authenticated user
        $this->measurement = Measurement::where('user_id', Auth::id())
            ->where('date', '<=', now()->toDateString())
            ->orderBy('date', 'desc')
            ->first();
        if (!$this->measurement) {
            $this->measurement = Auth::user()->measurements()->create([
                'date' => now()->toDateString(),
            ]);
        }
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
        $this->measurement->update([
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
