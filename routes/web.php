<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/fff', [\App\Http\Controllers\HomeController::class, 'index']);
