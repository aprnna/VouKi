<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('event.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('events', EventController::class);
    Route::post('events/{event}/join', [EventController::class, 'join'])->name('events.join');
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.my');
    Route::get('/event/{event}/volunteers', [EventController::class, 'eventVolunteers'])->name('events.volunteers');
    Route::post('/events/{event}/review', [ReviewController::class, 'store'])->name('events.review.store');
});



require __DIR__ . '/auth.php';
