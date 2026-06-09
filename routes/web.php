<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Stories (Instagram-style highlights) — ordered JSON feed for the viewer
Route::get('/api/stories', [StoryController::class, 'index'])->name('stories.index');

// Locale switcher — sets the chosen locale in the session and redirects back
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])
    ->name('locale.switch');
