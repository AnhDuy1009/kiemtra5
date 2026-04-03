@foreach($books as $row)
<tr>
    <td>{{ $row->tieu_de }}</td> [cite: 304]
    <td>{{ $row->nha_xuat_ban }}</td> [cite: 306]
    <td>{{ $row->tac_gia }}</td> [cite: 310]
    <td>
        <img src="{{ asset('storage/book_image/'.$row->file_anh_bia) }}" width="50px"> [cite: 373]
    </td>
    <td>
        [cite: 512, 515]
    </td>
</tr>
@endforeach