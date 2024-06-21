<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'showMainPage'])->name('show-main-page');
Route::get('/register', [PagesController::class, 'showRegisterPage'])->name('show-register-page');
Route::get('/login', [PagesController::class, 'showLoginPage'])->name('show-login-page');

