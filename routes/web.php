<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::get('/projects/create', [ProjectController::class, 'createProject'])->name('project.create');

Route::post('/projects', [ProjectController::class, 'storeProject'])->name('project.store');

Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/projects/{project}/logs/create', [ProjectController::class, 'createLog'])->name('logs.create');

Route::post('/projects/{project}/logs', [ProjectController::class, 'storeLog'])->name('logs.store');

Route::get('/logs/{id}', [ProjectController::class, 'showLog'])->name('logs.show');

Route::get('/logs/{id}/edit', [ProjectController::class, 'editLog'])->name('logs.edit');

Route::post('/logs/{id}/update', [ProjectController::class, 'updateLog'])->name('logs.update');

Route::post('/logs/{id}/delete', [ProjectController::class, 'deleteLog'])->name('logs.delete');

Route::get('/create', [ProjectController::class, 'create']);

Route::get('/modfiy', [ProjectController::class, 'modify']);

Route::post('/delete', [ProjectController::class, 'delete']);
