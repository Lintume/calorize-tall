<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//
//Route::get('/ingredients', 'ProductController@index')->name('home');
//Route::get('/create-product', 'ProductController@create')->name('createProduct');
//Route::post('/save-product', 'ProductController@store')->name('saveProduct');
//Route::get('/edit-product/{id}', 'ProductController@edit')->name('editProduct');
//Route::post('/update-product/{id}', 'ProductController@update')->name('updateProduct');
//Route::post('/delete-product', 'ProductController@destroy')->name('deleteProduct');
//
//Route::get('/recipes', 'RecipeController@index')->name('recipes');
//Route::get('/create-recipe', 'RecipeController@create')->name('createRecipe');
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
Route::get('/statistic', 'StatisticController@index')->name('statistic');
//Route::post('/statistic', 'StatisticController@getData');