<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách Tác phẩm kinh điển</title>
    <style>
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">DANH SÁCH TÁC PHẨM KINH ĐIỂN</h2>

    <table>
        <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Nhà xuất bản</th>
            <th>Tác giả</th>
            <th>Giá bán</th>
            <th>Hình ảnh</th>
        </tr>
        
        @php $stt = 1; @endphp
        
        @foreach($sach as $row)
        <tr>
            <td>{{ $stt++ }}</td>
            <td>{{ $row->tieu_de }}</td>
            <td>{{ $row->nha_xuat_ban }}</td>
            <td>{{ $row->tac_gia }}</td>
            <td>{{ number_format($row->gia_ban) }} VNĐ</td>
            <td>
                <img src="{{ asset('images/' . $row->link_anh_bia) }}" alt="Hình sách" width="70">
            </td>
        </tr>
        @endforeach

    </table>

</body>
</html>