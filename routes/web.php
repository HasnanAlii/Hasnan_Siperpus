<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoansDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('book');
    Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/books', [BookController::class, 'store'])->name('book.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::match(['put', 'patch'], '/books/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/books/print', [BookController::class, 'print'])->name('book.print');
    Route::get('/books/export', [BookController::class, 'export'])->name('book.export');
    Route::post('/books/import', [BookController::class, 'import'])->name('book.import');
    Route::get('/books/{book}/borrow', [LoanController::class, 'borrow'])->name('books.borrow');
    Route::get('/books/{id}/loan', [LoanController::class, 'pinjam'])->name('book.loan');
    Route::get('/loans_detail', [LoanController::class, 'index'])->name('loans_detail');
    Route::get('/loans', [LoansDetailController::class, 'show'])->name('loans');
    Route::get('/loans/return/{loanId}', [LoanController::class, 'returnBook'])->name('loans.return');
    Route::delete('/loans_details/{id}', [LoansDetailController::class, 'destroy'])->name('destroy');
    Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');
    Route::get('/loans_details/export', [LoansDetailController::class, 'export'])->name('loan.export');
    Route::get('/loans_details/print', [LoansDetailController::class, 'print'])->name('loan.print');







   

   


});

require __DIR__ . '/auth.php';
