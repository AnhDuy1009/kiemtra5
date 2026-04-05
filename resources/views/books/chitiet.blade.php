<x-book-layout>
    <div class="row mt-3">
        <div class="col-md-4 text-center">
            <img src="{{ asset('image/image/image/' . $book->file_anh_bia) }}" class="img-fluid border shadow-sm">
        </div>
        <div class="col-md-8">
            <h4 class="text-primary font-weight-bold">{{ $book->tieu_de }}</h4>
            <h5 class="text-danger">Giá bán: {{ number_format($book->gia_ban, 0, ',', '.') }} đ</h5>
            <hr>
            <div class="d-flex align-items-center bg-light p-3 rounded mb-3 border">
                <span class="mr-2">Số lượng mua:</span>
                <input type="number" id="product-number" value="1" min="1" class="form-control mr-3" style="width: 70px;">
                <button class="btn btn-success" id="add-to-cart">Thêm vào giỏ hàng</button>
            </div>
            <h6>Mô tả nội dung:</h6>
            <div class="text-justify">{!! $book->mo_ta !!}</div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#add-to-cart").click(function(){
            $.post("{{ route('cartadd') }}", {
                "_token": "{{ csrf_token() }}",
                "id": "{{$book->id}}", "num": $("#product-number").val()
            }, function(data){
                $("#cart-number-product").html(data);
                alert("Đã thêm thành công!");
            });
        });
    </script>
</x-book-layout>