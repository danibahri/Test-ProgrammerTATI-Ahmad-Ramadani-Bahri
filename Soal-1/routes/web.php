<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DailyLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return view('errors.404');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('profile');

    // Daily Log CRUD
    Route::resource('daily-log', DailyLogController::class);

    // Daily Log Verification (for supervisors)
    Route::get('/daily-log-verification', [DailyLogController::class, 'verification'])->name('daily-log.verification');
    Route::patch('/daily-log/{dailyLog}/verify', [DailyLogController::class, 'verify'])->name('daily-log.verify');
});
