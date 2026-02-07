<?php

use App\Http\Controllers\com\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//fronted code pages
Route::get('/', [HomeController::class, 'home'])->name('com.home');
Route::get('/about', [HomeController::class, 'about'])->name('com.about');
