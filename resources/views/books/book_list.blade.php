<x-book-layout>
    <style>
        .sidebar { background-color: #3f4d67; min-height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #a9b7d1; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover { background-color: #333f54; color: white; }
        .sidebar a.active { background-color: #1abc9c; color: white; }
        .breadcrumb { background: none; padding-left: 0; }
        .table thead th { background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; }
    </style>

    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-md-2 sidebar">
                <a href="#">Thông tin tài khoản</a>
                <a href="{{ route('booklist') }}" class="active">Quản lý sách</a>
            </div>

            <div class="col-md-10 p-4" style="background-color: white;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        
                    </ol>
                </nav>

                <h3 class="text-center text-primary font-weight-bold mb-4" style="letter-spacing: 1px;">QUẢN LÝ SÁCH</h3>

                <div class="mb-3">
                    <a href="{{ route('bookcreate') }}" class="btn btn-success btn-sm px-3">Thêm</a>
                </div>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Tiêu đề</th>
                            <th>Nhà xuất bản</th>
                            <th>Nhà cung cấp</th>
                            <th>Tác giả</th>
                            <th>Hình thức bìa</th>
                            <th>Giá bán</th>
                            <th>Hình ảnh</th>
                            <th width="140">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $row->tieu_de }}</td>
                            <td>{{ $row->nha_xuat_ban }}</td>
                            <td>{{ $row->nha_cung_cap }}</td>
                            <td>{{ $row->tac_gia }}</td>
                            <td class="text-center">{{ $row->hinh_thuc_bia }}</td>
                            <td class="text-center font-weight-bold text-danger">
                                {{ number_format($row->gia_ban, 0, ',', '.') }} đ
                            </td>
                            <td class="text-center">
                                @if($row->file_anh_bia)
                                    <img src="{{ asset('storage/book_image/'.$row->file_anh_bia) }}" width="45" class="shadow-sm">
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('bookedit', $row->id) }}" class="btn btn-primary btn-sm mr-1">Sửa</a>
                                    <form action="{{ route('bookdelete') }}" method="POST" onsubmit="return confirm('Xóa cuốn này?')">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-book-layout>