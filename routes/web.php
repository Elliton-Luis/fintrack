<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware('guest')->group(function () {

    Route::inertia('/', 'Login')->name('login');
    Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');

});

Route::middleware('auth')->group(function () {

    Route::get('/transactions', [TransactionController::class, 'transactions'])->name('transactions.index');
    Route::get('/dashboard', [TransactionController::class, 'dashboard'])->name('dashboard');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});

