<?php

namespace App\Services\DiaryAgent\Tools;

use App\Models\Measurement;
use Prism\Prism\Tool;

class AddMeasurementTool extends Tool
{
    public function __construct()
    {
        $this
            ->as('addMeasurement')
            ->for('Add body measurement for a date. At least one measurement param required (all except date are optional). Updates existing record for the same date if present.')
            ->withStringParameter('date', 'Date (YYYY-MM-DD)')
            ->withNumberParameter('kg', 'Weight in kilograms (optional)')
            ->withNumberParameter('chest_cm', 'Chest circumference in cm (optional)')
            ->withNumberParameter('waist_cm', 'Waist circumference in cm (optional)')
            ->withNumberParameter('thighs_cm', 'Thighs circumference in cm (optional)')
            ->withNumberParameter('wrist_cm', 'Wrist circumference in cm (optional)')
            ->withNumberParameter('neck_cm', 'Neck circumference in cm (optional)')
            ->withNumberParameter('biceps_cm', 'Biceps circumference in cm (optional)')
            ->withNumberParameter('mood', 'Mood level 1-5 (optional)')
            ->withNumberParameter('hunger', 'Hunger level 1-5 (optional)')
            ->withNumberParameter('sleep', 'Hours of sleep (optional)')
            ->using($this);
    }

    public function __invoke(
        string $date,
        ?float $kg = null,
        ?float $chest_cm = null,
        ?float $waist_cm = null,
        ?float $thighs_cm = null,
        ?float $wrist_cm = null,
        ?float $neck_cm = null,
        ?float $biceps_cm = null,
        ?int $mood = null,
        ?int $hunger = null,
        ?float $sleep = null
    ): string {
        $userId = auth()->id();

        if (! $userId) {
            return $this->toolResult('addMeasurement', [
                'success' => false,
                'message' => 'User must be authenticated.',
            ]);
        }

        // Check that at least one measurement is provided
        $hasAnyMeasurement = $kg !== null
            || $chest_cm !== null
            || $waist_cm !== null
            || $thighs_cm !== null
            || $wrist_cm !== null
            || $neck_cm !== null
            || $biceps_cm !== null
            || $mood !== null
            || $hunger !== null
            || $sleep !== null;

        if (! $hasAnyMeasurement) {
            return $this->toolResult('addMeasurement', [
                'success' => false,
                'message' => 'At least one measurement parameter must be provided.',
            ]);
        }

        // Validate kg is positive if provided
        if ($kg !== null && $kg <= 0) {
            return $this->toolResult('addMeasurement', [
                'success' => false,
                'message' => 'Weight must be a positive number.',
            ]);
        }

        // Prepare data
        $data = [
            'user_id' => $userId,
            'date' => $date,
        ];

        if ($kg !== null) {
            $data['kg'] = round($kg, 2);
        }

        // Add optional measurements if provided
        if ($chest_cm !== null) {
            $data['chest_cm'] = round($chest_cm, 1);
        }
        if ($waist_cm !== null) {
            $data['waist_cm'] = round($waist_cm, 1);
        }
        if ($thighs_cm !== null) {
            $data['thighs_cm'] = round($thighs_cm, 1);
        }
        if ($wrist_cm !== null) {
            $data['wrist_cm'] = round($wrist_cm, 1);
        }
        if ($neck_cm !== null) {
            $data['neck_cm'] = round($neck_cm, 1);
        }
        if ($biceps_cm !== null) {
            $data['biceps_cm'] = round($biceps_cm, 1);
        }
        if ($mood !== null) {
            $data['mood'] = max(0, min(5, $mood));
        }
        if ($hunger !== null) {
            $data['hunger'] = max(0, min(5, $hunger));
        }
        if ($sleep !== null) {
            $data['sleep'] = max(0, round($sleep, 1));
        }

        // Check if measurement for this date already exists
        $existing = Measurement::query()
            ->where('user_id', $userId)
            ->where('date', $date)
            ->first();

        if ($existing) {
            // Update existing record
            $existing->update($data);

            return $this->toolResult('addMeasurement', [
                'success' => true,
                'message' => "Updated measurement for {$date}",
                'measurement' => $this->buildMeasurementResponse($existing, true),
            ]);
        }

        // Create new measurement
        $measurement = Measurement::create($data);

        return $this->toolResult('addMeasurement', [
            'success' => true,
            'message' => "Added measurement for {$date}",
            'measurement' => $this->buildMeasurementResponse($measurement, false),
        ]);
    }

    private function buildMeasurementResponse(Measurement $measurement, bool $updated): array
    {
        $response = [
            'id' => $measurement->id,
            'date' => $measurement->date,
        ];

        if ($measurement->kg > 0) {
            $response['kg'] = $measurement->kg;
        }
        if ($measurement->chest_cm > 0) {
            $response['chest_cm'] = $measurement->chest_cm;
        }
        if ($measurement->waist_cm > 0) {
            $response['waist_cm'] = $measurement->waist_cm;
        }
        if ($measurement->thighs_cm > 0) {
            $response['thighs_cm'] = $measurement->thighs_cm;
        }
        if ($measurement->neck_cm > 0) {
            $response['neck_cm'] = $measurement->neck_cm;
        }
        if ($measurement->biceps_cm > 0) {
            $response['biceps_cm'] = $measurement->biceps_cm;
        }
        if ($measurement->mood > 0) {
            $response['mood'] = $measurement->mood;
        }
        if ($measurement->hunger > 0) {
            $response['hunger'] = $measurement->hunger;
        }
        if ($measurement->sleep > 0) {
            $response['sleep'] = $measurement->sleep;
        }

        if ($updated) {
            $response['updated'] = true;
        }

        return $response;
    }

    private function toolResult(string $tool, array $payload): string
    {
        return json_encode($payload);
    }
}
