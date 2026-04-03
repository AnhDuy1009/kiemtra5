<?php

namespace App\Http\Controllers; // Phải có dòng này 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ViduLayoutController extends Controller 
{
    public function sach() 
{
    $data = DB::table("sach")->get();
    $the_loai = DB::table("dm_the_loai")->get();
    
    // ĐỊNH NGHĨA BIẾN $title Ở ĐÂY
    $title = "Trang chủ - Nhà sách Phương Nam"; 

    // TRUYỀN BIẾN $title VÀO HÀM COMPACT
    return view("vidusach.index", compact("data", "the_loai", "title"));
   
}
}