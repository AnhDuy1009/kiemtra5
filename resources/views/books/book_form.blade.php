<x-book-layout>
    <div class="container mt-4" style="width:50%; margin:0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <form action="{{ route('booksave', ['action' => $action]) }}" method="post" enctype="multipart/form-data">
            @csrf
            
            @if($action == 'edit')
                <input type="hidden" name="id" value="{{ $sach->id }}">
            @endif

            <h3 style='text-align:center; font-weight:bold; color:#15c; margin-bottom: 20px;'>
                {{ $action == 'add' ? 'THÊM THÔNG TIN SÁCH' : 'CẬP NHẬT THÔNG TIN SÁCH' }}
            </h3>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group mb-2">
                <label class="font-weight-bold">Tiêu đề</label>
                <input type='text' class='form-control form-control-sm' name='tieu_de' value="{{ isset($sach) ? $sach->tieu_de : '' }}">
            </div>

            <div class="form-group mb-2">
                <label class="font-weight-bold">Nhà xuất bản</label>
                <input type='text' class='form-control form-control-sm' name='nha_xuat_ban' value="{{ isset($sach) ? $sach->nha_xuat_ban : '' }}">
            </div>

            <div class="form-group mb-2">
                <label class="font-weight-bold">Nhà cung cấp</label>
                <input type='text' class='form-control form-control-sm' name='nha_cung_cap' value="{{ isset($sach) ? $sach->nha_cung_cap : '' }}">
            </div>

            <div class="form-group mb-2">
                <label class="font-weight-bold">Tác giả</label>
                <input type='text' class='form-control form-control-sm' name='tac_gia' value="{{ isset($sach) ? $sach->tac_gia : '' }}">
            </div>

            <div class="form-group mb-2">
                <label class="font-weight-bold">Hình thức bìa</label>
                <input type='text' class='form-control form-control-sm' name='hinh_thuc_bia' value="{{ isset($sach) ? $sach->hinh_thuc_bia : '' }}">
            </div>

            <div class="form-group mb-2">
                <label class="font-weight-bold">Giá bán</label>
                <input type='number' class='form-control form-control-sm' name='gia_ban' value="{{ isset($sach) ? $sach->gia_ban : '' }}">
            </div>

            <div class="form-group mb-2">
                <label class="font-weight-bold">Thể loại</label>
                <select name='the_loai' class='form-control form-control-sm'>
                    @foreach($the_loai as $row)
                        <option value='{{$row->id}}' {{ (isset($sach) && $sach->the_loai == $row->id) ? 'selected' : '' }}>
                            {{$row->ten_the_loai}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Ảnh bìa sách</label><br>
                @if(isset($sach) && $sach->file_anh_bia)
                    <img src="{{ asset('storage/book_image/' . $sach->file_anh_bia) }}" width="80px" class="mb-2" alt="Ảnh cũ"><br>
                @endif
                <input type="file" name="file_anh_bia" accept="image/*" class="form-control-file">
                @if(isset($sach))
                    <small class="text-muted">Chỉ chọn ảnh mới nếu bạn muốn thay đổi ảnh bìa hiện tại.</small>
                @endif
            </div>

            <div style='text-align:center;'>
                <input type='submit' class='btn btn-primary px-4' value='Lưu'>
                <a href="{{ route('booklist') }}" class="btn btn-secondary px-4">Hủy</a>
            </div>
        </form>
    </div>
</x-book-layout>