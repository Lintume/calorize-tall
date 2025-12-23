# New Livewire Component

When creating a new Livewire component for Calorize, follow these patterns:

## Component Class Template

```php
<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ComponentName extends Component
{
    #[Validate('required|string|max:255')]
    public string $property;

    public function mount(): void
    {
        // Initialize state
    }

    public function updatedProperty($value): void
    {
        // React to property changes
        try {
            $this->validateOnly('property');
        } catch (ValidationException $e) {
            $this->reset('property');
            return;
        }
        // Additional logic
    }

    public function save(): void
    {
        $this->validate();
        
        // Persist data
        
        $this->dispatch('success', __('Data saved successfully!'));
    }

    public function render()
    {
        return view('livewire.component-name');
    }
}
```

## Blade View Template

```blade
<div x-data="componentName()" x-cloak>
    {{-- Success message --}}
    <div x-show="successMessage" x-text="successMessage" 
         class="mt-4 bg-green-600 text-white p-2 rounded mb-4"></div>

    {{-- Error display --}}
    <div class="text-red-600">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>

    {{-- Form content --}}
    <form wire:submit="save">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                {{ __('Label') }}
            </label>
            <input type="text" wire:model="property"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                          focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <x-input-error :messages="$errors->get('property')" class="mt-2" />
        </div>

        <x-primary-button type="submit">
            {{ __('Save') }}
        </x-primary-button>
    </form>

    <x-loading-screen/>
</div>

<script>
function componentName() {
    return {
        successMessage: '',
        
        init() {
            this.$wire.on('success', message => {
                this.successMessage = message;
                setTimeout(() => {
                    this.successMessage = '';
                }, 3000);
            });
        }
    }
}
</script>
```

## Registration

No manual registration needed - Livewire auto-discovers components.

## Routing

Add route in `routes/web.php`:

```php
Route::get('/path', ComponentName::class)
    ->middleware(['auth', 'verified'])
    ->name('component.name');
```

