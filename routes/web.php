<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Guests may browse projects and logs; only authenticated users can create or modify them.
Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'createProject'])->name('project.create');

    Route::post('/projects', [ProjectController::class, 'storeProject'])->name('project.store');

    Route::get('/projects/{project}/logs/create', [ProjectController::class, 'createLog'])->name('logs.create');

    Route::post('/projects/{project}/logs', [ProjectController::class, 'storeLog'])->name('logs.store');

    Route::get('/logs/{id}/edit', [ProjectController::class, 'editLog'])->name('logs.edit');

    Route::post('/logs/{id}/update', [ProjectController::class, 'updateLog'])->name('logs.update');

    Route::post('/logs/{id}/delete', [ProjectController::class, 'deleteLog'])->name('logs.delete');
});

Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show')->whereNumber('id');

Route::get('/logs/{id}', [ProjectController::class, 'showLog'])->name('logs.show')->whereNumber('id');

Route::get('/create', [ProjectController::class, 'create']);

Route::get('/modfiy', [ProjectController::class, 'modify']);

Route::post('/delete', [ProjectController::class, 'delete']);
