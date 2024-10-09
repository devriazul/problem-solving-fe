<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SearchController;

Route::get('/', [RegistrationController::class, 'create']);
Route::post('/register', [RegistrationController::class, 'store']);
Route::get('/search', [SearchController::class, 'index']);
Route::post('/search', [SearchController::class, 'search']);

