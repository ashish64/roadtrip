<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\V1\SuggestionController;
use App\Http\Controllers\V1\TripController;
use App\Http\Controllers\VoteController;
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

    // Ungated
    Route::get('trips/create', [TripController::class, 'create'])->name('trips.create');
    Route::post('trips', [TripController::class, 'store'])->name('trips.store');

    //  They can view trip assigned to them
    Route::middleware('can:view,trip')->group(function () {
        Route::get('trips/{trip}/', [TripController::class, 'show'])->name('trips.show');
        Route::resource('trips.suggestions', SuggestionController::class)->only(['store']);

    });
    //
    Route::middleware('can:view,suggestion.trip')->group(function () {
        Route::get('/suggestions/{suggestion}/status', [SuggestionController::class, 'status'])->name('suggestions.status');
        Route::get('/suggestions/{suggestion}/vote', [VoteController::class, 'vote'])->name('suggestions.vote');
    });

    //  They can update the trips
    Route::middleware('can:update,trip')->group(function () {
        Route::get('trips/{trip}/edit', [TripController::class, 'edit'])->name('trips.edit');
        Route::put('trips/{trip}', [TripController::class, 'update'])->name('trips.update');
    });

});

require __DIR__.'/auth.php';
