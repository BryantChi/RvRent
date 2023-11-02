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
                        <img src="{{ $rvModel->rv_front_cover != null ? env('APP_URL') . 'uploads/' . $rvModel->rv_front_cover : asset('assets/img/icon/rv-icon/1.png') }}"
                            class="img-fluid mb-3" alt="{{ __('') }}">
                        <h4 class="mb-3">預定旅程 <i class="fa-solid fa-caravan"></i></h4>
                        <div class="">
                            <p>
                                出發：台中・{{ $amountData->order_get_date . '・' . $amountData->order_rv_amount_info->other_value_get_time }}
                                <br />
                                回程：台中・{{ $amountData->order_back_date . '・' . $amountData->order_rv_amount_info->other_value_back_time }}
                            </p>
                            <p>
                                金額：NT$ <span class="h4">{{ $amountData->order_total_rental }}</span>
                            </p>
                        </div>
                        <hr style="background-color: #fff">
                        <div>
                            <p class="text-center">
                                內含明細
                            </p>
                            @foreach ($amountData->order_rv_amount_info->other_value_other_price as $price)
                                <div class="row p-0 m-0 justify-content-between">
                                    <div class="col-auto p-0">{{ $price->item }}</div>
                                    @if ($price->type == 'night')
                                        <div class="col-auto p-0">NT$
                                            {{ ((int) $price->price) * ((int) $amountData->order_night_count + 1) }} /
                                            {{ (int) $amountData->order_night_count + 1 . '天' }}</div>
                                    @else
                                        <div class="col-auto p-0">NT$ {{ (int) $price->price }} / 次</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <hr style="background-color: #fff">
                        <div>
                            <p class="text-center">
                                配備加購明細
                            </p>
                            @foreach ($amountData->order_accessory_info as $accessory)
                                <div class="row p-0 m-0 justify-content-between">
                                    <div class="col-auto p-0">{{ $accessory->equipment_name }}</div>
                                    <div class="col-auto p-0">NT$ {{ (int) $accessory->equipment_total_amount }} /
                                        {{ $accessory->equipment_count }} 組</div>
                                </div>
                            @endforeach
                        </div>
                        <hr style="background-color: #fff">
                        <div>
                            <p class="text-center">
                                哩程套餐加購明細
                            </p>
                            <div class="d-flex">
                                <p>
                                    {{ $amountData->order_mileage_plan_info->plan_key }}
                                </p>
                                <p class="ml-auto">
                                    NT${{ $amountData->order_mileage_plan_info->plan_value }}
                                </p>
                            </div>
                        </div>
                        <hr style="background-color: #fff">
                        <div>
                            <p class="text-center">
                                分配車輛
                            </p>
                            <div class="d-flex">
                                <p>車牌號碼</p>
                                <p class="ml-auto">
                                    {{ $amountData->order_rv_vehicle }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <form id="client" enctype="multipart/form-data">
                        <h3 class="text-danger h2">{{ $rvModel->rv_name }}</h3>
                        <h5 class="text-warning">承租人資料</h5>

                        <div class="customer_form">

                            <div class="form-group">
                                <label for="customer_id">會員編號</label>
                                <span type="text" class="form-control" id="customer_id" name="customer_id"
                                    disabled>{{ $user->customer_id }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">姓名</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name ?? '' }}" disabled="true" required>
                            </div>
                            <div class="form-group">
                                <label for="email">信箱</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email ?? '' }}" disabled="true" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">聯絡電話</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="{{ $user->phone ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="IDNumber">身分證字號</label>
                                <input type="email" class="form-control" id="IDNumber" name="IDNumber"
                                    value="{{ $user->IDNumber ?? '' }}"
                                    {{ $user->IDNumber ?? '' != null ? 'disabled="true"' : '' }} required>
                            </div>

                            <div
                                class="form-group position-relative {{ ((bool) $user->driving_licence_certified ?? '') == true ? 'd-none' : '' }}">
                                <label class="font-weight-bold"> 駕照照片 </label>
                                <div class="custom-file">
                                    <input type="file" name="driving_licence"
                                        class="custom-file-input @error('driving_licence') is-invalid @enderror"
                                        id="driving-licence" accept="image/*" required>
                                    <label class="custom-file-label" for="driving-licence"
                                        aria-describedby="inputGroupFileAddon">選擇圖片</label>
                                </div>
                                <div id="preview-content" class="preview-content"
                                    style="display: inline-block;position: relative;">
                                    <img id="preview" class="preview my-2 img-fluid" src="" style="width: 300px;"
                                        alt="預覽圖片">
                                    <label for="preview" class=""
                                        style="position: absolute;top: 15px;left: 15px;background: #ffffffa4; padding: 5px;">預覽圖片</label>
                                </div>

                            </div>

                        </div>

                        <hr style="background-color: #f0a000">

                        {{-- <h3 class="text-danger h2">{{ $rvModel->rv_name }}</h3> --}}
                        <h5 class="text-warning">司機資料</h5>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="same_user" name="same_user">
                            <label class="form-check-label" for="same_user">同會員資料</label>
                        </div>
                        <div class="driver_form">
                            <div class="form-group">
                                <label for="dr_name">姓名</label>
                                <input type="text" class="form-control" id="dr_name" name="dr_name" required>
                            </div>
                            <div class="form-group">
                                <label for="dr_email">信箱</label>
                                <input type="email" class="form-control" id="dr_email" name="dr_email" required>
                            </div>
                            <div class="form-group">
                                <label for="dr_phone">聯絡電話</label>
                                <input type="tel" class="form-control" id="dr_phone" name="dr_phone" required>
                            </div>
                            <div class="form-group">
                                <label for="dr_IDNumber">身分證字號或居留證</label>
                                <input type="email" class="form-control" id="dr_IDNumber" name="dr_IDNumber" required>
                            </div>

                            <div class="form-group position-relative">
                                <label class="font-weight-bold"> 駕照照片 </label>
                                <div class="custom-file">
                                    <input type="file" name="dr_driving_licence"
                                        class="custom-file-input @error('dr_driving_licence') is-invalid @enderror"
                                        id="dr_driving-licence" accept="image/*" required>
                                    <label class="custom-file-label" for="dr_driving-licence"
                                        aria-describedby="inputGroupFileAddon">選擇圖片</label>
                                </div>
                                <div id="dr_preview-content" class="preview-content"
                                    style="display: inline-block;position: relative;">
                                    <img id="dr_preview" class="preview my-2 img-fluid" src=""
                                        style="width: 300px;" alt="預覽圖片">
                                    <label for="dr_preview" class=""
                                        style="position: absolute;top: 15px;left: 15px;background: #ffffffa4; padding: 5px;">預覽圖片</label>
                                </div>

                            </div>

                        </div>


                        <hr style="background-color: #f0a000">

                        <div class="form-group position-relative">
                            <label class="font-weight-bold" for="payway">付款方式</label>
                            <select class="form-control custom-select bg-white @error('payway') is-invalid @enderror"
                                name="payway" id="payway" required>
                                <option value="">請選擇</option>
                                <option value="remit">匯款</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="order_client_note">備註說明</label>
                            <textarea class="form-control" id="order_client_note" name="order_client_note" rows="5"
                                placeholder="備註說明，最多250字。"></textarea>
                            <p class="text-right" style="color: #888888">
                                <span id="charCount"></span> / 250
                            </p>
                        </div>

                        <hr style="background-color: #f0a000">

                        @csrf

                        <div class="row justify-content-center">
                            <input type="button" id="search" name="search" class="btn btn-primary3"
                                onclick="comfirmOrder('{{ route('car_rent_s5') }}')" value="送出" />
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </section>
@endsection
@push('css')
    <style>
        #customer_id {
            display: flex;
            flex-wrap: wrap;
            align-content: center;
            background-color: #b8b8b826;
            color: #888888;
        }
    </style>
@endpush
@push('scripts')
    <script>
        var vehicle_num = "{{ $amountData->order_rv_vehicle }}";
        if (vehicle_num == null || vehicle_num == "") {
            Swal.fire({
                title: "注意！",
                text: "已無車輛可分配，請重新下單！",
                icon: "warning",
                allowOutsideClick: false,
            }).then(function() {
                window.location.href = "{{ route('car_rent') }}";
            })
        }

        $('#same_user').click(function() {
            if ($(this).is(':checked')) {
                $('.driver_form').hide('300');
            } else {
                $('.driver_form').show('300');
            }

        });

        $(function() {
            $("#preview-content").hide();

            $('#driving-licence').change(function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                    $("#preview-content").show();
                }

                reader.readAsDataURL(file);
            });

            $("#dr_preview-content").hide();

            $('#dr_driving-licence').change(function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#dr_preview').attr('src', e.target.result);
                    $("#dr_preview-content").show();
                }

                reader.readAsDataURL(file);
            });

            var maxChars = 250; // 最大字符数
            var textArea = $('#order_client_note');
            var charCount = $('#charCount');

            charCount.text(0);

            // 监听 textarea 输入事件
            textArea.on('input', function() {
                var remainingChars = maxChars - textArea.val().length;

                charCount.text(textArea.val().length);

                // 如果超过了最大字符数，截断输入内容
                if (remainingChars < 0) {
                    textArea.val(textArea.val().substr(0, maxChars));
                    charCount.text(maxChars);
                }
            });
        })


        function comfirmOrder(src) {
            var userCheck = Boolean(parseInt('{{ (Boolean) $user->driving_licence_certified }}')) == true;
            var idPattern = /^[A-Z][12]\d{8}$/;
            var residentPattern = /^[A-Z][A-D]\d{8}$/;
            $('#IDNumber').removeClass('is-invalid');
            $('#dr_IDNumber').removeClass('is-invalid');

            if (!userCheck) {
                if ($('#driving-licence')[0].files[0] == null) {
                    Swal.fire("注意!", "承租人駕照照片欄位不可空白", "warning");
                    return
                }
            }

            if ($('#phone').val() == null || $('#phone').val() == '' || $('#IDNumber').val() == null || $('#IDNumber').val() == '') {
                Swal.fire("注意!", "承租人資料相關欄位不可空白", "warning");
                return
            } else {
                if (!idPattern.test($('#IDNumber').val()) || !residentPattern.test($('#IDNumber').val())) {
                    Swal.fire("注意!", "司機資料-身分證或居留證格式錯誤", "warning");
                    $('#IDNumber').addClass('is-invalid');
                    return
                }
            }

            if (!$('#same_user').is(':checked')) {
                if ($('#dr_name').val() == null || $('#dr_email').val() == null || $('#dr_phone').val() == null ||
                    $('#dr_IDNumber').val() == null || $('#dr_driving-licence')[0].files[0] == null ||
                    $('#dr_name').val() == '' || $('#dr_email').val() == '' || $('#dr_phone').val() == '' ||
                    $('#dr_IDNumber').val() == '' ) {
                    Swal.fire("注意!", "司機資料相關欄位不可空白", "warning");
                    return
                } else {
                    if (!idPattern.test($('#dr_IDNumber').val()) || !residentPattern.test($('#dr_IDNumber').val())) {
                        Swal.fire("注意!", "司機資料-身分證或居留證格式錯誤", "warning");
                        $('#dr_IDNumber').addClass('is-invalid');
                        return
                    }
                }
            }

            if ($('#payway').val() == '') {
                Swal.fire("注意!", "付款方式欄位不可空白", "warning");
                return
            }

            var form = $('#client');
            $.ajax({
                beforeSend: function() {
                    //將div顯示
                    $('#loading').css("display", "");
                },
                type: 'POST',
                url: '{{ route('car_rent_s4') }}',
                data: new FormData(form[0]),
                processData: false,
                contentType: false,
                success: function(res) {
                    setTimeout(function() {
                        $('#loading').css("display", "none");
                    }, 3000);
                    if (res.status === 'success') {
                        window.location.href = src;
                    } else {
                        Swal.fire("錯誤!", "連線失敗", "error");
                    }
                },
                error: function(error) {
                    $('#loading').css("display", "none");
                    Swal.fire("錯誤!", "程序失敗", "error");
                }
            });

        }
    </script>
@endpush
@push('header')
    <!-- Event snippet for 填寫表單 conversion page -->
    <script> gtag('event', 'conversion', {'send_to': 'AW-11036097170/s7_jCNWr1dMYEJL1tY4p'}); </script>
@endpush
