<?php

use App\Http\Controllers\ProfileController;
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

require __DIR__.'/auth.php';
#->middleware('auth')#
// Danh sách sách
Route::get('/book/list', [App\Http\Controllers\BookController::class, 'booklist'])
    ->middleware('auth')->name("booklist");

// Mở form Thêm sách
Route::get('/book/create', [App\Http\Controllers\BookController::class, 'bookcreate'])
    ->middleware('auth')->name("bookcreate");

// Mở form Sửa sách
Route::get('/book/edit/{id}', [App\Http\Controllers\BookController::class, 'bookedit'])
    ->middleware('auth')->name("bookedit");

// Lưu dữ liệu (dùng chung cho Thêm và Sửa)
Route::post('/book/save/{action}', [App\Http\Controllers\BookController::class, 'booksave'])
    ->middleware('auth')->name("booksave");

// Xóa sách
Route::post('/book/delete', [App\Http\Controllers\BookController::class, 'bookdelete'])
    ->middleware('auth')->name("bookdelete");