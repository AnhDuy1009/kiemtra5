<x-account-panel>
    
    <div style='text-align:center; color:#15c; font-weight:bold; font-size:20px;'>QUẢN LÝ SÁCH</div>
    <div class="mb-2">
    <label>Lọc theo thể loại:</label>
    <select id="filter-the-loai" class="form-control" style="width: 200px; display: inline-block;">
        <option value="0">-- Tất cả --</option>
        @foreach($the_loai as $row)
            <option value="{{$row->id}}">{{$row->ten_the_loai}}</option>
        @endforeach
    </select>
</div>
    <a href="{{route('bookcreate')}}" class='btn btn-sm btn-success mb-1'>Thêm</a>

    <table id = "book-table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Nhà xuất bản</th>
                <th>Nhà cung cấp</th>
                <th>Tác giả</th>
                <th>Hình thức bìa</th>
                <th>Giá bán</th>
                <th>Hình ảnh</th>
                <th width="120px">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td >{{$row->tieu_de}}</td>
                <td>{{$row->nha_xuat_ban}}</td>
                <td>{{$row->nha_cung_cap}}</td>
                <td>{{$row->tac_gia}}</td>
                <td>{{$row->hinh_thuc_bia}}</td>
                <td>{{$row->gia_ban}}</td>
                <td><img src="{{asset('storage/book_image/'.$row->file_anh_bia)}}" width="50px"></td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('bookedit',['id'=>$row->id])}}" class='btn btn-sm btn-primary'>Sửa</a>
                        &nbsp;
                        <form method='post' action = "{{route('bookdelete')}}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa cuốn sách này không?');">
                            <input type='hidden' value='{{$row->id}}' name='id'>
                            <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-account-panel>
<script>
$(document).ready(function() {
    // Khởi tạo DataTable (Sử dụng thư viện từ account-panel_2)
    var table = $('#book-table').DataTable({
        responsive: true,
        "bStateSave": true
    });

    // Xử lý AJAX khi chọn thể loại
    $('#filter-the-loai').on('change', function() {
        let id = $(this).val();
        $.ajax({
            url: '/book/filter/' + id, // Route bạn đã tạo ở Controller
            type: 'GET',
            success: function(res) {
                table.clear().destroy(); // Xóa bảng cũ
                $('#book-table tbody').html(res); // Chèn dữ liệu mới từ Partial View
                table = $('#book-table').DataTable({ responsive: true, "bStateSave": true }); // Vẽ lại bảng
            }
        });
    });
});
</script>
