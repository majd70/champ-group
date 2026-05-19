<?php

use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Locale switcher — sets the chosen locale in the session and redirects back
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])
    ->name('locale.switch');
