<?php

use Illuminate\Support\Facades\Route;

// welcome page
Route::get('/', function () {
    return view('welcome');
});

// login page
Route::get("/login", function(){
    return view('login');
});

// register page
Route::get("/register", function(){
    return view('register');
});

// dashboard
Route::get("/dashboard", function(){
    return view('dashboard');
});
