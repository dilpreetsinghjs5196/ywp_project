<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('com')->group(function () {
    Route::get('/', function () {
        return view('site.com.home');
    });
});

Route::prefix('in')->group(function () {
    Route::get('/', function () {
        return view('site.in.home');
    });
});