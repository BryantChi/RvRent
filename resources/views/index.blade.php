@extends('layouts.master')

@section('content_section')
    <!-- Hero Start -->
    @include('layouts.hero')
    <!-- Hero End -->

    <section class="section pt-3" id="newcar">
        <div class="container">
            <div class="section-title text-center mb-2 pb-2">
                <h4 class="title mb-4">最新車款</h4>
            </div>
            <div class="row justify-content-center m-0 text-center owl-carousel owl-theme" id="client-testi">
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
                <div class="col-md-12">
                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid" alt="">
                    <h5>Cliff 600TR</h5>
                </div>
            </div>
            <div class="row justify-content-end mt-5">
                <div class="col-auto d-flex more-car">
                    <a class="d-flex" href="">
                        <div class="line mx-3 my-auto"></div>
                        <p class="my-auto">更多車型</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-secondary">
        <div class="container-fluid">
            <div class="row mx-md-3">
                <div class="col-md-4 mb-4" style="overflow: hidden;">
                    <div class="middle-menu-item item-1 position-relative">
                        <div class="middle-menu-txt text-center">
                            <h3>NEWS</h3>
                            <a class="btn btn-primary3" href="{{ route('news') }}">Learn More</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 mb-4" style="overflow: hidden;">
                    <div class="middle-menu-item item-2 position-relative">
                        <div class="middle-menu-txt text-center" style="transform: translate(-50%, -33%) !important;">
                            <h3>推薦行程</h3>
                            <a class="btn btn-primary3" href="">Learn More</a>
                            <p class="text-light mt-3">特約營地 / 行程規劃</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" style="overflow: hidden;">
                    <div class="middle-menu-item item-3 position-relative">
                        <div class="middle-menu-txt text-center">
                            <h3>租車見證</h3>
                            <a class="btn btn-primary3" href="">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
