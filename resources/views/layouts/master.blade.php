<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>9o旅行家</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta content="" name="author" />
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico.png">
    {{-- <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Icons -->
    <link href="{{ asset('assets/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <!-- Icons -->
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <!-- Date picker -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/flatpickr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.1/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/zh-tw.js"></script>
    <!-- Slider -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}" />
    <!-- font-awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"
        integrity="sha512-yFjZbTYRCJodnuyGlsKamNE/LlEaEAxSUDe5+u61mV8zzqJVFOH7TnULE2/PP/l5vKWpUNnF4VGVkXh3MjgLsg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main css File -->
    <link href="{{ asset('assets/css/style.css') }}?v=20230213" rel="stylesheet" type="text/css" />
    @if (request()->is('car_rent*') || request()->is('indexModelSearch*'))
        <link href="{{ asset('assets/css/car_rent.css') }}?v=20230213" rel="stylesheet" />
    @endif
    @if (request()->is('news*'))
        <link href="{{ asset('assets/css/news.css') }}?v=20230213" rel="stylesheet" />
    @endif
    <link href="{{ asset('assets/css/footer.css') }}?v=20230213" rel="stylesheet" type="text/css" />
    @stack('css')
</head>

<body>
    <!-- Loader Start -->
    <div id="preloader">
        <div id="status">
            <div class="logo">
                <img src="{{ asset('assets/img/icon/9O_logo_02.png') }}" height="100" class="d-block mx-auto"
                    alt="">
            </div>
        </div>
    </div>
    <!-- Loader End -->

    <!-- Navbar STart -->
    <header id="topnav" class="defaultscroll sticky fixed-top bg-white">
        @include('layouts.header')
    </header>
    <!--end header-->
    <!-- Navbar End -->

    @yield('content_section')

    <!-- Footer Start -->
    @include('layouts.footer')
    <!-- Footer End -->

    <div class="social-link d-grid text-center pb-2">
        @auth
        <a href="">
            <div>
                <img src="{{ asset('assets/img/icon/icon_line icon.png') }}" width="35px" alt="">
            </div>
        </a>
        @endauth
        <a href="">
            <div>
                <img src="{{ asset('assets/img/icon/icon_messanger.png') }}" width="35px" alt="">
            </div>
        </a>
        <a href="">
            <div class="position-relative">
                <span class="cart-num">2</span>
                <img src="{{ asset('assets/img/icon/icon_buy.png') }}" width="35px" alt="">
            </div>
        </a>
    </div>

    <div class="loadingdiv" id="loading" style="display: none">
        <img src="{{ asset('assets/img/icon/9O_logo_03.png') }}" height="100" />
    </div>

    <!-- Back to top -->
    <a href="#" class="btn btn-icon btn-primary3 back-to-top"><i data-feather="arrow-up" class="icons"></i></a>
    <!-- Back to top -->

    <!-- javascript -->

    {{-- <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspy.min.js') }}"></script>
    <!-- Magnific popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/portfolio.init.js') }}"></script>
    <script src="{{ asset('assets/js/magnific.init.js') }}"></script>
    <!-- Icon -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <!-- Datepicker -->
    {{-- <script src="{{ asset('assets/js/flatpickr.min.js') }}"></script> --}}


    <script src="{{ asset('assets/js/flatpickr.init.js') }}"></script>
    <!-- SLIDER -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.init.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.1.18/jquery.backstretch.js"
        integrity="sha512-hnO4ypSVsbX/EBMaO/auYhsgRSSWftlgxCsJjqIHWUIGeAQWefevOlG8OrnopZ7eDER+xn/rOtSXqSWHkvxsOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ asset('assets/js/backstretch.init.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js "></script>
    <!-- Main Js -->
    <script src="{{ asset('assets/js/app.js') }}?v=20230213"></script>
    <script>
        $(function() {
            $('.hero-slick').slick({
                arrows: false,
                dots: false,
                speed: 300,
                autoplay: true,
                centerPadding: '100px',
                autoplaySpeed: 2000,
                slidesToShow: 1,
                slidesToScroll: 1,
                draggable: true
            });
            //     var width = $(window).width();
            //     if (width >= 768) {
            //         $("#hero").backstretch(
            //             [
            //                 "<?php echo asset('assets/img/hero/首頁模擬1-背景圖.jpg'); ?>",
            //                 "<?php echo asset('assets/img/hero/首頁模擬2-背景圖.jpg'); ?>",
            //                 "<?php echo asset('assets/img/hero/首頁模擬4-背景圖.jpg'); ?>",
            //                 "<?php echo asset('assets/img/hero/首頁模擬5-背景圖.jpg'); ?>",
            //                 "<?php echo asset('assets/img/hero/首頁模擬7-背景圖.jpg'); ?>",
            //             ], {
            //                 duration: 3000,
            //                 fade: 750,
            //             }
            //         );
            //     } else {
            //         $("#hero").backstretch(
            //             [
            //                 "<?php echo asset('assets/img/hero/手機模擬1-背景圖.jpg'); ?>",
            //                 "<?php echo asset('assets/img/hero/手機模擬2-背景圖.jpg'); ?>",
            //                 "<?php echo asset('assets/img/hero/手機模擬4-背景圖.jpg'); ?>",
            //                 "<?php echo asset('assets/img/hero/手機模擬5-背景圖.jpg'); ?>",
            //             ], {
            //                 duration: 3000,
            //                 fade: 750,
            //             }
            //         );
            //     }

            //     $(document).ready(function() {
            //         $(window).resize(function() {
            //             var width = $(window).width();
            //             if (width >= 768) {
            //                 $("#hero").backstretch(
            //                     [
            //                         "<?php echo asset('assets/img/hero/首頁模擬1-背景圖.jpg'); ?>",
            //                         "<?php echo asset('assets/img/hero/首頁模擬2-背景圖.jpg'); ?>",
            //                         "<?php echo asset('assets/img/hero/首頁模擬4-背景圖.jpg'); ?>",
            //                         "<?php echo asset('assets/img/hero/首頁模擬5-背景圖.jpg'); ?>",
            //                         "<?php echo asset('assets/img/hero/首頁模擬7-背景圖.jpg'); ?>",
            //                     ], {
            //                         duration: 3000,
            //                         fade: 750,
            //                     }
            //                 );
            //             } else {
            //                 $("#hero").backstretch(
            //                     [
            //                         "<?php echo asset('assets/img/hero/手機模擬1-背景圖.jpg'); ?>",
            //                         "<?php echo asset('assets/img/hero/手機模擬2-背景圖.jpg'); ?>",
            //                         "<?php echo asset('assets/img/hero/手機模擬4-背景圖.jpg'); ?>",
            //                         "<?php echo asset('assets/img/hero/手機模擬5-背景圖.jpg'); ?>",
            //                     ], {
            //                         duration: 3000,
            //                         fade: 750,
            //                     }
            //                 );
            //             }
            //         });
            //     });
        });
    </script>

    @stack('scripts')
</body>

</html>
