<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// welcome page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// login page
Route::get("/login", [LoginController::class, 'index'])->name('login');
Route::post("/login", [LoginController::class, 'login'])->name('login.authenticate');
Route::post("/logout", [LoginController::class, 'logout'])->name('login.logout');

// register page
Route::get("/register", [RegisterController::class, 'index'])->name('register.index');
Route::post("/register", [RegisterController::class, 'store'])->name('register.store');

// dashboard
Route::get("/transactions", [TransactionController::class, 'index'])->middleware('auth')->name('transactions.index');
Route::get("/transactions/create", [TransactionController::class, 'create'])->middleware('auth')->name('transactions.create');
Route::post("/transactions/store", [TransactionController::class, 'store'])->middleware('auth')->name('transactions.store');
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->middleware('auth')->name('transactions.edit');
Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->middleware('auth')->name('transactions.update');
Route::delete("/transactions/{transaction}", [TransactionController::class, 'destroy'])->middleware('auth')->name('transactions.destroy');

