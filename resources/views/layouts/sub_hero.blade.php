<!-- Hero Start -->
<section class="bg-half-200 d-table w-100" style="background: url('{{ asset('assets/images/home/pages.jpg') }}') center 36%;">
    <div class="bg-overlay" style="background-image: url('{{ asset('assets/images/bg.png') }}')"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="title-heading">
                    <h3 class="text-white">{{ $title }}</h3>
                    <div class="breadcrumb-position">
                        <nav aria-label="breadcrumb" class="d-inline-block">
                            <ul class="breadcrumb bg-white rounded shadow-md mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">9oTravel</a></li>
                                <li class="breadcrumb-item"><a href="#">Page</a></li>
                                <li class="breadcrumb-item active" aria-current="page" style="text-transform: capitalize;">{{ $title }}</li>
                                {{-- {{ request()->route()->getName() }} --}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Hero End -->
