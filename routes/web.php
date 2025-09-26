<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\V1\SuggestionController;
use App\Http\Controllers\V1\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TripController::class, 'index'])->name('dashboard');
    Route::resource('trips', TripController::class)->except(['destroy']);
    Route::resource('trips.suggestions', SuggestionController::class)->only(['store']);
    Route::get('/suggestions/{suggestion}/vote', [SuggestionController::class, 'vote'])->name('suggestions.vote');
});

require __DIR__.'/auth.php';
