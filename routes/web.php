<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\FormController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('welcome');

});

// Route::get('/', [DashboardController::class, 'home'])->name('home');

// Route::get('/register', [FormController::class, 'showRegisterForm'])->name('register');
// Route::post('/welcome', [FormController::class, 'handleRegisterForm'])->name('handleRegister');

// Route::get('/welcome', [FormController::class, 'welcome'])->name('welcome');

Route::middleware(['auth' , IsAdmin::class])->group(function () {
    // CRUD
    // C => Create Data
    Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');

    // U => Update Data
    Route::get('/genres/{id}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/genres/{id}', [GenreController::class, 'update'])->name('genres.update');

    // D => Delete Data
    Route::delete('/genres/{id}', [GenreController::class, 'destroy'])->name('genres.destroy');

    });

// CRUD GENRES
// R => Read Data
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genres.show');

// CRUD BOOKS
Route::resource('books', BookController::class);

// Auth
// Register
Route::get('/register', [AuthController::class, 'showregister']);
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showlogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Comment
Route::post('/books/{book}/comment', [CommentController::class, 'store'])->name('books.comment');