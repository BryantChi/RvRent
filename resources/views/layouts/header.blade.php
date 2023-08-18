<div class="container-fluid booking-sale-bg" id="booking-sale">
    <div class="row justify-content-center text-center position-relative">
        <div class="col-auto d-flex py-2 align-items-center sale-content">
            <p class="px-3 my-auto">70% off Relocation Special!</p>
            <a href="{{ route('car_rent') }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Book Now</a>
        </div>
        <span class="btnClose"><i class="fa-solid fa-xmark"></i></span>
    </div>
</div>
<div class="container">
    <!-- Logo container-->
    <div>
        <a class="logo" href="{{ route('index') }}">
            <img src="{{ asset('assets/img/icon/9O_logo_02.png') }}" height="60" alt="">
        </a>
    </div>
    <div class="buy-button">
        @guest
            <a href="{{ route('login') }}" class="text-dark login scroll-down mr-md-2">
                {{-- <i data-feather="user"class="fea icon-ex-md"></i> --}}
                <i class="fa-regular fa-user"></i>
            </a>
        @endguest
        @auth
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"
                class="text-dark login scroll-down mr-md-2">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endauth

        {{-- <a href="" class="btn btn-primary book-seat d-none">Reserve Seat</a> --}}
    </div>
    <!--end login button-->
    <!-- End Logo container-->
    <div class="menu-extras">
        <div class="menu-item">
            <!-- Mobile menu toggle-->
            <a class="navbar-toggle">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <!-- End mobile menu toggle-->
        </div>
    </div>

    <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
            <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="/about">關於我們</a></li>
            <li class="{{ request()->is('car_rent') || request()->is('indexModelSearch') ? 'active' : '' }}">
                <a href="{{ route('car_rent') }}">即刻租車</a></span>
                {{-- <ul class="submenu"><span class="menu-arrow">
                    <li><a href="index.html">Home One</a></li>
                    <li><a href="index-two.html">Home Two</a></li>
                    <li><a href="index-three.html">Home Three</a></li>
                    <li><a href="index-four.html">Home Four</a></li>
                    <li><a href="index-five.html">Home Five</a></li>
                    <li><a href="index-six.html">Home Six</a></li>
                    <li><a href="index-seven.html">Home Seven</a></li>
                </ul> --}}
            </li>

            <li class="{{ request()->is('news') ? 'active' : '' }}">
                <a href="{{ route('news') }}">最新消息</a>
                {{-- <ul class="submenu">
                    <li><a href="page-about.html">About us</a></li>
                    <li><a href="page-services.html">Services</a></li>
                    <li><a href="page-pricing.html">Pricing</a></li>
                    <li><a href="page-benefits.html">Benefits</a></li>
                    <li><a href="page-team.html">Team</a></li>
                    <li><a href="page-faqs.html">FAQs</a></li>
                    <li><a href="page-terms.html">Terms Policy</a></li>
                    <li class="has-submenu">
                        <a href="javascript:void(0)">Blog</a><span class="submenu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="page-blog.html">Blog</a></li>
                            <li><a href="page-blog-sidebar.html">Blog - Sidebar</a></li>
                            <li><a href="page-blog-detail.html">Single Blog</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0)">Auth Pages</a><span class="submenu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="page-login.html">Login</a></li>
                            <li><a href="page-signup.html">Signup</a></li>
                            <li><a href="page-reset-password.html">Reset Password</a></li>
                        </ul>
                    </li>
                    <li><a href="404.html">404</a></li>
                    <li><a href="page-blank.html">Blank Page</a></li>
                </ul> --}}
            </li>

            <li class="/*has-submenu*/">
                <a href="javascript:void(0)">推薦行程</a>
                {{-- <span class="menu-arrow"></span>
                <ul class="submenu">
                    <li><a href="page-spaces.html">All Spaces</a></li>
                    <li><a href="page-spaces-sidebar.html">Spaces - Sidebar</a></li>
                    <li><a href="page-space-detail.html">Space Detail</a></li>
                    <li><a href="page-all-cities.html">All Cities</a></li>
                    <li><a href="page-cities-sidebar.html">Cities - Sidebar</a></li>
                    <li><a href="page-cities-detail.html">Cities Detail</a></li>
                </ul> --}}
            </li>

            <li class="/*has-submenu*/">
                <a href="/contact">聯繫我們</a>
                {{-- <span class="menu-arrow"></span>
                <ul class="submenu">
                    <li><a href="event-over.html">Overview</a></li>
                    <li><a href="event-list.html">Event List</a></li>
                </ul> --}}
            </li>

            {{-- <li><a href="javascript:void(0)">我想買車</a></li> --}}
            <li><a href="/member_center/profile">會員中心</a></li>
        </ul>
        <!--end navigation menu-->
        {{-- <div class="buy-menu-btn d-none">
            <a href="reserve-seat.html" class="btn btn-primary">Reserve Seat</a>
        </div> --}}
        <!--end login button-->
    </div>
    <!--end navigation-->
</div>
<!--end container-->
