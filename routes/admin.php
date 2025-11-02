<?php

use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return redirect()->route('admin.movies.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    //admin.movie
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies/create', [MovieController::class, 'store'])->name('movies.store');

    Route::get('/movies', [MovieController::class, 'getAllMovies'])->name('movies.index');

    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');

    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

    //admin.tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags/create', [TagController::class, 'store'])->name('tags.store');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    //admin.person
    Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
    Route::get('/persons/{person}/edit', [PersonController::class, 'edit'])->name('persons.edit');
    Route::put('/persons/{person}', [PersonController::class, 'update'])->name('persons.update');
    Route::delete('/persons/{person}', [PersonController::class, 'destroy'])->name('persons.destroy');
});

//admin.login|registration
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});
