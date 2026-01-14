<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCreate extends Component
{
    public ProductForm $form;

    public bool $redirectOnSave = false;

    public bool $redirectOnCancel = false;

    public ?string $redirectUrl = null;

    public string $mode = 'create';

    public function mount(bool $redirectOnSave = false, bool $redirectOnCancel = false, ?string $redirectUrl = null): void
    {
        $this->redirectOnSave = $redirectOnSave;
        $this->redirectOnCancel = $redirectOnCancel;
        $this->redirectUrl = $redirectUrl ?? route('product.index');
    }

    #[On('search-updated')]
    public function searchUpdated(string $search): void
    {
        $this->form->title = $search;
    }

    public function save()
    {
        $this->authorize('create', Product::class);

        $validated = $this->validate();

        // search product with the same fields and user_id
        $productExists = Product::where('title', $validated['title'])
            ->where('proteins', $validated['proteins'])
            ->where('fats', $validated['fats'])
            ->where('carbohydrates', $validated['carbohydrates'])
            ->where('calories', $validated['calories'])
            ->where('user_id', Auth::id())
            ->first();

        if ($productExists) {
            $this->addError('title', __('Product already exists'));

            return;
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $product = $user->products()->create($validated);

        $this->form->reset();

        if ($this->redirectOnSave) {
            // Direct navigation for full-page create flow
            $this->redirect($this->redirectUrl, navigate: true);

            return;
        }

        $this->dispatch('productAdded', $product);
    }

    public function cancel(): void
    {
        if ($this->redirectOnCancel) {
            $this->redirect($this->redirectUrl, navigate: true);

            return;
        }

        $this->dispatch('productCreateCancelled');
    }

    public function render()
    {
        return view('livewire.product-form', [
            'mode' => $this->mode,
        ]);
    }
}
