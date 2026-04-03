<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        // Lấy danh sách sách (Query này mình lấy từ log database của bạn)
        $books = \DB::table('sach')->orderBy('gia_ban', 'asc')->limit(8)->get();

        // TRUYỀN BIẾN: Phải đặt tên là 'books'
        return view('books.index', compact('books'));
    }

    public function theloai($id)
    {
        // Lấy sách theo thể loại
        $books = \DB::table('sach')->where('the_loai', $id)->get();

        // CHÚ Ý: Phải là 'books' để khớp với biến ở trang index
        return view('books.index', compact('books'));
    }

    public function chitiet($id)
    {
        // 1. Lấy dữ liệu cuốn sách và lưu vào biến $book (thay vì $data)
        $book = \DB::table('sach')->where('id', $id)->first();

        // Kiểm tra nếu không tìm thấy sách thì báo lỗi 404
        if (!$book) {
            abort(404, 'Không tìm thấy sách');
        }

        // 2. Trả về view và gửi kèm gói hàng tên là 'book'
        return view('books.chitiet', compact('book'));
    }

    public function booklist()
    {
        $data = DB::table('sach')->get();

        return view('books.book_list', compact('data'));
    }

    public function bookcreate()
    {
        $the_loai = DB::table('dm_the_loai')->get();
        $action = 'add';
        return view('books.book_form', compact('the_loai', 'action'));
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
        $data = $request->except('_token');

        if ($action == 'edit') {
            $data = $request->except('_token', 'id');
        }

        // 3. Xử lý lưu hình ảnh
        if ($request->hasFile('file_anh_bia')) {
            $fileName = $request->input('tieu_de') . '_' . rand(1000000, 9999999) . '.' . $request->file('file_anh_bia')->extension();
            $request->file('file_anh_bia')->storeAs('public/book_image', $fileName);
            $data['file_anh_bia'] = $fileName;
        }

        $message = '';

        // 4. Lưu vào Database [cite: 1530-1540]
        if ($action == 'add') {
            DB::table('sach')->insert($data);
            $message = 'Thêm thành công';
        } else if ($action == 'edit') {
            $id = $request->id;
            DB::table('sach')->where('id', $id)->update($data);
            $message = 'Cập nhật thành công';
        }

        // 5. Trả về trang danh sách
        return redirect()->route('booklist')->with('status', $message);
    }

    public function bookedit($id)
    {
        $the_loai = DB::table('dm_the_loai')->get();

        $sach = DB::table('sach')->where('id', $id)->first();

        $action = 'edit';

        return view('books.book_form', compact('the_loai', 'sach', 'action'));
    }

    public function bookdelete(Request $request)
    {
        $id = $request->id;
        DB::table('sach')->where('id', $id)->delete();
        return redirect()->route('booklist')->with('status', 'Xóa sách thành công!');
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
            'num' => ['required', 'numeric']
        ]);

        $id = $request->id;
        $num = $request->num;
        $cart = [];

        if (session()->has('cart')) {
            $cart = session()->get('cart');
            if (isset($cart[$id]))
                $cart[$id] += $num;
            else
                $cart[$id] = $num;
        } else {
            $cart[$id] = $num;
        }

        session()->put('cart', $cart);

        // Trả về tổng số món hàng có trong giỏ
        return count($cart);
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        // Tìm cuốn sách trong Database
        $sach = \DB::table('sach')->where('id', $id)->first();

        if (!$sach) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sách!']);
        }

        // Lấy giỏ hàng từ Session ra (nếu chưa có thì tạo mảng rỗng)
        $cart = session()->get('cart', []);

        // Nếu sách đã có trong giỏ thì tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Nếu chưa có thì thêm mới vào giỏ
            $cart[$id] = [
                'name' => $sach->tieu_de,
                'quantity' => 1,
                'price' => $sach->gia_ban,
                'image' => $sach->file_anh_bia
            ];
        }

        // Lưu lại giỏ hàng vào Session
        session()->put('cart', $cart);

        // Đếm tổng số lượng sách trong giỏ
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        // Trả về số lượng để Javascript cập nhật lên màn hình
        return response()->json([
            'success' => true,
            'cart_count' => $totalQuantity
        ]);
    }

    public function order()
    {
        // 1. Lấy giỏ hàng từ session (chỉ chứa ID và số lượng)
        $cart = session()->get('cart');
        $books = [];
        $total = 0;

        if ($cart) {
            foreach ($cart as $id => $num) {
                // 2. Truy vấn Database để lấy thông tin chi tiết của từng cuốn sách
                $book = \DB::table('sach')->where('id', $id)->first();
                if ($book) {
                    $book->num = $num;  // Gán số lượng vào đối tượng sách
                    $books[] = $book;
                    $total += $book->gia_ban * $num;  // Tính tổng tiền
                }
            }
        }
        return view('books.order', compact('books', 'total'));
    }

    public function ordercreate(Request $request)
    {
        $request->validate([
            'hinh_thuc_thanh_toan' => ['required', 'numeric']
        ]);

        if (session()->has('cart') && count(session('cart')) > 0) {
            $order = [
                'ngay_dat_hang' => \DB::raw('now()'),
                'tinh_trang' => 1,
                'hinh_thuc_thanh_toan' => $request->hinh_thuc_thanh_toan,
                'user_id' => \Auth::check() ? \Auth::user()->id : 1
            ];

            \DB::transaction(function () use ($order) {
                $id_don_hang = \DB::table('don_hang')->insertGetId($order);

                $cart = session('cart');
                $quantity = [];

                foreach ($cart as $id => $value) {
                    $quantity[$id] = is_array($value) ? $value['quantity'] : $value;
                }

                $list_id = array_keys($cart);
                $data = \DB::table('sach')->whereIn('id', $list_id)->get();
                $detail = [];

                foreach ($data as $row) {
                    $detail[] = [
                        'ma_don_hang' => $id_don_hang,
                        'sach_id' => $row->id,
                        'so_luong' => $quantity[$row->id],
                        'don_gia' => $row->gia_ban
                    ];
                }

                \DB::table('chi_tiet_don_hang')->insert($detail);
                session()->forget('cart');
            });

            // CÁCH CHUẨN LARAVEL: Chuyển hướng về trang chủ kèm theo biến session 'status'
            return redirect('/')->with('status', ' Đặt hàng thành công!');
        }

        // Nếu giỏ hàng trống, quay lại trang trước đó kèm báo lỗi
        return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
    }

    public function filter(Request $request)
    {
        $the_loai = $request->the_loai;

        // Lấy sách theo thể loại
        $books = \DB::table('sach')->where('the_loai', $the_loai)->get();

        // Trả về view con (chỉ chứa danh sách sách)
        return view('books.list_raw', compact('books'));
    }
}
