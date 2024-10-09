<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;

Route::get('/', [RegistrationController::class, 'create']);
Route::post('/register', [RegistrationController::class, 'store']);
Route::get('/search', [RegistrationController::class, 'index'])->name('search');
Route::post('/search', [RegistrationController::class, 'search'])->name('search.perform');


