@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h3>選擇加購方案</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4 style="color: #ff832b">1 - 額外公里數優惠套餐</h4>
                    <p>租金內含100公里/晚，如未事先加購公里套餐或已加購仍超出限定里程每一公里收取新台幣$80</p>
                </div>
                <div class="col-12">
                    <div id="radio">
                        <label><input type="radio" name="label" value="台劇" checked="checked">
                            <p class="round button">
                                50公里內<br>
                                <span class="h2 text-danger">$1800</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="古裝劇">
                            <p class="round button">
                                100公里內<br>
                                <span class="h2 text-danger">$3000</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="陸劇">
                            <p class="round button">
                                200公里內<br>
                                <span class="h2 text-danger">$5000</span>
                            </p>
                        </label>
                    </div>
                </div>
            </div>

            <hr style="background-color: #ff832b">

            <div class="row">
                <div class="col-12">
                    <h4 style="color: #ff832b">2 - 露營設備套餐</h4>
                </div>
                <div class="col-12">
                    <div class="equipment-box p-3">
                        <div class="justify-content-evely d-flex">
                            <div class="form-check align-items-center">
                                <input class="form-check-input h5" type="checkbox" value="HEMKOMST鍋具 + 餐具套組"
                                    id="flexCheckDefault">
                                <label class="form-check-label h5 my-auto" for="flexCheckDefault">
                                    HEMKOMST鍋具 + 餐具套組
                                </label>
                            </div>
                            <div class="d-flex ml-auto">
                                <p class="d-flex align-items-center justify-content-end">
                                    租借數量
                                    <input type="number" value="1" class="form-control" style="width: 20% !important;" aria-label="Text input with checkbox">
                                    組
                                </p>
                                <p class="h3 text-danger px-3">
                                    $500
                                </p>
                            </div>
                        </div>
                        <div class="px-4">
                            <div class="d-flex">
                                <p class="" style="min-width: 100px;">項目</p>
                                <p class>數量</p>
                            </div>
                            <hr>
                            <div class="d-flex">
                                <p class="" style="min-width: 100px;">2L鍋</p>
                                <p class>1</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <hr style="background-color: #ff832b">

            <div class="row justify-content-end px-3">
                <p style="color: #ff832b">合計 <span class="h3 text-danger">$12439</span></p>
            </div>

            <div class="row justify-content-center">
                <a href="{{ route('car_rent_s3') }}" class="btn btn-primary2">下一步</a>
            </div>

        </div>
    </section>
    <style>
        #radio input[type="radio"] {
            display: none;
        }

        #radio input:checked+.button {
            border: 1px solid #e82222;
            color: #333;
            /* color: #fff; */
            cursor: default;
        }

        #radio .button {
            display: inline-block;
            margin: 0 20px 15px 0;
            padding: 15px 25px;
            /* background: #f7f7f7; */
            border: 1px solid #eeeeee;
            color: #333;
            cursor: pointer;
        }

        #radio .button:hover {
            background: rgb(255, 193, 146);
            /* border: 1px solid #f7f7f7 */
            color: #f7f7f7;
            /* color: #fff; */
        }

        #radio .round {
            border-radius: 5px;
        }

        .equipment-box {
            background-color: #fff7e899;
            border: 1px solid #b7b7b7a2;
            border-radius: 10px
        }
    </style>
@endsection
