<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/sales/create/{id?}', [SalesController::class, 'createOrEdit'])->name('sales.createOrEdit');
    Route::post('/sales', [SalesController::class, 'storeOrUpdate'])->name('sales.storeOrUpdate');
    Route::put('/sales/{id}', [SalesController::class, 'storeOrUpdate'])->name('sales.storeOrUpdate');
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
    Route::put('/sales/{sale}', [SalesController::class, 'update'])->name('sales.update');
    
    
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');

    // Register Route

});
