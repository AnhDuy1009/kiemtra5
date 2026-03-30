<x-book-layout>
    <x-slot name="title">
        Chi tiết: {{ $book->tieu_de }}
    </x-slot>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset('book_image/' . $book->file_anh_bia) }}" style="max-width: 100%; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
            </div>

            <div class="col-md-8">
                <h3 class="text-primary">{{ $book->tieu_de }}</h3>
                <h4 class="text-danger mt-3">Giá bán: {{ number_format($book->gia_ban, 0, ",", ".") }} đ</h4>
                
                <hr>
                
                <p><b>Mã sách:</b> {{ $book->id }}</p>
                <p><b>Tác giả:</b> {{ $book->tac_gia ?? 'Đang cập nhật' }}</p>
                <p><b>Nhà xuất bản:</b> {{ $book->nha_xuat_ban ?? 'Đang cập nhật' }}</p>
                
                <h5 class="mt-4"><b>Mô tả nội dung:</b></h5>
                <p class="text-justify">{!! $book->mo_ta ?? 'Chưa có thông tin mô tả chi tiết cho cuốn sách này.' !!}</p>

                <a href="{{ url('books') }}" class="btn btn-outline-secondary mt-4">⬅ Quay lại danh sách</a>
            </div>
        </div>
    </div>
</x-book-layout>