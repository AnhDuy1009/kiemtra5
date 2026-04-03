<x-book-layout>
    <div class="text-center">
        <h5 class="text-primary font-weight-bold">DANH SÁCH SẢN PHẨM</h5>
        <table class="table table-bordered mt-3">
            <thead class="bg-light">
                <tr>
                    <th>STT</th>
                    <th>Tên sách</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $stt = 1; @endphp
                @forelse($books as $book)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td class="text-left">{{ $book->tieu_de }}</td>
                        <td>{{ $book->num }}</td> <td>{{ number_format($book->gia_ban, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($book->gia_ban * $book->num, 0, ',', '.') }}đ</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Giỏ hàng trống</td>
                    </tr>
                @endforelse
                
                <tr class="font-weight-bold">
                    <td colspan="3">Tổng tiền</td>
                    <td colspan="2" class="text-danger">{{ number_format($total, 0, ',', '.') }}đ</td>
                </tr>
            </tbody>
        </table>
        
        <form action="{{ route('ordercreate') }}" method="POST">
            @csrf <div class="mt-4">
                <p>Hình thức thanh toán: 
                    <select name="hinh_thuc_thanh_toan" class="form-control d-inline-block w-25">
                        <option value="1">Tiền mặt</option>
                        <option value="2">Chuyển khoản</option>
                    </select>
                </p>
                <button type="submit" class="btn btn-primary px-5 font-weight-bold">ĐẶT HÀNG</button>
            </div>
        </form>
</x-book-layout>