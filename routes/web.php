<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    CafeController, 
    HomeController, 
    JambukaController,
    FasilitasController, 
    HargamenuController,
    TempatparkirController, 
    KapasitasruangController
};

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/hasil', 'hasil')->name('home.hasil');
    Route::get('/cafe/{id}', 'cafe')->name('home.cafe');

    Route::get('/search', 'search')->name('cafe.search');
    
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Require Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    
    // Admin Resource Routes
    Route::resource('cafe', CafeController::class);
    Route::resource('fasilitas', FasilitasController::class);
    Route::resource('harga_menu', HargamenuController::class);
    Route::resource('kapasitas_ruang', KapasitasruangController::class);
    Route::resource('tempat_parkir', TempatparkirController::class);
    Route::resource('jam_buka', JambukaController::class);
});