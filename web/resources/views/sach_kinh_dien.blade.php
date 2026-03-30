<!DOCTYPE html>
<html>
<head>
    <title>Danh sách Tác phẩm kinh điển</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">DANH SÁCH TÁC PHẨM KINH ĐIỂN</h2>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sách</th>
                <th>Nhà xuất bản</th>
                <th>Tác giả</th>
                <th>Giá bán</th>
                <th>Hình ảnh</th>
            </tr>
        </thead>
        <tbody>
            @php $stt = 1; @endphp @foreach($sach as $row) <tr>
                <td>{{ $stt++ }}</td>
                <td>{{ $row->tieu_de }}</td> <td>{{ $row->nha_xuat_ban }}</td>
                <td>{{ $row->tac_gia }}</td> <td>{{ number_format($row->gia_ban) }} VNĐ</td>
                <td>
                    <img src="{{ asset('images/' . $row->) }}" alt="Hình sách" width="80">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>