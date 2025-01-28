<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\QuestionEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('event.index');
Route::post('events/nearest', [EventController::class, 'nearest'])->name('events.nearest');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('events', EventController::class);

    Route::get('events/{event}/questions/create', [QuestionEventController::class, 'create'])->name('events.questions.create');
    Route::get('events/{event}/questions/edit', [QuestionEventController::class, 'edit'])->name('events.questions.edit');
    Route::post('events/{event}/questions', [QuestionEventController::class, 'store'])->name('events.questions.store');
    Route::put('questions/{question}', [QuestionEventController::class, 'update'])->name('events.questions.update');
    Route::delete('questions/{question}', [QuestionEventController::class, 'destroy'])->name('events.questions.destroy');

    Route::get('events/{event}/answer/create', [QuestionEventController::class, 'createAnswer'])->name('events.answer.create');
    Route::post('events/{event}/answer', [QuestionEventController::class, 'storeAnswer'])->name('events.answer.store');

    // Route::get('events/create/step-1', [EventController::class, 'createStep1'])->name('events.create.step1');
    // Route::get('events/{event}/edit/step-1', [EventController::class, 'editStep1'])->name('events.edit.step1');
    // Route::get('events/{event}/questions/create/step-2', [QuestionEventController::class, 'create'])->name('events.questions.create.step2');
    // Route::get('events/{event}/active/step-3', [EventController::class, 'status'])->name('events.status.step3');


    Route::get('events/{event}/active', [EventController::class, 'status'])->name('events.status');
    Route::put('events/{event}/active', [EventController::class, 'activateEvent'])->name('events.active');

    Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.my');
    Route::get('/event/{event}/volunteers', [EventController::class, 'eventVolunteers'])->name('events.volunteers');
    Route::get('/event/{event}/register', [EventController::class, 'eventRegister'])->name('events.register');
    Route::get('/event/{event}/register/{user}', [EventController::class, 'eventRegisterDetail'])->name('events.register.show');
    Route::put('/event/{event}/register/{user}', [EventController::class, 'acceptanceStatus'])->name('events.register.update');
    Route::patch('/events/{event}/review', [ReviewController::class, 'updateEventReview'])->name('events.review.update');
    Route::patch('events/{event}/volunteers/{volunteer}/review', [ReviewController::class, 'updateVolunteerReview'])->name('volunteer.review.update');
});



require __DIR__ . '/auth.php';
