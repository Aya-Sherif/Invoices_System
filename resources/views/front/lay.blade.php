<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />




    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="{{ asset('front') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('front') }}/css/media.css">


    <title>smart_plast</title>
</head>

<body>
    <div class="icon d-flex justify-content-center align-items-center rounded-2 position-fixed">
        <i class="fa-solid fa-gear text-white fa-spin"></i>
    </div>
    <header class="vh-100 ">
        <div class="overlay h-100 position-relative">
            <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top ">
                <div class="container ">
                    <a class="navbar-brand" href="#"><img
                            src="{{ asset('front') }}/images/sm_p_images/sm_p_logo2.PNG" class="w-50"
                            alt="smart plast logo" srcset=""></a>
                    <button class="navbar-toggler  " type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto  mb-lg-0">






                            <li class="nav-item me-4 text-end">
                                <a class="nav-link  " aria-current="page" href="#contact">تواصل معنا </a>
                            </li>

                            <li class="nav-item me-4 text-end">
                                <a class="nav-link" href="#blog"> منتجاتنا</a> </a>
                            </li>
                            <li class="nav-item me-4 text-end">
                                <a class="nav-link" href="#message">رسالتنا </a>
                              </li>
                            <li class="nav-item me-4 text-end">
                                <a class="nav-link" href="#about">من نحن ؟</a>
                            </li>
                            <li class="nav-item me-4 text-end">
                                <a class="nav-link " href="#">الصفحة الرئيسية </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div
                class="content  top-50 start-50 translate-middle h-100  position-absolute d-flex justify-content-center align-items-center flex-column">


                <h1 class="text-center my-3 fw-bold  ">سمارت بلاست</h1>
                <h3 class="text-center"> أنت شريك النجاح بجد</h3>


                <div class="line mb-2"></div>
            </div>
        </div>
        </div>
    </header>
    @yield('content')

    <script src="{{ asset('front') }}/js/bootstrap.bundle.min.js"></script>
</body>

</html>
