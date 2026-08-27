<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index']);


Route::get("/create",[ProjectController::class, 'create']);

Route::get("/modfiy",[ProjectController::class, 'modify']);

Route::post("/delete",[ProjectController::class,'delete'];


