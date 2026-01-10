<?php

use App\Http\Controllers\ProductController;
use App\Livewire\CreateRecipe;
use App\Livewire\Diary;
use App\Livewire\FeedbackIndex;
use App\Livewire\Personal;
use App\Livewire\ProductIndex;
use App\Livewire\Statistic;
use App\Livewire\UpdateRecipe;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Livewire update endpoint must be locale-agnostic.
// Otherwise, switching locale (especially with SPA navigation) can leave the frontend
// posting to the previous locale-prefixed endpoint and result in 404s.
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

// IMPORTANT: Livewire (v3) re-applies "persistent middleware" based on the original page route.
// If we register localized routes based on the *current* request path (e.g. `/livewire/update`),
// the locale prefix may default and Livewire will fail to match the original route (e.g. `en/diary`)
// causing a 404 during updates. For Livewire requests, derive locale from the Referer URL.
$localePrefix = LaravelLocalization::setLocale();
if (request()->is('livewire/*')) {
    $refererPath = parse_url(request()->headers->get('referer', ''), PHP_URL_PATH) ?: '';
    $firstSegment = explode('/', trim($refererPath, '/'))[0] ?? null;

    if ($firstSegment && array_key_exists($firstSegment, config('laravellocalization.supportedLocales', []))) {
        $localePrefix = LaravelLocalization::setLocale($firstSegment);
    }
}

Route::group(['prefix' => $localePrefix], function () {

    Route::view('/', 'pages.landing');

    Route::get('dashboard', Diary::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('statistic', Statistic::class)
        ->middleware(['auth', 'verified'])
        ->name('statistic');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

    require __DIR__.'/auth.php';

    Route::name('product.')->group(function () {
        Route::get('products', ProductIndex::class)->name('index');
        Route::get('/create-product', [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
        Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('show');
        Route::post('/product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('store');
        Route::put('/product/{product}', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('update');
        Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit');
    });

    Route::name('recipe.')->group(function () {
        Route::get('recipes', ProductIndex::class)->middleware(['auth', 'verified'])->name('index');
        Route::get('/create-recipe', CreateRecipe::class)->middleware(['auth', 'verified'])->name('create');
        Route::get('/edit-recipe/{product}', UpdateRecipe::class)->middleware(['auth', 'verified'])->name('edit');
    });

    Route::get('/diary', Diary::class)->middleware(['auth', 'verified'])->name('diary');

    Route::get('/personal', Personal::class)->middleware(['auth', 'verified'])->name('personal');

    Route::get('/feedback', FeedbackIndex::class)->middleware(['auth', 'verified'])->name('feedback');

    Route::get('/blog/yak-pravylno-rakhuvaty-kaloriyi-dlya-skhudnennya-praktychnyy-gid', function () {
        return view('blog.blog-1');
    })->name('blog-1');
    Route::get('/blog/5-porad-dlya-efektyvnoho-skhudnennya', function () {
        return view('blog.blog-2');
    })->name('blog-2');
    Route::get('/blog/top-10-produktiv-dlya-zdorovoho-kharchuvannya', function () {
        return view('blog.blog-3');
    })->name('blog-3');
    Route::get('/blog/chomu-voda-vazhlyva-dlya-skhudnennya', function () {
        return view('blog.blog-4');
    })->name('blog-4');
    Route::get('/blog', function () {
        return view('blog.index');
    })->name('blog');

    Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

    Route::get('/privacy', function () {
        return view('pages.privacy');
    })->name('privacy');
});
