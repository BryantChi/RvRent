@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    @include('layouts.rent_step_bar')

    <section class="section">
        <div class="container">
            {{-- <div class="section-title mx-auto text-center">
                <h2>露營車租賃契約書</h2>
            </div> --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="rent-result text-white bg-warning p-3 rounded">
                        <img src="{{ asset('assets/img/icon/rv-icon/1.png') }}" class="img-fluid"alt="{{ __('') }}">
                        <h4 class="mb-3">預定旅程 <i class="fa-solid fa-caravan"></i></h4>
                        <div class="" >
                            <p>
                                出發：台中・2022/01/01・下午02:00 <br/>
                                回程：台中・2022/01/03・上午11:00
                            </p>
                            <p>
                                金額：NT$ <span class="h4">8,800</span>
                            </p>
                        </div>
                        <hr style="background-color: #fff">
                        <div>
                            <p class="text-center">
                                內含明細
                            </p>
                            <p>
                                保險x4<br>
                                清潔費
                            </p>
                        </div>
                        <hr style="background-color: #fff">
                        <div>
                            <p class="text-center">
                                加購明細
                            </p>
                            <div class="d-flex">
                                <p>
                                    寢具
                                </p>
                                <p class="ml-auto">
                                    NT$500
                                </p>
                            </div>
                            <div class="d-flex">
                                <p>
                                    餐具
                                </p>
                                <p class="ml-auto">
                                    NT$1,500
                                </p>
                            </div>
                        </div>
                        <hr style="background-color: #fff">
                        <div>
                            <p class="text-center">
                                優惠序號
                            </p>
                            <div class="d-flex">
                                <p>
                                    十月國慶歡樂遊優惠
                                </p>
                                <p class="ml-auto">
                                    NT$200
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <h3 class="text-danger h2">XXX露營車</h3>
                    <h5 class="text-warning">承租人資料</h5>

                    <hr style="background-color: #f0a000">

                    <h3 class="text-danger h2">XXX露營車</h3>
                    <h5 class="text-warning">司機資料</h5>


                    <hr style="background-color: #f0a000">

                    <div class="row justify-content-center">
                        <a href="{{ route('car_rent_s5') }}" class="btn btn-primary3">送出</a>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection
