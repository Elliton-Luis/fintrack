<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\TransactionController;

Route::get('/dashboard', [TransactionController::class, 'dashboard'])->name('dashboard');

Route::get('/transactions', [TransactionController::class, 'transactions'])->name('transactions.index');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');
