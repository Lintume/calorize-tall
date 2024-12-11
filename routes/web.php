<?php

use App\Http\Controllers\ProductController;
use App\Livewire\CreateRecipe;
use App\Livewire\ProductIndex;
use App\Livewire\Statistic;
use Illuminate\Support\Facades\Route;

Route::middleware([\App\Http\Middleware\SetLocale::class])->group(function () {

    Route::view('/', 'welcome');

    Route::get('dashboard', Statistic::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

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
//        Route::get('/product/{product}', [ProductController::class, 'show'])->name('show');
//        Route::post('/recipe', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('store');
//        Route::put('/product/{product}', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('update');
//        Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit');
    });


//Route::view('/edit-product/{id}', 'products.edit')->name('products.edit');
//Route::post('/update-product/{id}', 'ProductController@update')->name('updateProduct');
//Route::post('/delete-product', 'ProductController@destroy')->name('deleteProduct');
//
//    Route::get('/recipes', 'RecipeController@index')->name('recipes');
//    Route::get('/create-recipe', 'RecipeController@create')->name('createRecipe');
//Route::get('/edit-recipe/{id}', 'RecipeController@edit')->name('editRecipe');
//Route::post('/save-recipe', 'RecipeController@store')->name('saveRecipe');
//Route::post('/update-recipe', 'RecipeController@update')->name('updateRecipe');
//Route::post('/delete-recipe', 'RecipeController@destroy')->name('deleteRecipe');
//
    Route::get('/diary', 'DiaryController@index')->name('diary');
//Route::post('/diary-store', 'DiaryController@store')->name('diaryStore');
//
//Route::get('/locale/{locale}', 'LanguageController@locale')->name('locale');
//
//Route::get('/measurement', 'MeasurementController@create')->name('measurement');
//Route::post('/save-measurement', 'MeasurementController@store')->name('saveMeasurement');
//
    Route::get('/personal', 'UserController@index')->name('personal');
//Route::post('/personal', 'UserController@store');
//
//    Route::get('/statistic', 'StatisticController@index')->name('statistic');
//Route::post('/statistic', 'StatisticController@getData');
});