<?php

use App\Http\Controllers\com\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Front-end routes
Route::get('/', [HomeController::class, 'home'])->name('com.home');
Route::get('/about', [HomeController::class, 'about'])->name('com.about');
Route::get('/team', [HomeController::class, 'team'])->name('com.team');
Route::get('/team/{id}', [HomeController::class, 'teamSingle'])->name('com.team.single');

// Admin Panel Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Page Content Management
    Route::get('/pages/{slug}', [\App\Http\Controllers\Admin\AdminPageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/pages/{slug}', [\App\Http\Controllers\Admin\AdminPageController::class, 'update'])->name('admin.pages.update');

    // Services Management
    Route::resource('services', \App\Http\Controllers\Admin\AdminServiceController::class, ['as' => 'admin']);

    // Team Management
    Route::resource('teams', \App\Http\Controllers\Admin\AdminTeamController::class, ['as' => 'admin']);

    // Testimonial Management
    Route::resource('testimonials', \App\Http\Controllers\Admin\AdminTestimonialController::class, ['as' => 'admin']);

    // Global Settings
    Route::get('/settings/branding', [\App\Http\Controllers\Admin\AdminSettingController::class, 'branding'])->name('admin.settings.branding');
    Route::get('/settings/contact', [\App\Http\Controllers\Admin\AdminSettingController::class, 'contact'])->name('admin.settings.contact');
    Route::post('/settings/update', [\App\Http\Controllers\Admin\AdminSettingController::class, 'update'])->name('admin.settings.update');
});
