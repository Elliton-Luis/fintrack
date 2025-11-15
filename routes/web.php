<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return Inertia::render('Dashboard');
});

Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transaction.store');

Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');
