<x-account-panel>
    <style>
        .table thead th { background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; }
        .page-title { color: #0d6efd; font-weight: bold; margin-top: 20px; margin-bottom: 20px; text-align: center; }
    </style>

    <div class="container">
        <h2 class="page-title">QUẢN LÝ SÁCH</h2>

        <div class="mb-3 text-right">
            <a href="{{ route('bookcreate') }}" class="btn btn-success btn-sm px-3">Thêm</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
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
                        <td class="text-center font-weight-bold text-danger">{{ number_format($row->gia_ban, 0, ',', '.') }} đ</td>
                        <td class="text-center">
                            @if($row->file_anh_bia)
                                <img src="{{ asset('storage/book_image/'.$row->file_anh_bia) }}" width="45" class="shadow-sm">
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('bookedit', $row->id) }}" class="btn btn-primary btn-sm">Sửa</a>
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
</x-account-panel>