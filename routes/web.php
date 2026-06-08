<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetectController;

Route::get('/', [DetectController::class, 'index']);
Route::post('/detect', [DetectController::class, 'detect']);