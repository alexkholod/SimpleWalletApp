<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\CostController::class, 'makeMainView'])
        ->name('home');

    Route::get('/add-cost', [App\Http\Controllers\CostController::class, 'makeAddView'])
        ->name('add-cost');

    Route::post('/add-cost', [App\Http\Controllers\CostController::class, 'add'])
        ->name('added');


    Route::post('/cost/{id}-{year}-{month}/edit', [App\Http\Controllers\CostController::class, 'update'])
        ->name('updated');

    Route::get('/cost/{id}-{year}-{month}/edit', [App\Http\Controllers\CostController::class, 'viewSingleCost'])
        ->name('updateCost');


    Route::post('/costs', [App\Http\Controllers\CostController::class, 'makeAllCostsView'])
        ->name('costsPerMonth');

    Route::get('/costs', [App\Http\Controllers\CostController::class, 'makeAllCostsView'])
        ->name('costs');



    Route::post('/delete-cost/deleted/{id}', [App\Http\Controllers\CostController::class, 'delete'])
        ->name('deleted');

    Route::get('/settings/wallets', [App\Http\Controllers\WalletController::class, 'allWallets'])
        ->name('wallets');

    Route::get('/settings/categories', [App\Http\Controllers\CategoryController::class, 'allCategories'])
        ->name('categories');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

Route::middleware('guest')->group(function (){
});

