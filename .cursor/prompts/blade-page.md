# Creating Blade Pages

## Standard Page with App Layout

```blade
<x-app-layout>
    @section('title', __('Page Title'))

    @section('meta')
        <meta name="description" content="{{ __('Page description for SEO') }}">
        <meta name="keywords" content="{{ __('keyword1, keyword2, keyword3') }}">
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Content --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```

## Blog Article Template

```blade
<x-app-layout>
    @section('title', __('Article Title'))

    @section('meta')
        <meta name="description" content="{{ __('Article description') }}">
        <meta name="keywords" content="{{ __('keywords') }}">
    @endsection

    <article class="container mx-auto py-8 px-4" data-aos="fade-up">
        <a href="{{ route('blog') }}" class="text-amber-700 hover:underline mb-4 inline-block">
            ← {{ __('Back to Blog') }}
        </a>

        <h1 class="text-4xl md:text-5xl font-bold mb-8 text-amber-900">
            {{ __('Article Title') }}
        </h1>

        <div class="prose prose-lg max-w-none">
            {{-- Article content --}}
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('register') }}"
               class="bg-amber-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-amber-800 transition-colors">
                {{ __('Register Now') }}
            </a>
        </div>
    </article>
</x-app-layout>
```

## UI Components Used

### Cards
```blade
<div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow">
    <h3 class="text-xl font-semibold mb-3 text-amber-800">
        <i class="fa-solid fa-icon mr-2"></i>
        {{ __('Card Title') }}
    </h3>
    <p class="text-gray-700 leading-relaxed">
        {{ __('Card content') }}
    </p>
</div>
```

### Buttons
```blade
{{-- Primary --}}
<x-primary-button>{{ __('Submit') }}</x-primary-button>

{{-- Link styled as button --}}
<a href="{{ route('name') }}"
   class="bg-amber-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-amber-800 transition-colors">
    {{ __('Action') }}
</a>
```

### Form Inputs
```blade
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">
        {{ __('Label') }}
    </label>
    <input type="text" wire:model="field"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                  focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    <x-input-error :messages="$errors->get('field')" class="mt-2" />
</div>
```

### Section with AOS Animation
```blade
<section class="container mx-auto px-4 py-8" data-aos="fade-up" data-aos-delay="100">
    <h2 class="text-4xl font-bold text-center mb-12 text-amber-900">
        {{ __('Section Title') }}
    </h2>
    {{-- Content --}}
</section>
```

## Routing

Add to `routes/web.php`:
```php
Route::get('/path', function () {
    return view('pages.page-name');
})->name('page-name');
```

