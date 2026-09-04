<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;


Route::get('/', [ProjectController::class, 'index']);

Route::get('/projects/create',[ProjectController::class, 'createProject'])->name('project.create');

Route::post('/projects',[ProjectController::class, 'storeProject'])->name('project.store');

Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/logs/create', [ProjectController::class, 'createLog'])->name('logs.create');

Route::get('/logs/{id}', [ProjectController::class, 'showLog'])->name('logs.show');

Route::get('/logs/{id}/edit', [ProjectController::class, 'editLog'])->name('logs.edit');

Route::post('/logs/{id}/update', [ProjectController::class, 'updateLog'])->name('logs.update');

Route::post('/logs/{id}/delete', [ProjectController::class, 'deleteLog'])->name('logs.delete');



Route::get("/create",[ProjectController::class, 'create']);

Route::get("/modfiy",[ProjectController::class, 'modify']);

Route::post("/delete",[ProjectController::class,'delete']);


