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
                        <label><input type="radio" name="label" value="1800" data-plan="50公里內">
                            <p class="round button">
                                50公里內<br>
                                <span class="h2 text-danger">$1800</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="3000" data-plan="100公里內">
                            <p class="round button">
                                100公里內<br>
                                <span class="h2 text-danger">$3000</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="5000" data-plan="200公里內">
                            <p class="round button">
                                200公里內<br>
                                <span class="h2 text-danger">$5000</span>
                            </p>
                        </label>
                        <label><input type="radio" name="label" value="0" data-plan="無需加購" checked>
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
                        @if (((Int) App\Models\AccessoryInfo::getAccessoryInfoByDate($equipment->id, Cookie::get('date_get'))) > 0)
                            <div class="equipment-box p-3 mb-3">
                                <div class="justify-content-evely align-items-center d-md-flex equipment-title-box">
                                    <div class="form-check align-self-center">
                                        <input class="form-check-input h5 mt-2 equipment-item" type="checkbox"
                                            value="{{ $equipment->id }}"
                                            data-equipmentname="{{ $equipment->accessory_name }}"
                                            data-equipmentamount="{{ $equipment->accessory_rent_price }}"
                                            data-amount="{{ $equipment->accessory_rent_price }}"
                                            id="equipment-item-{{ $equipment->id }}">
                                        <label class="form-check-label h5 my-0 equipment-item-title"
                                            for="equipment-item-{{ $equipment->id }}">
                                            {{ $equipment->accessory_name }}
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center ml-auto mt-md-auto mt-3">
                                        <p class="d-flex align-items-center justify-content-end my-0">
                                            租借數量
                                            <input type="number" min="1" value="1"
                                                max="{{ App\Models\AccessoryInfo::getAccessoryInfoByDate($equipment->id, Cookie::get('date_get')) }}" id="equipment-item-count"
                                                class="form-control mx-1" style="width: auto !important;">
                                            組
                                        </p>
                                        <p class="h3 px-3 my-0 equipment-item-amount" style="color: #ea3c06;">
                                            ${{ $equipment->accessory_rent_price }}
                                        </p>
                                        <p class="my-auto equipment-drop" data-toggle="popover" data-container="body"
                                            data-trigger="hover" data-placement="top" data-content="點擊查看詳細項目">
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

            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <h4 class="mr-2" style="color: #f0a000">3 - 其他</h4>
                    <span>(必選*)</span>
                </div>
                <div class="col-12">
                    @if (empty($rent_amount_setting['other_price'] ?? ''))
                        <div class="other-box p-3 mb-3">
                            <div class="justify-content-evely align-items-center d-md-flex other-title-box px-3">
                                <div class="d-flex align-items-center" style="color: #4D4D4D">
                                    <p class="mr-3 mb-0"><i class="fa-regular fa-circle-check"></i></p>
                                    <h5 class="mb-0">無相關資料</h5>
                                </div>
                                <div class="d-flex justify-content-end align-items-center ml-auto mt-md-auto mt-3">
                                    <p class="h3 px-3 my-0 other-item-amount" style="color: #ea3c06;"
                                        data-other-item-amount="0" data-other-item-type="null">

                                    </p>
                                </div>
                            </div>

                        </div>
                    @else
                        @foreach (json_decode($rent_amount_setting['other_price']) as $op_item)
                            <div class="other-box p-3 mb-3">
                                <div class="justify-content-evely align-items-center d-md-flex other-title-box px-3">
                                    <div class="d-flex align-items-center" style="color: #f0a000">
                                        <p class="mr-3 mb-0"><i class="fa-regular fa-circle-check"></i></p>
                                        <h5 class="mb-0">{{ $op_item->item }}</h5>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center ml-auto mt-md-auto mt-3">
                                        <p class="h3 px-3 my-0 other-item-amount" style="color: #ea3c06;"
                                            data-other-item-amount="{{ (int) $op_item->price }}"
                                            data-other-item-type="{{ $op_item->type }}">
                                            ${{ (int) $op_item->price }}{!! $op_item->type == 'night' ? ' / <span class="h4">天</span>' : '' !!}
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
                    @endif
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
                                <p class="h3 px-3 my-0 d-block" style="color: #ea3c06;">
                                    ${{ (int) $rent_amount_setting['rental'] }} / <span class="h4">晚</span>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center px-3">
                            <p class="h5 px-3 mt-3 ml-auto">天數： <span
                                    style="color: #ea3c06;">{{ (int) $rent_amount_setting['day'] }}</span> <span
                                    class="h4">晚</span></p>
                        </div>
                    </div>

                </div>
            </div>

            <hr style="background-color: #f0a000">

            <div class="row justify-content-end px-3">
                <p style="color: #f0a000">合計 <span class="h3 order-price" style="color: #ea3c06;"
                        data-other-item-day="{{ (int) $rent_amount_setting['day'] }}"
                        data-order-price="{{ $rent_amount_setting['rental'] != null ? $rent_amount_setting['rental'] : $model->base_price }}">${{ $rent_amount_setting['rental'] != null ? $rent_amount_setting['rental'] : $model->base_price }}</span>
                </p>
            </div>

            <div class="row justify-content-center">
                {{-- <a href="" class="btn btn-primary3">下一步</a> --}}
                <a href="javascript:void(0)"
                    onclick="cachePriceData('{{ route('car_rent_s3', ['rvm_id' => $model->id]) }}')"
                    class="btn btn-primary3">下一步</a>
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
            background: rgb(255, 225, 202);
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

@endsection
@push('scripts')
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
                if (parseInt($(this).val()) > parseInt($(this).attr('max'))) {
                    $(this).val($(this).attr('max'));
                }
                var count = $(this).val();
                var amount = $(this).parent().parent().parent().find('.equipment-item').data(
                    'equipmentamount');
                var total = count * amount;

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
                    am = parseInt(amount) * (day + 1);
                } else {
                    am = parseInt(amount);
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
            $('.order-price').html('$' + (tt + bt + at + ot));
        }
    </script>

    <script>
        var amountData = {};
        var planData = [];
        var equipmentData = [];
        var otherData = [];
        var rentAmount = [];
        var searchData = [];

        // 設定 cookie By 分鐘
        function setCookie(name, value, minutes) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (minutes * 60 * 1000));
            document.cookie = name + "=" + value + ";expires=" + expires.toUTCString() + ";path=/";
        }

        function cachePriceData(src) {
            getPlanData()
                .then(getEquipmentData)
                .then(getOtherData)
                .then(getRentAmount)
                .then(getSearchData)
                .then(function() {
                    // console.log(amountData);
                    var jsonStr = JSON.stringify(amountData);
                    // setCookie("amount_data", jsonStr, 30);
                    $.ajax({
                        beforeSend: function() {
                            //將div顯示
                            $('#loading').css("display", "");
                        },
                        url: src,
                        type: 'post',
                        data: {
                            amount_data: jsonStr,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            // var obj = $.parseJSON(res);
                            // console.log(res);
                            setTimeout(function() {
                                $('#loading').css("display", "none");
                            }, 3000);
                            if (res.status == 'success') {
                                window.location.href = src;
                            } else if (res.status == 'authFail') {
                                window.location.href = "{{ route('login') }}";
                            } else {
                                Swal.fire("注意！", "連線錯誤，請稍候重新嘗試！", "warning");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#loading').css("display", "none");
                            Swal.fire("錯誤!", "程序失敗", "error");
                        }
                    });
                });
            // getPlanData();
            // getEquipmentData();
            // getOtherData();
            // getRentAmount();
            // getSearchData();
        }

        function getPlanData() {
            return new Promise(function(resolve) {
                var plan_key = $('input[name=label]:checked').data('plan');
                var plan_value = $('input[name=label]:checked').val();

                planData = {
                    plan_key,
                    plan_value
                };
                // console.log(planData);
                amountData.plan = planData;

                resolve();
            });
        }

        function getEquipmentData() {
            return new Promise(function(resolve) {
                var equipment_id = null;
                var equipment_name = null;
                var equipment_total_amount = null;
                var equipment_base_amount = null;
                var equipment_count = null;

                equipmentData = $('.equipment-box').find('.equipment-item[type=checkbox]:checked').map(function() {
                    equipment_id = $(this).val();
                    equipment_name = $(this).data('equipmentname');
                    equipment_base_amount = $(this).data('equipmentamount');
                    equipment_total_amount = $(this).data('amount');
                    equipment_count = $(this).parent().parent().find('#equipment-item-count').val();
                    return {
                        equipment_id,
                        equipment_name,
                        equipment_base_amount,
                        equipment_total_amount,
                        equipment_count
                    };
                }).get();
                // console.log(equipmentData);
                amountData.equipment = equipmentData;

                resolve();
            });
        }

        function getOtherData() {
            return new Promise(function(resolve) {
                var other_model_key = "{{ $model->id }}";
                var other_value_week = "{{ $rent_amount_setting['week'] }}";
                var other_value_get_time = "{{ $rent_amount_setting['get'] }}";
                var other_value_back_time = "{{ $rent_amount_setting['back'] }}";
                var other_value_over_time = "{{ (Int) $rent_amount_setting['overtime'] }}";
                var other_value_milage = "{{ $rent_amount_setting['note'] }}";
                var other_value_plan = "{{ $rent_amount_setting['plan'] }}";
                var other_value_plan_title = "{{ $rent_amount_setting['plan_title'] }}";
                <?php
                    echo "var other_value_other_price = ". $rent_amount_setting['other_price'] .";\n"
                ?>


                otherData = {
                    other_model_key,
                    other_value_week,
                    other_value_get_time,
                    other_value_back_time,
                    other_value_over_time,
                    other_value_other_price,
                    other_value_milage,
                    other_value_plan,
                    other_value_plan_title
                };
                // console.log(otherData);
                amountData.other = otherData;

                resolve();
            });
        }

        function getRentAmount() {
            return new Promise(function(resolve) {
                var rent_day = '{{ $rent_amount_setting['day'] }}';
                var rent_base_amount = '{{ (int) $rent_amount_setting['rental'] }}';
                var total_rent_amount = $('.order-price').data('orderPrice');

                rentAmount = {
                    rent_day,
                    rent_base_amount,
                    total_rent_amount
                }

                amountData.rent = rentAmount;

                resolve();
            });
        }

        function getSearchData() {
            return new Promise(function(resolve) {
                var date_get = "{{ Cookie::get('date_get') ?? 'null' }}";
                var date_back = "{{ Cookie::get('date_back') ?? 'null' }}";
                var bed_count = "{{ Cookie::get('bed_count') ?? 'null' }}";

                searchData = {
                    date_get,
                    date_back,
                    bed_count
                };

                amountData.search = searchData;

                resolve();
            });
        }
    </script>
@endpush
