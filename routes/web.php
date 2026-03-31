<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Mail\OrderSuccessMail; // Quan trọng: Phải import Class Mail này
use Illuminate\Support\Facades\Mail; // Quan trọng: Phải import Facade Mail này

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

// --- PHẦN THÊM MỚI ĐỂ TEST 6A ---
Route::get('/test-6a', function () {
    // 1. Giả lập dữ liệu đơn hàng (Mock Data)
    $order = (object) [
        'id' => 'DH-' . rand(1000, 9999),
        'customer_name' => 'Bạn',
        'total_price' => 500000,
        'email' => 'phandinhphuc2108@gmail.com' // THAY BẰNG EMAIL CỦA BẠN ĐỂ NHẬN THỬ
    ];

    try {
        // 2. Gọi lệnh gửi mail
        Mail::to($order->email)->send(new OrderSuccessMail($order));
        
        return "<h3>Gửi email đặt hàng thành công!</h3><p>Hãy kiểm tra hộp thư: <b>" . $order->email . "</b></p>";
    } catch (\Exception $e) {
        // Trả về lỗi nếu cấu hình .env chưa đúng
        return "<h3>Lỗi gửi mail:</h3>" . $e->getMessage();
    }
});