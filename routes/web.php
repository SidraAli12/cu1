<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


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
