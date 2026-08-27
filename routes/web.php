<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get("/create",function () {
    return view("create");
});

Route::get("/modfiy",function () {
    return view("modify");
});

Route::post("/delete",function () {
    return view("delete");
});
