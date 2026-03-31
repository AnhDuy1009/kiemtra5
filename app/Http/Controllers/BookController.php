<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
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
    public function booklist()
    {
        $data = DB::table("sach")->get();
        
        return view("books.book_list", compact("data"));
    }
    public function bookcreate()
    {
        $the_loai = DB::table("dm_the_loai")->get();
        $action = "add"; 
        return view("books.book_form", compact("the_loai", "action")); 
    }
    public function booksave($action, Request $request)
    {
        // 1. Kiểm tra dữ liệu
        $request->validate([
            'tieu_de' => ['required', 'string', 'max:200'],
            'nha_cung_cap' => ['required', 'string', 'max:50'],
            'nha_xuat_ban' => ['required', 'string', 'max:50'],
            'tac_gia' => ['required', 'string', 'max:50'],
            'hinh_thuc_bia' => ['required', 'string', 'max:50'],
            'gia_ban' => ['required', 'numeric'],
            'the_loai' => ['required', 'max:3'],
            'file_anh_bia' => ['nullable', 'image']
        ]);

        // 2. Lấy dữ liệu ngoại trừ token
        $data = $request->except("_token");
        
        if($action == "edit") {
            $data = $request->except("_token", "id");
        }

        // 3. Xử lý lưu hình ảnh 
        if($request->hasFile("file_anh_bia"))
        {
            $fileName = $request->input("tieu_de")."_".rand(1000000,9999999).'.'. $request->file('file_anh_bia')->extension();
            $request->file('file_anh_bia')->storeAs('public/book_image', $fileName);
            $data['file_anh_bia'] = $fileName;
        }

        $message = "";
        
        // 4. Lưu vào Database [cite: 1530-1540]
        if($action == "add")
        {
            DB::table("sach")->insert($data);
            $message = "Thêm thành công";
        }
        else if($action == "edit")
        {
            $id = $request->id;
            DB::table("sach")->where("id", $id)->update($data);
            $message = "Cập nhật thành công";
        }

        // 5. Trả về trang danh sách
        return redirect()->route('booklist')->with('status', $message);
    }
    public function bookedit($id)
    {
        $the_loai = DB::table("dm_the_loai")->get();
        
        $sach = DB::table("sach")->where("id", $id)->first();
        
        $action = "edit";
        
        return view("books.book_form", compact("the_loai", "sach", "action"));
    }
    public function bookdelete(Request $request)
    {
        $id = $request->id;
        DB::table("sach")->where("id", $id)->delete();
        return redirect()->route('booklist')->with('status', 'Xóa sách thành công!');
    }
}