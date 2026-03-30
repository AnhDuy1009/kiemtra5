<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // BẮT BUỘC PHẢI THÊM DÒNG NÀY

class BookController extends Controller
{
    public function index()
    {
        // Lấy 8 cuốn rẻ nhất
        $data = DB::select("select * from sach order by gia_ban asc limit 0,8");
        return view("books.index", compact("data"));
    }

    public function theloai($id)
    {
        // Lấy sách theo thể loại
        $data = DB::select("select * from sach where the_loai = ?", [$id]);
        return view("books.index", compact("data"));
    }

    public function chitiet($id)
    {
        // Truy vấn lấy 1 cuốn sách dựa vào ID (Sử dụng tham số ? để chống SQL Injection)
        $data = DB::select("select * from sach where id = ?", [$id]);

        // DB::select luôn trả về 1 mảng. Nếu mảng rỗng (không tìm thấy sách), báo lỗi 404
        if (count($data) == 0) {
            return abort(404);
        }

        // Lấy phần tử đầu tiên (và duy nhất) trong mảng gán vào biến $book
        $book = $data[0];

        // Trả về view và truyền biến $book sang
        return view("books.chitiet", compact("book"));
    }
}