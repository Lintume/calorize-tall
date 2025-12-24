<?php

namespace App\Services\DiaryAgent;

class DiaryAgentResult
{
    public function __construct(
        public readonly string $message,
        public readonly array $actions,
        public readonly bool $success,
        public readonly ?string $error = null
    ) {}

    /**
     * Get a summary of actions performed
     */
    public function getActionsSummary(): array
    {
        $summary = [];

        foreach ($this->actions as $action) {
            $result = is_string($action['result'])
                ? json_decode($action['result'], true)
                : $action['result'];

            $summary[] = [
                'tool' => $action['tool'],
                'success' => $result['success'] ?? ($result['found'] ?? false),
                'message' => $result['message'] ?? '',
            ];
        }

        return $summary;
    }

    /**
     * Check if any product was added
     */
    public function hasAdditions(): bool
    {
        foreach ($this->actions as $action) {
            if ($action['tool'] === 'addToFoodIntake') {
                $result = json_decode($action['result'], true);
                if ($result['success'] ?? false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if any product was deleted
     */
    public function hasDeletions(): bool
    {
        foreach ($this->actions as $action) {
            if ($action['tool'] === 'deleteFoodIntake') {
                $result = json_decode($action['result'], true);
                if ($result['success'] ?? false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if any product was updated
     */
    public function hasUpdates(): bool
    {
        foreach ($this->actions as $action) {
            if ($action['tool'] === 'updateFoodIntake') {
                $result = json_decode($action['result'], true);
                if ($result['success'] ?? false) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if diary was modified in any way
     */
    public function hasDiaryChanges(): bool
    {
        return $this->hasAdditions() || $this->hasDeletions() || $this->hasUpdates();
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'actions' => $this->actions,
            'success' => $this->success,
            'error' => $this->error,
            'hasDiaryChanges' => $this->hasDiaryChanges(),
        ];
    }
}

