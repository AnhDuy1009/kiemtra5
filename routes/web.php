<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','App\Http\Controllers\ViduLayoutController@sach');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/accountpanel','App\Http\Controllers\AccountController@accountpanel')
             ->middleware('auth')->name("account");
Route::post('/saveaccountinfo','App\Http\Controllers\AccountController@saveaccountinfo')
            ->middleware('auth')->name('saveinfo');
// Route lấy danh sách sách theo ID thể loại
Route::get('/book/filter/{id}', 'App\Http\Controllers\BookController@getBooksByCategory')
    ->middleware('auth')
    ->name("book.filter");
    // Quản lý danh sách sách
Route::get('/book/list', 'App\Http\Controllers\BookController@booklist')
    ->middleware('auth')
    ->name("booklist"); // Tên này phải khớp tuyệt đối với 

// Thêm các route bổ trợ để không bị lỗi tiếp theo
Route::get('/book/create', 'App\Http\Controllers\BookController@bookcreate')
    ->middleware('auth')
    ->name("bookcreate"); // Khớp với 

Route::get('/book/edit/{id}', 'App\Http\Controllers\BookController@bookedit')
    ->middleware('auth')
    ->name("bookedit"); // Khớp với 

Route::post('/book/delete', 'App\Http\Controllers\BookController@bookdelete')
    ->middleware('auth')
    ->name("bookdelete"); // Khớp với