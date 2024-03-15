<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\EnsureUserIsLoggedIn;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;



Route::get('/', function () {
    if (session()->has('logged_in')) {
        return redirect()->route('authors');
    }
    return view('welcome');
})->name('welcome');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/authors', [AuthorsController::class, 'index'])->name('authors')->middleware(EnsureUserIsLoggedIn::class);
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('author.show')->middleware(EnsureUserIsLoggedIn::class);
Route::get('/logout', function () {
    session()->forget('logged_in');
    return redirect()->route('welcome');
})->name('logout')->middleware(EnsureUserIsLoggedIn::class);
Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy')->middleware(EnsureUserIsLoggedIn::class);
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('book.destroy')->middleware(EnsureUserIsLoggedIn::class);
Route::get('/books', [BookController::class, 'index'])->name('book.show')->middleware(EnsureUserIsLoggedIn::class);
Route::post('/books', [BookController::class, 'store'])->name('book.store')->middleware(EnsureUserIsLoggedIn::class);



