<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// // Admin-only route
// Route::get('/admin/dashboard', function () {
//     return 'Welcome Admin!';
// })->middleware('role:admin');

// // Teacher-only route
// Route::get('/teacher/dashboard', function () {
//     return 'Welcome Teacher!';
// })->middleware('role:teacher');

// // Student-only route
// Route::get('/student/dashboard', function () {
//     return 'Welcome Student!';
// })->middleware('role:student');



// Auth routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [loginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');