<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\DB;
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
Route::get("/dashboard", function(){
    return view('dashboard');
})->middleware('auth')->name('dashboard');
