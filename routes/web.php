<?php

use App\Http\Controllers\CurrencyConverterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportActualCurrenciesController;
use Illuminate\Support\Facades\Route;


Route::get('/actual-currencies', [ImportActualCurrenciesController::class, 'importActualCurrencies'])
    ->name('actual-currencies.importActualCurrencies');

Route::get('/', [HomeController::class, 'homePage'])->name('home.homePage');

Route::post('/convert', [CurrencyConverterController::class, 'convert'])->name('convert.convert');

