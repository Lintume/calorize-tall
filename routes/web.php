<?php

use App\Http\Controllers\ProductController;
use App\Livewire\CreateRecipe;
use App\Livewire\Diary;
use App\Livewire\Personal;
use App\Livewire\ProductIndex;
use App\Livewire\Statistic;
use App\Livewire\UpdateRecipe;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

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

    require __DIR__ . '/auth.php';

    Route::name('product.')->group(function () {
        Route::get('products', ProductIndex::class)->name('index');
        Route::get('/create-product',  [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
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

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });
});

