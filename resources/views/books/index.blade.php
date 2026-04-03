<x-book-layout>
    <div class="row" id="list-product"> 
        @foreach($books as $row)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm border-0 p-2">
                    
                    <a href="{{url('sach/chitiet/'.$row->id)}}" class="text-decoration-none text-dark d-flex flex-column flex-grow-1">
                        <img src="{{asset('image/image/image/'.$row->file_anh_bia)}}" class="card-img-top" style="height: 200px; object-fit: contain;">
                        
                        <div class="card-body p-2 text-center">
                            <h6 class="font-weight-bold book-title mb-2" style="color: #333;">
                                {{$row->tieu_de}}
                            </h6>
                            <p class="text-danger font-weight-bold mb-0">
                                {{number_format($row->gia_ban, 0, ",", ".")}}đ
                            </p>
                        </div>
                    </a> 
                    
                    <div class="mt-auto btn-add-product pt-2">
                        <button class="btn btn-success btn-sm w-100 add-product" book_id="{{$row->id}}">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    @if(session('status'))
        <script>
            alert("{{ session('status') }}");
        </script>
    @endif

    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add-product").click(function(e) {
                e.preventDefault(); // Ngăn chặn các hành vi click mặc định
                
                // Lấy ID sách từ nút bấm
                var bookId = $(this).attr("book_id");
                
                // Gửi dữ liệu qua AJAX
                $.post("{{ route('cartadd') }}", {
                    "_token": "{{ csrf_token() }}",
                    "id": bookId, // Truyền ID sách vừa lấy được
                    "num": 1 // Cố định mua 1 cuốn vì trang chủ không có ô nhập số lượng
                }, function(data) {
                    // Cập nhật số lượng trên giỏ hàng
                    $("#cart-number-product").html(data);
                    alert("Đã thêm vào giỏ hàng thành công!");
                }).fail(function() {
                    alert("Có lỗi xảy ra, vui lòng thử lại!");
                });
            });
        });
    </script>
</x-book-layout>