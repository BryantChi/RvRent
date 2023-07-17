@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    @include('layouts.rent_step_bar')

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h3>選擇加購方案</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4 style="color: #f0a000">1 - 額外公里數優惠套餐</h4>
                    <p>租金內含100公里/晚，如未事先加購公里套餐或已加購仍超出限定里程每一公里收取新台幣$80</p>
                </div>
                <div class="col-12 justify-content-md-start justify-content-center">
                    <div id="radio">
                        <label><input type="radio" name="label" value="1800">
                            <p class="round button">
                                50公里內<br>
                                <span class="h2 text-danger">$1800</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="3000">
                            <p class="round button">
                                100公里內<br>
                                <span class="h2 text-danger">$3000</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="5000">
                            <p class="round button">
                                200公里內<br>
                                <span class="h2 text-danger">$5000</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="0" checked>
                            <p class="round button">
                                <span class="h5 text-dark">無需<br>加購</span>
                            </p>
                        </label>
                    </div>
                </div>
            </div>

            <hr style="background-color: #f0a000">

            {{-- @if (count($accessory) > 0) --}}
            <div class="row">
                <div class="col-12">
                    <h4 style="color: #f0a000">2 - 露營設備套餐</h4>
                </div>
                <div class="col-12">
                    @foreach ($accessory as $equipment)

                    @if ($equipment->accessory_quantity > 0)
                    <div class="equipment-box p-3 mb-3">
                        <div class="justify-content-evely align-items-center d-md-flex equipment-title-box">
                            <div class="form-check align-self-center">
                                <input class="form-check-input h5 mt-2 equipment-item" type="checkbox" value="{{ $equipment->id }}"
                                data-equipmentamount="{{ $equipment->accessory_rent_price }}"
                                data-amount="{{ $equipment->accessory_rent_price }}"
                                    id="equipment-item-{{ $equipment->id }}">
                                <label class="form-check-label h5 my-0 equipment-item-title" for="equipment-item-{{ $equipment->id }}">
                                    {{ $equipment->accessory_name }}
                                </label>
                            </div>
                            <div class="d-flex justify-content-end align-items-center ml-auto mt-md-auto mt-3">
                                <p class="d-flex align-items-center justify-content-end my-0">
                                    租借數量
                                    <input type="number" min="1" value="1" max="{{ $equipment->accessory_quantity }}" id="equipment-item-count" class="form-control mx-1" style="width: auto !important;">
                                    組
                                </p>
                                <p class="h3 px-3 my-0 equipment-item-amount" style="color: #ea3c06;">
                                    ${{ $equipment->accessory_rent_price }}
                                </p>
                                <p class="my-auto equipment-drop"
                                data-toggle="popover" data-container="body" data-trigger="hover" data-placement="top" data-content="點擊查看詳細項目">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </p>
                            </div>
                        </div>
                        <div class="px-4 equipment-detail">
                            <div class="d-flex justify-content-between mt-5">
                                <p class="" style="min-width: 100px;">項目</p>
                                <p class>數量</p>
                            </div>
                            <hr>
                            @foreach (json_decode($equipment->accessory_specification) as $spec)
                            <div class="d-flex justify-content-between">
                                <p class="" style="min-width: 100px;">{{ $spec->item }}</p>
                                <p class>{{ $spec->count }}</p>
                            </div>
                            @endforeach

                        </div>

                    </div>
                    @endif

                    @endforeach
                </div>
            </div>

            <hr style="background-color: #f0a000">

            {{-- @endif --}}

            {{-- {{ var_dump($rent_amount_setting) }} --}}
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <h4 class="mr-2" style="color: #f0a000">3 - 其他</h4>
                    <span>(必選*)</span>
                </div>
                <div class="col-12">

                    @foreach (json_decode($rent_amount_setting['other_price']) as $op_item)

                    <div class="other-box p-3 mb-3">
                        <div class="justify-content-evely align-items-center d-md-flex other-title-box px-3">
                            <div class="d-flex align-items-center" style="color: #f0a000">
                                <p class="mr-3 mb-0"><i class="fa-regular fa-circle-check"></i></p>
                                <h5 class="mb-0">{{ $op_item->item }}</h5>
                            </div>
                            <div class="d-flex justify-content-end align-items-center ml-auto mt-md-auto mt-3">
                                <p class="h3 px-3 my-0 other-item-amount" style="color: #ea3c06;"
                                data-other-item-amount="{{ (Int) $op_item->price }}"
                                data-other-item-type="{{ $op_item->type }}" >
                                    ${{ (Int) $op_item->price }}{!! $op_item->type == 'night' ? ' / <span class="h4">天</span>' : '' !!}
                                </p>
                                {{-- <p class="my-auto other-drop"
                                data-toggle="popover" data-container="body" data-trigger="hover" data-placement="top" data-content="點擊查看詳細項目">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </p> --}}
                            </div>
                        </div>
                        {{-- <div class="px-4 other-detail">
                            <div class="d-flex justify-content-between mt-5">
                                <p class="" style="min-width: 100px;">項目</p>
                                <p class>數量</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="" style="min-width: 100px;">xxx</p>
                                <p class>1</p>
                            </div>

                        </div> --}}

                    </div>

                    @endforeach

                </div>
            </div>

            <hr style="background-color: #f0a000">

            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <h4 class="mr-2" style="color: #f0a000">4 - 基礎費用</h4>
                    <span>(必選*)</span>
                </div>
                <div class="col-12">
                    <div class="other-box p-3 mb-3">
                        <div class="justify-content-evely align-items-center d-md-flex px-3">
                            <div class="d-flex align-items-center" style="color: #f0a000">
                                <p class="mr-3 mb-0"><i class="fa-regular fa-circle-check"></i></p>
                                <h5 class="mb-0">租金</h5>
                            </div>
                            <div class="d-flex justify-content-end align-items-center ml-auto mt-md-auto mt-3">
                                <p class="h3 px-3 my-0 d-block" style="color: #ea3c06;" >
                                    ${{ (Int) $rent_amount_setting["rental"] }} / <span class="h4">晚</span>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center px-3">
                            <p class="h5 px-3 mt-3 ml-auto">天數： <span style="color: #ea3c06;">{{ (Int) $rent_amount_setting["day"] }}</span> <span class="h4">晚</span></p>
                        </div>
                    </div>

                </div>
            </div>

            <hr style="background-color: #f0a000">

            <div class="row justify-content-end px-3">
                <p style="color: #f0a000">合計 <span class="h3 order-price" style="color: #ea3c06;" data-other-item-day="{{ (Int) $rent_amount_setting["day"] }}" data-order-price="{{ $rent_amount_setting["rental"] != null ? $rent_amount_setting["rental"] : $model->base_price }}" >${{ $rent_amount_setting["rental"] != null ? $rent_amount_setting["rental"] : $model->base_price }}</span></p>
            </div>

            <div class="row justify-content-center">
                <a href="{{ route('car_rent_s3') }}" class="btn btn-primary3">下一步</a>
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
            border: 1px solid #cccccc;
            color: #333;
            cursor: pointer;
        }

        #radio .button:hover {
            background: rgb(255, 225, 202);
            /* border: 1px solid #f7f7f7 */
            color: #f7f7f7;
            /* color: #fff; */
        }

        #radio .round {
            border-radius: 5px;
        }

        .equipment-box {
            /* background-color: #fff7e899; */
            background-color: #fdfaf5;
            /* border: 1px solid #b7b7b7a2; */
            border: 1px solid #b7b7b7a2;
            border-radius: 10px
        }
        .equipment-item-title {
            color: #4d4d4d;
        }

        .other-box {
            /* background-color: #fff7e899; */
            background-color: #fdfaf5;
            /* border: 1px solid #b7b7b7a2; */
            border: 1px solid #b7b7b7a2;
            border-radius: 10px
        }
        .other-item-title {
            color: #4d4d4d;
        }
    </style>
    <script>
        var values = null;
        var values2 = null;
        var day = parseInt($('.order-price').data('otherItemDay'));
        var tt = 0;
        var ot = 0;
        var bt = parseInt($('.order-price').data('orderPrice')) * day;
        var at = parseInt($('input[name=label]:checked').val());

        getOtherPrice();
        setOrderPrice();

        $('.equipment-box').each(function() {
            $(this).find('.equipment-detail').toggle('hide');
            $(this).find('.equipment-drop').click(function() {
                $(this).parent().parent().parent().find('.equipment-detail').toggle(600);
                // $(this).popover('hide');
                // $(this).popover('disable');
            });

            if ($(window).width() < 768) {
                $(this).find('.equipment-drop').popover('show');
                $(this).find('.equipment-drop').click(function() {
                    $(this).popover('hide');
                    $(this).popover('disable');
                });
            }
            $(this).find('#equipment-item-count').change(function() {
                if(parseInt($(this).val()) > parseInt($(this).attr('max'))) {
                    $(this).val($(this).attr('max'));
                }
                var count = $(this).val();
                var amount = $(this).parent().parent().parent().find('.equipment-item').data('equipmentamount');
                var total = count*amount;

                $(this).parent().parent().find('.equipment-item-amount').html('$' + total);

                $(this).parent().parent().parent().find('.equipment-item').data('amount', total);

                getCheckboxPrice();

            });

        });

        $('input[name=label]').change(function() {
            at = parseInt($('input[name=label]:checked').val());

            setOrderPrice();
        });

        $('.equipment-box').find('.equipment-item[type=checkbox]').change(function() {
            getCheckboxPrice();
        })


        function getCheckboxPrice() {
            values = null;
            tt = 0;
            // 取得所有金額
            values = $('.equipment-box').find('.equipment-item[type=checkbox]:checked').map(function() {
                return $(this).data('amount');
            }).get();
            // console.log(values);

            values.forEach(v => {
                // console.log(v);
                tt += v;
            });
            // console.log(tt);
            setOrderPrice();
        }

        function getOtherPrice() {
            values2 = $('.other-item-amount').map(function() {
                var amount = $(this).data('otherItemAmount');
                var type = $(this).data('otherItemType');

                var am = 0;
                if (type == 'night') {
                    am = parseInt(amount)*(day + 1);
                }
                return am;
            }).get();
            // console.log(values2);

            values2.forEach(v => {
                // console.log(v);
                ot += v;
            });
            // console.log(ot);
            setOrderPrice();
        }

        function setOrderPrice() {
            $('.order-price').data('orderPrice', tt + bt + at + ot);
            $('.order-price').html('$'+ (tt + bt + at + ot));
        }

    </script>
@endsection
