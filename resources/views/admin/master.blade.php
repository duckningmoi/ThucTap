<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="shortcut icon" href="{{ asset('image/favicon.svg')}}" type="image/x-icon">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="image/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                       

                        <li class="sidebar-item  has-sub">
                            <a href="{{route('admin.category.index')}}" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Categories</span>
                            </a>
                            
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a class='sidebar-link' href="{{route('admin.post.index')}}">
                                <i class="bi bi-stack"></i>
                                <span>Products</span>
                            </a>
                          
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Users</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="">List</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="">Create</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-navbar.html">Soft Delete</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Posts</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="">List</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="">Create</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-breadcrumb.html">Soft Delete</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Comments</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="">List</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="">Create</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-breadcrumb.html">Soft Delete</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
    <a style="
    position: fixed;
    bottom: 0;
    left: 3%;
    text-align: center;
    background-color: #f8f9fa; /* Màu nền tùy chỉnh */
    padding: 10px 0; /* Khoảng cách trên dưới */
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); /* Tạo đổ bóng */
    " href="#">Đăng Xuất</a>

<a style="
    position: fixed;
    bottom: 100px;
    left: 3%;
    text-align: center;
    background-color: #f8f9fa; /* Màu nền tùy chỉnh */
    padding: 10px 0; /* Khoảng cách trên dưới */
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); /* Tạo đổ bóng */
    " href="#">Trở lại Website</a>

                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('title')</h3>
            </div>

            <div class="page-content">
            @yield('content')
            </div>

            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('js/pages/dashboard.js')}}"></script>

    {{-- <script src="{{asset('js/main.js')}}"></script> --}}
    @yield('js')
</body>

</html>