<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetpasswordController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuestionController;


// Home
Route::get('/', function () {
    return view('welcome');
});


// Auth routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// Course CRUD
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');


// Topics under course
Route::get('/courses/topics', [TopicController::class, 'index'])->name('topics.index');
Route::post('/courses/topics', [TopicController::class, 'store'])->name('topics.store');
Route::put('/courses/topics/{id}', [TopicController::class, 'update'])->name('topics.update');
Route::delete('/courses/topics/{id}', [TopicController::class, 'destroy'])->name('topics.destroy');


// Chapters (auth required)
Route::middleware(['auth'])->group(function () {
    Route::get('/chapters', [ChapterController::class, 'index'])->name('chapters.index');
    Route::post('/chapters', [ChapterController::class, 'store'])->name('chapters.store');
    Route::put('/chapters/{id}', [ChapterController::class, 'update'])->name('chapters.update');
    Route::delete('/chapters/{id}', [ChapterController::class, 'destroy'])->name('chapters.destroy');
});


// -----------------------------
// QUIZZES + QUESTIONS + ATTEMPTS
// -----------------------------
Route::middleware(['auth'])->group(function () {

    // Quizzes CRUD
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quizzes/{id}', [QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');

    // Questions inside quiz
    Route::get('/quizzes/{quizId}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/quizzes/{quizId}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/quizzes/{quizId}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/quizzes/{quizId}/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/quizzes/{quizId}/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/quizzes/{quizId}/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    // Quiz attempts
    Route::post('/quizzes/{quizId}/start', [QuizAttemptController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/attempt/{attemptId}/take', [QuizAttemptController::class, 'take'])->name('quiz.take');
    Route::post('/quiz/attempt/{attemptId}/submit', [QuizAttemptController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/attempt/{attemptId}/results', [QuizAttemptController::class, 'results'])->name('quiz.results');
});
