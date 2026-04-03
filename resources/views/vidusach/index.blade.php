<x-book-layout>
    {{-- Nếu layout dùng biến $title trực tiếp, bạn không cần làm gì thêm ở đây --}}
    {{-- Chỉ cần đảm bảo Controller đã truyền biến $title qua view() là được --}}

    <div class="list-book">
        @foreach($data as $row)
            <div class="book">
                <img src="{{ asset('storage/book_image/'.$row->file_anh_bia) }}" width="100%"> 
                <div style="color: #007bff; font-weight: bold;">{{ $row->tieu_de }}</div>
                <div style="color: #666;">{{ number_format($row->gia_ban) }}đ</div> 
            </div>
        @endforeach
    </div>
</x-book-layout>