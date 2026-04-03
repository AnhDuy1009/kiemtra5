<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','App\Http\Controllers\ViduLayoutController@sach');
=======
/*
 * Route::get('/', function () {
 *     return view('welcome');
 * });
 * /**
 */
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/sach/chitiet/{id}', [App\Http\Controllers\BookController::class, 'chitiet'])->name('book.detail');
Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
Route::get('/books/theloai/{id}', [App\Http\Controllers\BookController::class, 'theloai'])->name('book.category');
Route::get('/order', [App\Http\Controllers\BookController::class, 'order'])->name('order');
Route::post('/cart/add', [App\Http\Controllers\BookController::class, 'cartadd'])->name('cartadd');
Route::post('/filter-books', [App\Http\Controllers\BookController::class, 'filter']);
Route::post('/order/create', [App\Http\Controllers\BookController::class, 'ordercreate'])->middleware('auth')->name('ordercreate');
>>>>>>> 75557b6252d38da23e80d7093137a6aecbb8f630

// Kiểm tra xem có đúng là gọi đến hàm theloai không
Route::get('/books/theloai/{id}', [BookController::class, 'theloai'])->name('book.category');

// Đường dẫn xử lý khi bấm nút "Thêm vào giỏ hàng"
Route::get('/cart', function () {
    return view('books.cart');  // Thêm books. vào đây
})->name('cart.view');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< HEAD
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
=======
require __DIR__ . '/auth.php';
// ->middleware('auth')#
// Danh sách sách
Route::get('/book/list', [App\Http\Controllers\BookController::class, 'booklist'])
    ->middleware('auth')
    ->name('booklist');

// Mở form Thêm sách
Route::get('/book/create', [App\Http\Controllers\BookController::class, 'bookcreate'])
    ->middleware('auth')
    ->name('bookcreate');

// Mở form Sửa sách
Route::get('/book/edit/{id}', [App\Http\Controllers\BookController::class, 'bookedit'])
    ->middleware('auth')
    ->name('bookedit');

// Lưu dữ liệu (dùng chung cho Thêm và Sửa)
Route::post('/book/save/{action}', [App\Http\Controllers\BookController::class, 'booksave'])
    ->middleware('auth')
    ->name('booksave');

// Xóa sách
Route::post('/book/delete', [App\Http\Controllers\BookController::class, 'bookdelete'])
    ->middleware('auth')
    ->name('bookdelete');

// Đường dẫn mở trang Giỏ hàng
Route::get('/cart', function () {
    return view('cart');  // Trỏ tới file cart.blade.php bạn vừa tạo lúc nãy
})->name('cart.view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
>>>>>>> 75557b6252d38da23e80d7093137a6aecbb8f630
