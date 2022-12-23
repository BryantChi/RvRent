<!DOCTYPE html>
<html lang="zh_TW">

<head>
    <meta charset="utf-8" />
    <title>9o旅行家</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta content="" name="author" />
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico.png">
    <!-- Bootstrap css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{ asset('assets/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <!-- Main css File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Loader Start -->
    <div id="preloader">
        <div id="status">
            <div class="logo">
                <img src="{{ asset('assets/img/icon/9O_logo.png') }}" height="100" class="d-block mx-auto"
                    alt="">
            </div>
        </div>
    </div>
    <!-- Loader End -->

    <!-- Back to home Start -->
    <div class="back-to-home rounded d-none d-sm-block">
        <a href="{{ route('index') }}" class="text-white rounded d-inline-block text-center"><i data-feather="home"
                class="fea icon-sm"></i></a>
    </div>
    <!-- Back to home End -->

    @yield('content')

    <!-- javascript -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspy.min.js') }}"></script>
    <!-- Icon -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
