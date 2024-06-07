<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\GorBoenController;

// API REQUEST
Route::post("/login", [App\Http\Controllers\UserAuthentication::class, "Login"])->name('login');
Route::post("/logout", [App\Http\Controllers\UserAuthentication::class, "LogOut"])->name('logout');
Route::post("/register", [App\Http\Controllers\UserAuthentication::class, "Register"])->name('register');


// BASE ROUTES
Route::get('/', function () {
    return view('pages.profile');
});

Route::get('/login', function () {
    return view('pages.auth.login');
});

Route::get('/register', function () {
    return view('pages.auth.register');
});

Route::get('/reset-password', function () {
    return view('pages.auth.reset-password');
});

Route::get('/forgot-password', function () {
    return view('pages.auth.forgot-password');
});

Route::prefix('/')->group(function () {
    Route::get('/user', function () {
        return view('pages.user.index');
    })->name('user.index');
    Route::resource('user', UserController::class);
});

Route::prefix('/')->group(function () {
    Route::get('/news', function () {
        return view('pages.news.index');
    })->name('news.index');
    Route::resource('news', NewsController::class);
});



Route::prefix('/')->group(function () {
    Route::get('/gorboen', function () {
        return view('pages.gorboen.index');
    })->name('gorboen.index');
    Route::resource('gorboen', GorBoenController::class);
});

Route::prefix('/')->group(function () {
    Route::get('/kebun', function () {
        return view('pages.kebun.index');
    })->name('kebun.index');
    Route::resource('kebun', KebunController::class);
});



