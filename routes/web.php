<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// welcome page
    Route::get('/', function () {
        return view('welcome');
    })->middleware('redirectIfAuthenticated')->name('home');

// auth
Route::middleware('guest')->group(function(){
    Route::get("/login", [LoginController::class, 'index'])->name('login');
    Route::post("/login", [LoginController::class, 'login'])->name('login.authenticate');

    Route::get("/register", [RegisterController::class, 'index'])->name('register.index');
    Route::post("/register", [RegisterController::class, 'store'])->name('register.store');
});
Route::post("/logout", [LoginController::class, 'logout'])->name('login.logout');

// transactions
Route::resource('transactions', TransactionController::class)->middleware('auth');

// user profile
Route::get('/user/{id}', [UserController::class, 'edit'])->middleware('auth')->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->middleware('auth')->name('user.update');