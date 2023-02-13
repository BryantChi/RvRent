<!-- Hero Start -->
<section class="bg-half-150 d-table w-100 position-relative"
    style="/*background: url('{{ asset('assets/images/home/pages.jpg') }}') center 36%;*/">
    {{-- <div class="bg-overlay" style="background-image: url('{{ asset('assets/images/bg.png') }}')"></div> --}}

    <div class="h-100 w-100 d-none d-md-block /*mt-md-6 mt-74*/ sub-hero">
        @if ($pageInfo->banner_img != '')
            <img src="{{ env('APP_URL') . '/uploads/' . $pageInfo->banner_img }}" class="img-fluid hero-img" alt="">
        @else
            <img src="{{ asset('assets/images/home/pages.jpg') }}" class="img-fluid hero-img" alt="">
        @endif
    </div>

    <div class="h-100 w-100 d-block d-md-none /*mt-md-6 mt-74*/ sub-hero" style="height: 100vmax">
        @if ($pageInfo->banner_img_mob != '')
            <img src="{{ env('APP_URL') . '/uploads/' . $pageInfo->banner_img_mob }}" class="img-fluid hero-img" alt="">
        @else
            <img src="{{ asset('assets/images/home/pages.jpg') }}" class="img-fluid hero-img" alt="">
        @endif
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="title-heading justify-content-center align-items-end">
                    <h3 class="text-white pt-5 mt-5">{{ $title }}</h3>
                    <div class="breadcrumb-position">
                        <nav aria-label="breadcrumb" class="d-inline-block">
                            <ul class="breadcrumb bg-white rounded shadow-md mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">9oTravel</a></li>
                                <li class="breadcrumb-item"><a href="#">Page</a></li>
                                <li class="breadcrumb-item active" aria-current="page"
                                    style="text-transform: capitalize;">{{ $title }}</li>
                                {{-- {{ request()->route()->getName() }} --}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Hero End -->
