<?php

use App\Http\Controllers\ProductController;
use App\Livewire\CreateRecipe;
use App\Livewire\Diary;
use App\Livewire\Personal;
use App\Livewire\ProductIndex;
use App\Livewire\Statistic;
use App\Livewire\UpdateRecipe;
use Illuminate\Support\Facades\Route;

Route::middleware([\App\Http\Middleware\SetLocale::class])->group(function () {

    Route::view('/', 'welcome');

    Route::get('dashboard', Diary::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('statistic', Statistic::class)
        ->middleware(['auth', 'verified'])
        ->name('statistic');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

    Route::get('switch-language/{lang}', function ($lang) {
        session(['locale' => $lang]);
        return redirect()->back();
    })->name('switch-language');

    require __DIR__ . '/auth.php';

    Route::name('product.')->group(function () {
        Route::get('products', ProductIndex::class)->name('index');
        Route::get('/create-product',  [ProductController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
        Route::get('/product/{product}', [ProductController::class, 'show'])->name('show');
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
    Route::get('/blog', function () {
        return view('blog.index');
    })->name('blog');
});