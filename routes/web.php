<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

// Ana sayfayı login sayfasına yönlendir
Route::get('/', function () {
    return redirect()->route('login');
});

// Login formunu göster
Route::get('/login', function () {
    return view('login');
})->name('login');

// Login işlemi (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register formunu göster
Route::get('/register', function () {
    return view('register');
})->name('register');

// Register işlemi (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Test amaçlı dashboard
Route::get('/dashboard', function () {
    return 'Giriş Başarılı!';
})->name('dashboard');

// Rol yönetimi
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::post('/roles/assign/{userId}', [RoleController::class, 'assignRole'])->name('roles.assign');
Route::post('/roles/remove/{userId}/{roleId}', [RoleController::class, 'removeRole'])->name('roles.remove');

// Kullanıcı listesi
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Çıkış işlemi
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', function () {
    return view('home');
})->name('home');
