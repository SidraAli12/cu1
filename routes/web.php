<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetpasswordController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;




Route::get('/', function () {
    return view('welcome');
});



// Auth routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');


Route::get('/login', [loginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Route::get('/reset-password', function () {
//     return view('auth.resetpassword');
// })->name('password.reset');

Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::middleware(['auth'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
});


Route::get('/courses/topics', [TopicController::class, 'index'])->name('topics.index');
    Route::post('/courses/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::put('/courses/topics/{id}', [TopicController::class, 'update'])->name('topics.update');
    Route::delete('/courses/topics/{id}', [TopicController::class, 'destroy'])->name('topics.destroy');