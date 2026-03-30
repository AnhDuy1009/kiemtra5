<x-book-layout>
    <x-slot name='title'>
        Danh sách Sách
    </x-slot>

    <div class='list-book'> 
        @foreach($data as $row)
            <div class='book'>
                <img src="{{ asset('book_image/' . $row->file_anh_bia) }}" height="200px" style="max-width:100%"><br>
                <b>{{ $row->tieu_de }}</b><br/>
                <i class="text-danger">{{ number_format($row->gia_ban, 0, ",", ".") }}đ</i><br>
                
                <a href="{{ url('books/chitiet/' . $row->id) }}" class="btn btn-sm btn-primary mt-2">Xem chi tiết</a>
            </div>
        @endforeach
    </div>
</x-book-layout>