<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [BooksController::class, 'index'])->name('start');
Route::get('/books/num', [BooksController::class, 'num'])->name('num');
Route::get('/books/arr', [BooksController::class, 'arr'])->name('arr');
Route::get('/books/rna', [BooksController::class, 'rna'])->name('rna');
Route::get('/books/insert', [BooksController::class, 'insert'])->name('insert');
Route::get('/books/clear', [BooksController::class, 'clear'])->name('clear');
