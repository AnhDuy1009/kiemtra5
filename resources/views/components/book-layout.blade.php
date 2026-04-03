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

                <div class="icon-area d-flex align-items-center text-nowrap ml-3">
                    
                    <a href="{{ url('/order') }}" style="color: white; text-decoration: none; position: relative; margin-right: 25px;">
                        <i class="fas fa-shopping-cart fa-lg"></i> 
                        <span class="cart-badge" id="cart-number-product" style="background: #23b85c; color: white; border-radius: 50%; padding: 2px 7px; font-size: 11px; position: absolute; top: -10px; right: -15px; border: 2px solid #ff6600;">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>

                    @auth
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-white" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none;">
                                <i class="fas fa-user-circle fa-lg"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow mt-2" aria-labelledby="userMenu">
                                <h6 class="dropdown-header">Xin chào, {{ Auth::user()->name }}</h6>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user mr-2 text-muted"></i> Hồ sơ (Profile)
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger" style="cursor: pointer;">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white" title="Đăng nhập" style="text-decoration: none;">
                            <i class="fas fa-sign-in-alt fa-lg"></i>
                        </a>
                    @endauth

                </div>
            </div>
        </div>

        <div class="row">
            @if(!$isSpecialPage)
                <div class="col-md-3">
                    <div class="sidebar-red mb-3 shadow-sm">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang chủ</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/books/theloai/1') }}">Tiểu thuyết</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/books/theloai/2') }}">Truyện ngắn - Tản văn</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/books/theloai/3') }}">Tác phẩm kinh điển</a></li>
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