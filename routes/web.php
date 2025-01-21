<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\QuestionEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('event.index');
Route::get('private-file/{filename}', [FileController::class, 'getPrivateFile'])->name('private.file');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('events', EventController::class);

    Route::get('events/{event}/questions/create', [QuestionEventController::class, 'create'])->name('events.questions.create');
    Route::post('events/{event}/questions', [QuestionEventController::class, 'store'])->name('events.questions.store');
    Route::put('questions/{question}', [QuestionEventController::class, 'update'])->name('events.questions.update');
    Route::delete('questions/{question}', [QuestionEventController::class, 'destroy'])->name('events.questions.destroy');

    // Route::get('events/create/step-1', [EventController::class, 'createStep1'])->name('events.create.step1');
    // Route::get('events/{event}/edit/step-1', [EventController::class, 'editStep1'])->name('events.edit.step1');
    // Route::get('events/{event}/questions/create/step-2', [QuestionEventController::class, 'create'])->name('events.questions.create.step2');
    // Route::get('events/{event}/active/step-3', [EventController::class, 'status'])->name('events.status.step3');


    Route::get('events/{event}/active', [EventController::class, 'status'])->name('events.status');
    Route::put('events/{event}/active', [EventController::class, 'activateEvent'])->name('events.active');
    Route::post('events/{event}/join', [EventController::class, 'join'])->name('events.join');

    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.my');
    Route::get('/event/{event}/volunteers', [EventController::class, 'eventVolunteers'])->name('events.volunteers');
    Route::get('/event/{event}/register', [EventController::class, 'eventRegister'])->name('events.register');
    Route::patch('/events/{event}/review', [ReviewController::class, 'updateEventReview'])->name('events.review.update');
    Route::patch('events/{event}/volunteers/{volunteer}/review', [ReviewController::class, 'updateVolunteerReview'])->name('volunteer.review.update');
});



require __DIR__ . '/auth.php';
