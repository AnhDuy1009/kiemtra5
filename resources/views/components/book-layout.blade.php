<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nhà Sách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Banner màu cam */
        .banner-orange { 
            background-color: #ff6600; 
            color: white; 
            min-height: 50px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 20px; 
            margin-bottom: 20px; 
            border-radius: 5px; 
        }
        /* Menu trên banner khi vào trang chi tiết */
        .nav-orange .nav-link { 
            color: white !important; 
            font-weight: bold; 
            text-transform: uppercase; 
            font-size: 14px;
        }
        /* Menu bên trái màu đỏ */
        .sidebar-red { 
            background: #ff3333; 
            border-radius: 5px; 
            padding: 10px; 
        }
        .sidebar-red .nav-link { 
            color: white !important; 
            font-weight: bold; 
            border-bottom: 1px solid rgba(255,255,255,0.1); 
        }
        .sidebar-red .nav-link:hover {
            background-color: rgba(0,0,0,0.1);
        }
        /* Giỏ hàng */
        .cart-badge { 
            background: #23b85c; 
            color: white; 
            border-radius: 50%; 
            padding: 2px 7px; 
            font-size: 11px; 
            position: absolute; 
            top: -10px; 
            right: -15px; 
            border: 2px solid white; 
        }

    </style>
</head>
<body class="bg-light">
    <div class="container bg-white shadow mt-2 pb-5" style="max-width: 1100px; min-height: 100vh;">
        
        <header class="text-center py-2">
            <img src="{{ asset('image/banner_sach.jpg') }}" class="w-100 rounded" alt="Header Banner">
        </header>

        @php 
            $isSpecialPage = Request::is('sach/chitiet/*') || Request::is('order'); 
        @endphp
    <div class="shadow-sm px-3 py-2 mb-4" style="background-color: #ff6600; border-radius: 5px;">
            <div class="d-flex justify-content-between align-items-center flex-nowrap">
                
                <div class="title-area" style="overflow: hidden;">
                    @if($isSpecialPage)
                        <div class="d-flex" style="overflow-x: auto; white-space: nowrap;">
                            <a class="text-white font-weight-bold text-uppercase mr-3" href="{{ url('/') }}">Trang chủ</a>
                            <a class="text-white font-weight-bold text-uppercase mr-3" href="{{ url('/books/theloai/1') }}">Tiểu thuyết</a>
                            <a class="text-white font-weight-bold text-uppercase mr-3" href="{{ url('/books/theloai/2') }}">Truyện ngắn</a>
                            <a class="text-white font-weight-bold text-uppercase" href="{{ url('/books/theloai/3') }}">Kinh điển</a>
                        </div>
                    @else
                        <h5 class="m-0 font-weight-bold text-uppercase text-white text-truncate" style="max-width: 100%;" title="Nhà Sách Trực Tuyến">
                            Nhà Sách Trực Tuyến
                        </h5>
                    @endif
                </div>
                

                <div class='col-3 p-0 d-flex justify-content-end'>
                        @auth

                        <div class="icon-area d-flex align-items-center text-nowrap ml-3">
                    
                            <a href="{{ url('/order') }}" style="color: white; text-decoration: none; position: relative; margin-right: 25px;">
                                <i class="fas fa-shopping-cart fa-lg"></i> 
                                <span class="cart-badge" id="cart-number-product" style="background: #23b85c; color: white; border-radius: 50%; padding: 2px 7px; font-size: 11px; position: absolute; top: -10px; right: -15px; border: 2px solid #ff6600;">
                                    {{ session('cart') ? count(session('cart')) : 0 }}
                                </span>
                            </a>
                            <div class="dropdown">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('account')}}">Quản lý</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" onclick="event.preventDefault();
                                                        this.closest('form').submit();">Đăng xuất</a>
                                </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}">
                                <button class='btn btn-sm btn-primary'>Đăng nhập</button>
                            </a>&nbsp;
                            <a href="{{ route('register') }}">
                                <button class='btn btn-sm btn-success'>Đăng ký</button>
                            </a>
                        @endauth
                </div>
            </div>
        </div>

        <div class="row">
            @if(!$isSpecialPage)
                <div class="col-md-3">
    <div class="sidebar-red mb-3 shadow-sm">
        <ul class="nav flex-column navbar-nav">
            <li class="nav-item active">
                <a class="nav-link menu-the-loai" href="#" the_loai="">
                    <i class="fas fa-book-open mr-2"></i> Trang chủ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-the-loai" href="#" the_loai="1">
                    <i class="fas fa-chevron-right mr-2"></i> Tiểu thuyết
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-the-loai" href="#" the_loai="2">
                    <i class="fas fa-chevron-right mr-2"></i> Truyện ngắn - Tản văn
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-the-loai" href="#" the_loai="3">
                    <i class="fas fa-chevron-right mr-2"></i> Tác phẩm kinh điển
                </a>
            </li>
        </ul>
    </div>

                    <div class="mb-2">
                        <img src="{{ asset('image/sidebar_1.jpg') }}" class="w-100 rounded shadow-sm" alt="Sách mới">
                    </div>
                    <div class="mb-2">
                        <img src="{{ asset('image/sidebar_2.jpg') }}" class="w-100 rounded shadow-sm" alt="Bestseller">
                    </div>
                </div>

                <div class="col-md-9 border-left">
                    {{ $slot }}
                </div>
            @else
                <div class="col-md-12">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>