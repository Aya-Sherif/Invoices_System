<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Stylesheets -->
    <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/icon.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/ar.css" rel="stylesheet" class="lang_css arabic">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (necessary for Select2 to work) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row header_section">
            <!-- Logo and Menu Toggle -->
            <div class="col-sm-3 col-xs-12 logo_area bring_right">
                <h1 class="inline-block">
                  لوحة تحكم
                </h1>
                <span class="glyphicon glyphicon-menu-hamburger bring_left open_close_menu" data-toggle="tooltip"
                    data-placement="right" title="فتح/إغلاق القائمة"></span>
            </div>
            {{-- 
            Uncomment this block if needed for additional header buttons 
            <div class="col-sm-3 col-xs-12 head_buttons_area bring_right hidden-xs">
                <div class="inline-block messages bring_right">
                    <span class="glyphicon glyphicon-envelope" data-toggle="tooltip" data-placement="left"
                        title="الرسائل"><span class="notifications">9</span></span>
                </div>
                <div class="inline-block full_screen bring_right hidden-xs">
                    <span class="glyphicon glyphicon-fullscreen" data-toggle="tooltip" data-placement="left"
                        title="شاشة كاملة"></span>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12 user_header_area bring_left left_text">
                <a href="index-en.html" class="change_lang bring_left">EN</a>
                <div class="user_info inline-block">
                    <img src="img/user.jpg" alt="User" class="img-circle">
                    <span class="h4 nomargin user_name">Hosam Zewain</span>
                    <span class="glyphicon glyphicon-cog"></span>
                </div>
            </div>
            --}}
        </div>
        <!-- End Header Section -->

        <!-- Sidebar -->
        <div class="main_sidebar bring_right">
            <div class="main_sidebar_wrapper">
                <form class="form-inline search_box text-center">
                    <div class="form-group">
                        <!-- Search box (if needed) -->
                    </div>
                </form>
                <ul>
                    {{-- Admin Menu --}}
                    @if (auth()->user()->role == 'admin')
                        <li><span class="glyphicon glyphicon-home"></span><a href="{{ route('users.index') }}">الصفحة الرئيسية</a></li>
                        <li><span class="glyphicon glyphicon-th-list"></span><a href="#">إدارة المنتجات</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ route('product.create') }}">إضافة منتج</a></li>
                                <li><a href="{{ route('productdetails.create') }}">إضافة بيانات المنتج</a></li>
                                <li><a href="{{ route('productdetails.index') }}">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-user"></span><a href="#">إدارة العملاء</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ route('client.create') }}">إضافة جديد</a></li>
                                <li><a href="{{ route('client.index') }}">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-user"></span><a href="#">إدارة الأعضاء</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ route('user.create') }}">إضافة جديد</a></li>
                                <li><a href="{{ route('user.index') }}">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-file"></span><a href="{{ route('invoice.index') }}">الفواتير</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ route('invoice.create') }}">إضافة جديد</a></li>
                                <li><a href="{{ route('invoice.index') }}">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-file"></span><a href="{{ route('contacts.index') }}">رسائل العملاء</a></li>

                    @elseif (auth()->user()->role == 'sales')
                        <li><span class="glyphicon glyphicon-list-alt"></span><a href="{{ route('invoice.create') }}">إضافة فاتورة</a></li>
                        <li><span class="glyphicon glyphicon-th-large"></span><a href="{{ route('productdetails.index') }}">عرض المنتجات</a></li>
                    @elseif (auth()->user()->role == 'stock')
                        <li><span class="glyphicon glyphicon-file"></span><a href="{{ route('invoice.index') }}">الفواتير</a></li>
                    @elseif (auth()->user()->role == 'accounts')
                        <li><span class="glyphicon glyphicon-th-list"></span><a href="#">إدارة المنتجات</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ route('product.create') }}">إضافة منتج</a></li>
                                <li><a href="{{ route('productdetails.create') }}">إضافة بيانات المنتج</a></li>
                                <li><a href="{{ route('productdetails.index') }}">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-user"></span><a href="#">إدارة العملاء</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ route('client.create') }}">إضافة جديد</a></li>
                                <li><a href="{{ route('client.index') }}">عرض الكل</a></li>
                            </ul>
                        </li>
                        <li><span class="glyphicon glyphicon-file"></span><a href="{{ route('invoice.index') }}">الفواتير</a>
                            <ul class="drop_main_menu">
                                <li><a href="{{ route('invoice.create') }}">إضافة جديد</a></li>
                                <li><a href="{{ route('invoice.index') }}">عرض الكل</a></li>
                            </ul>
                        </li>
                    @endif

                
                    <!-- Logout Item -->
                    <li>
                        <span class="glyphicon glyphicon-log-out"></span>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>
                
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        @yield('content')
        <!-- End Main Content -->

        <!-- JavaScript -->
        <script src="{{ asset('admin') }}/js/jquery-2.1.4.min.js"></script>
        <script src="{{ asset('admin') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('admin') }}/js/js.js"></script>
    </div>
</body>

</html>
