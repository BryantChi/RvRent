@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container" style="overflow: hidden;">
            <div class="row">
                <div class="col-md-3">
                    <form class="">
                        <h4 class="mb-3">搜尋旅程</h4>
                        <div class="row justify-content-center align-content-center p-0 m-0 g-0">
                            <div class="col-md-12 col-5 p-md-1 p-0">
                                <div class="form-group mb-4 mb-md-0">
                                    <label class="d-block"><span style="letter-spacing: 8px;">租車</span>地 <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control custom-select">
                                        <option selected value="台中">台中</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4 mb-md-0">
                                    <label class="d-block"> 日期/時間 : </label>
                                    <input name="date" type="text" class="flatpickr flatpickr-input form-control"
                                        id="checkin-date">
                                </div>
                            </div>
                            <div class="col-md-12 col-1">
                                <div class="liner"></div>
                            </div>
                            <div class="col-md-12 col-5 p-md-1 p-0">
                                <div class="form-group mb-4 mb-md-0">
                                    <label class="d-block"><span style="letter-spacing: 8px;">還車</span>地 <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control custom-select">
                                        <option selected value="台中">台中</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4 mb-md-0">
                                    <label class="d-block"> 日期/時間 : </label>
                                    <input name="date" type="text" class="flatpickr flatpickr-input form-control"
                                        id="checkin-date2">
                                </div>
                            </div>
                            <div class="col-md-12 text-center align-self-center mt-md-3">
                                <a href="" class="btn btn-primary3 w-100"> 搜尋 </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">
                    <div class="row mt-5 w-100 p-0 m-0">
                        <div class="row rv_item_box rounded mb-3 position-relative p-0 m-0 w-100"
                            style="border: 1px solid #e0e0e0;">
                            <div class="col-md-4">
                                <div class="item-img">
                                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid"
                                        alt="9otravel">
                                </div>
                            </div>
                            <div class="col-md-8 align-self-center py-3">
                                <div class="row g-0 w-75 mx-auto">
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 自排</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 95汽油</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 4人</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 車頂床</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 冰箱40L</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 洗手台</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 瓦斯爐</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 冷暖空調</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 蓮蓬頭</span>
                                    </div>
                                </div>

                            </div>

                            <div class="recommend-icon">
                                <i class="recommend-container"></i>
                                <p class="text-center">
                                    <span class="d-block">租車次數</span>
                                    <span class="d-block"><i class="fa-solid fa-caravan"></i> 21</span>
                                </p>
                            </div>

                            <div class="rent-action px-md-0 px-2 py-md-0 py-3">
                                <div class="row justify-content-end p-0 m-0">
                                    <p>Strating at &nbsp;<span style="color: #f7c000">$8000/day</span></p>
                                    <div class="col-12 justify-content-end d-flex p-0">
                                        <a href="{{ route('car_rent_s2') }}" class="btn btn-primary3 ml-2"><i
                                                class="fa-solid fa-cart-shopping"></i> 選擇</a>
                                        <a href="" class="btn btn-primary3 ml-2 text-uppercase">learn more</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row rv_item_box rounded mb-3 position-relative p-0 m-0 w-100"
                            style="border: 1px solid #e0e0e0;">
                            <div class="col-md-4">
                                <div class="item-img">
                                    <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid"
                                        alt="9otravel">
                                </div>
                            </div>
                            <div class="col-md-8 align-self-center py-3">
                                <div class="row g-0 w-75 mx-auto">
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 自排</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 95汽油</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 4人</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 車頂床</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 冰箱40L</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 洗手台</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 瓦斯爐</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 冷暖空調</span>
                                    </div>
                                    <div class="col-md-4 col-6 my-2" style="color: #f7c000">
                                        <span><i class="fa-solid fa-fire"></i> 蓮蓬頭</span>
                                    </div>
                                </div>

                            </div>

                            <div class="recommend-icon">
                                <i class="recommend-container"></i>
                                <p class="text-center">
                                    <span class="d-block">租車次數</span>
                                    <span class="d-block"><i class="fa-solid fa-caravan"></i> 21</span>
                                </p>
                            </div>

                            <div class="rent-action px-md-0 px-2 py-md-0 py-3">
                                <div class="row justify-content-end p-0 m-0">
                                    <p>Strating at &nbsp;<span style="color: #f7c000">$8000/day</span></p>
                                    <div class="col-12 justify-content-end d-flex p-0">
                                        <a href="{{ route('car_rent_s2') }}" class="btn btn-primary3 ml-2"><i
                                                class="fa-solid fa-cart-shopping"></i> 選擇</a>
                                        <a href="" class="btn btn-primary3 ml-2 text-uppercase">learn more</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




        </div>
    </section>

    <style>
        .recommend-icon {
            position: absolute;
            right: -108px;
            top: -20px;
            transform: rotateZ(45deg);
        }

        .recommend-container {
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 100px 100px 100px;
            border-color: transparent transparent #1c466f transparent;
        }

        .recommend-icon p {
            position: absolute;
            top: 60px;
            right: 60px;
            display: inline-block;
            /* width: 50px; */
            color: #FFF;
            transform: rotateZ(-45deg);
        }

        .rent-action {
            position: absolute;
            bottom: 20px;
            right: 50px;
        }

        .rv_item_box {
            padding-bottom: 5.5rem !important;
        }

        .liner {
            margin: 20px 0px;
            width: 100%;
            height: 1px;
            background-color: rgb(60, 60, 60, 0.5);
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .rv_item_box {
                padding-bottom: 6.5rem !important;
            }
        }

        @media (max-width: 768px) {
            .rv_item_box {
                padding-bottom: unset !important;
            }

            .rent-action {
                position: unset;
            }

            .liner {
                margin: 10px 0px !important;
                width: 1px;
                height: 80%;
            }
        }
    </style>
@endsection
