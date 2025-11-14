<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');A

// Dashboard routes: hanya bisa diakses user login
Route::middleware(['auth', LogVisitor::class])->group(function () {

    // Pintu tunggal dashboard, mengarahkan sesuai role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Halaman khusus per role
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dosen/dashboard', [DashboardController::class, 'dosen'])->name('dashboard.dosen');
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'user'])->name('dashboard.user');
});

