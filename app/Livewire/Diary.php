<?php

namespace App\Livewire;

use App\Models\FoodIntake;
use App\Models\Measurement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Diary extends Component
{
    #[Validate('date')]
    public string $date;

    public Collection $breakfast;

    public Collection $lunch;

    public Collection $dinner;

    public Collection $snack;

    public ?Measurement $measurement;

    public function mount()
    {
        $this->date = now()->toDateString();

        $this->setFoodIntakes();
        $this->setMeasurement();
    }

    public function updatedDate($date)
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->reset('date');

            return;
        }
        $this->setFoodIntakes();
        $this->setMeasurement();
        $this->dispatch('updatedDate', $this->breakfast, $this->lunch, $this->dinner, $this->snack, $this->measurement);
    }

    private function setFoodIntakes(): void
    {
        $this->breakfast = Auth::user()->foodIntakes()->where('type_food_intake', 1)->where('date', $this->date)->with('product')->get();
        $this->lunch = Auth::user()->foodIntakes()->where('type_food_intake', 2)->where('date', $this->date)->with('product')->get();
        $this->dinner = Auth::user()->foodIntakes()->where('type_food_intake', 3)->where('date', $this->date)->with('product')->get();
        $this->snack = Auth::user()->foodIntakes()->where('type_food_intake', 4)->where('date', $this->date)->with('product')->get();
    }

    private function setMeasurement(): void
    {
        $this->measurement = Measurement::where('user_id', Auth::id())->where('date', $this->date)->first();
        if (! $this->measurement) {
            Measurement::insert([
                'date' => $this->date,
                'user_id' => Auth::id(),
            ]);
            $this->measurement = Measurement::where('user_id', Auth::id())->where('date', $this->date)->first();
        }
    }

    /**
     * @throws ValidationException
     */
    public function save(array $foodIntakes, array $measurements)
    {
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

        DB::transaction(function () use ($foodIntakes, $measurements) {
            $this->saveFoodIntakes($foodIntakes);
            $this->saveMeasurements($measurements);
        });

        $this->dispatch('success', __('Data saved successfully!'));
    }

    private function saveFoodIntakes(array $foodIntakes): void
    {
        Auth::user()->foodIntakes()->where('date', $this->date)->delete();
        $count = 1;
        foreach ($foodIntakes as $intake) {
            foreach ($intake['products'] as $item) {
                $validator = Validator::make($item, [
                    'product.id' => 'required|exists:products,id',
                    'g' => 'required|numeric|min:0|max:100000',
                    'proteins' => 'required|numeric|min:0|max:100000',
                    'fats' => 'required|numeric|min:0|max:100000',
                    'carbohydrates' => 'required|numeric|min:0|max:100000',
                    'calories' => 'required|numeric|min:0|max:100000',
                ]);
                if ($validator->fails()) {
                    $this->setErrorBag($validator->errors());
                    throw new ValidationException($validator);
                }
                FoodIntake::create([
                    'product_id' => $item['product']['id'],
                    'user_id' => Auth::id(),
                    'g' => $item['g'],
                    'proteins' => $item['proteins'],
                    'fats' => $item['fats'],
                    'carbohydrates' => $item['carbohydrates'],
                    'calories' => $item['calories'],
                    'type_food_intake' => $count,
                    'date' => $this->date,
                ]);
            }
            $count++;
        }
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

    public function changeDate(int $number): void
    {
        $this->date = Carbon::parse($this->date)->addDays($number)->toDateString();
        $this->setFoodIntakes();
        $this->setMeasurement();
        $this->dispatch('updatedDate', $this->breakfast, $this->lunch, $this->dinner, $this->snack, $this->measurement);
    }

    public function render()
    {
        return view('livewire.diary');
    }
}
