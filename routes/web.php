<?php

use App\Http\Controllers\com\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Front-end routes
Route::get('/', [HomeController::class, 'home'])->name('com.home');
Route::get('/about', [HomeController::class, 'about'])->name('com.about');
Route::get('/team', [\App\Http\Controllers\com\HomeController::class, 'team'])->name('com.team');
Route::get('/team/{id}', [\App\Http\Controllers\com\HomeController::class, 'teamSingle'])->name('com.team.single');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('com.contact');
Route::post('/appointment/submit', [HomeController::class, 'submitAppointment'])->name('com.appointment.submit');
Route::get('/corporate-well-being', [\App\Http\Controllers\com\HomeController::class, 'corporateWellBeing'])->name('com.corporate');
Route::get('/wonder-store', [\App\Http\Controllers\com\WonderStoreController::class, 'index'])->name('com.store');

// Cart Routes
Route::get('/cart', [\App\Http\Controllers\com\CartController::class, 'index'])->name('com.cart');
Route::post('/cart/add/{id}', [\App\Http\Controllers\com\CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [\App\Http\Controllers\com\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [\App\Http\Controllers\com\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [\App\Http\Controllers\com\CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/checkout', [\App\Http\Controllers\com\CartController::class, 'checkout'])->name('com.checkout');
Route::post('/checkout/process', [\App\Http\Controllers\com\CartController::class, 'processCheckout'])->name('com.checkout.process');
Route::post('/login/ajax', [\App\Http\Controllers\com\CartController::class, 'loginAjax'])->name('login.ajax');
Route::post('/cart/check-email', [\App\Http\Controllers\com\CartController::class, 'checkEmail'])->name('cart.check-email');
Route::post('/razorpay/verify', [\App\Http\Controllers\com\CartController::class, 'verifyPayment'])->name('razorpay.verify');
Route::get('/order-success/{id}', [\App\Http\Controllers\com\CartController::class, 'orderSuccess'])->name('com.order.success');

// Authentication Routes
Route::get('/login', [\App\Http\Controllers\com\AuthController::class, 'showLogin'])->name('com.login');
Route::post('/login', [\App\Http\Controllers\com\AuthController::class, 'login']);
Route::get('/register', [\App\Http\Controllers\com\AuthController::class, 'showRegister'])->name('com.register');
Route::post('/register', [\App\Http\Controllers\com\AuthController::class, 'register']);
Route::get('/logout', [\App\Http\Controllers\com\AuthController::class, 'logout'])->name('com.logout');

// User Profile Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\com\ProfileController::class, 'index'])->name('com.profile');
    Route::post('/profile/update', [\App\Http\Controllers\com\ProfileController::class, 'update'])->name('com.profile.update');
});

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

    // Wonder Store Management
    Route::resource('wonder-store-categories', \App\Http\Controllers\Admin\AdminWonderStoreCategoryController::class, ['as' => 'admin']);
    Route::resource('wonder-store-products', \App\Http\Controllers\Admin\AdminWonderStoreProductController::class, ['as' => 'admin']);

    // Testimonial Management
    Route::resource('testimonials', \App\Http\Controllers\Admin\AdminTestimonialController::class, ['as' => 'admin']);

    // Brand Management
    Route::resource('brands', \App\Http\Controllers\Admin\AdminBrandController::class, ['as' => 'admin']);

    // Appointment Queries
    Route::resource('appointments', \App\Http\Controllers\Admin\AdminAppointmentController::class, ['as' => 'admin'])->only(['index', 'show', 'update', 'destroy']);

    // Global Settings
    Route::get('/settings/branding', [\App\Http\Controllers\Admin\AdminSettingController::class, 'branding'])->name('admin.settings.branding');
    Route::get('/settings/contact', [\App\Http\Controllers\Admin\AdminSettingController::class, 'contact'])->name('admin.settings.contact');
    Route::get('/settings/mail', [\App\Http\Controllers\Admin\AdminSettingController::class, 'mail'])->name('admin.settings.mail');
    Route::post('/settings/update', [\App\Http\Controllers\Admin\AdminSettingController::class, 'update'])->name('admin.settings.update');
});
