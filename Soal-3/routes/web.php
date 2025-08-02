<?php

use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KinerjaController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/kinerja', [KinerjaController::class, 'predikat_kinerja']);
