@extends('layouts.master')


@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="sidebar sticky-sidebar">
                        {{-- <div class="p-4 rounded border">
                            <a href="javascript:void(0)" class="btn btn-block btn-primary">$ 350 / Month</a>
                        </div> --}}

                        <div class="p-4 rounded border mt-4 text-center position-relative">
                            <img src="{{ asset('assets/images/client/01.jpg') }}"
                                class="rounded-circle shadow-md img-fluid avatar avatar-medium"
                                style="object-fit:cover;object-position:center;" alt="">
                            {{-- <span class="rounded-circle bg-light px-2 py-1" style="position:absolute;top:110px;right:38%;"><i class="fa-solid fa-camera"></i></span> --}}
                            <div class="mt-4">
                                <small class="text-muted mb-0">一般會員</small>
                                <h6>{{ $user->name }}</h6>
                                {{-- <a href="javascript:void(0)" class="btn btn-primary mt-2">Contact now</a> --}}
                            </div>
                        </div>

                        <div class="widget mb-4 pb-2">
                            <h6 class="widget-title"></h6>
                            <div class="p-4 mt-4 rounded shadow">
                                <ul class="list-unstyled mb-0 catagory">
                                    <li><a href="{{ route('member.profile') }}">個人資料</a> <span class="float-right"></span>
                                    </li>
                                    <li>
                                        <a href="{{ route('member.order') }}">訂單資料</a>
                                        <span
                                            class="float-right order-count">{{ count(DB::table('rent_order_infos')->whereNull('deleted_at')->where('order_user', $user->customer_id)->get()) }}</span>
                                    </li>
                                    {{-- <li><a href="jvascript:void(0)">Meeting Room</a> <span class="float-right">18</span></li>
                                    <li><a href="jvascript:void(0)">Kitchen</a> <span class="float-right">20</span></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-8">
                    @foreach ($orders as $order)
                        <div class="rounded border p-4 mt-4">
                            <h5 class="mb-3">訂單編號：{{ $order->order_num }}</h5>
                            <?php
                            $model = App\Models\RvModelInfo::find($order->order_rv_model_id);
                            $order_rv_amount_info = json_decode($order->order_rv_amount_info);
                            $get_datetime = $order->order_get_date . ' ' . $order_rv_amount_info->other_value_get_time;
                            $back_datetime = $order->order_back_date . ' ' . $order_rv_amount_info->other_value_back_time;
                            if (\Carbon\Carbon::parse($get_datetime)->diffInDays(\Carbon\Carbon::now()) < 10) {
                                $order_cancel_check = false;
                            } else {
                                $order_cancel_check = true;
                            }
                            ?>
                            <div class="row">
                                {{-- {{ dd($model->rv_front_cover) }} --}}
                                <div class="col-md-3">
                                    <img src="{{ $model->rv_front_cover != null ? env('APP_URL') . 'uploads/' . $model->rv_front_cover : asset('assets/img/icon/rv-icon/1.png') }}"
                                        class="img-fluid" alt="{{ __('') }}">
                                </div>
                                <div class="col-md-9">
                                    <h5>車型：{{ $model->rv_name }}</h5>
                                    <div class="d-md-flex d-block justify-content-between">
                                        <p>取車日：{{ $get_datetime }}
                                        </p>
                                        <p>還車日：{{ $back_datetime }}
                                        </p>
                                    </div>
                                    <div class="d-md-flex d-block justify-content-between">
                                        <p>天數(晚)：{{ $order->order_night_count }} 晚</p>
                                        <p>床數：{{ $order->order_bed_count }} 床</p>
                                        <p>分配車輛：{{ $order->order_rv_vehicle }}</p>
                                    </div>
                                    <div class="d-md-flex d-block justify-content-between">
                                        <p>付款方式：{{ $order->order_pay_way == 'remit' ? '匯款' : '信用卡' }}</p>
                                        <p>訂單狀態：<span class="text-info">{{ $order->order_status }}</span></p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="ml-auto">總金額： <span class="font-weight-bold" style="font-size:20px;">NT$
                                                {{ $order->order_total_rental }}</span></p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        @if ($order->order_pay_way == 'remit' && $order->order_remit == '')
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#exampleModalCenter" class="btn btn-primary mr-2 remit"
                                                data-order="{{ route('member.order.upload-remit', ['id' => $order->id]) }}">上傳匯款明細</a>
                                        @endif
                                        @if (App\Models\RentOrderInfo::checkCancelOrderByStatus($order->order_status))
                                            <a href="javascript:void(0)"
                                                onclick="cancelOrder('{{ route('member.order.delete', ['id' => $order->id]) }}', {{$order_cancel_check}})"
                                                class="btn btn-outline-danger">取消訂單</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">上傳匯款紀錄</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="order-remit-form">
                        <form id="remit-form" enctype="multipart/form-data">
                            <div class="form-group position-relative">
                                <label class="font-weight-bold"> 匯款紀錄照片 </label>
                                <div class="custom-file">
                                    <input type="file" id="order_remit" name="order_remit" class="custom-file-input"
                                        id="order-remit" accept="image/*" required>
                                    <label class="custom-file-label" for="order-remit"
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
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                    <input type="button" class="btn btn-primary update-remit" value="上傳">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function cancelOrder(src, cancel_check) {
            var cancel_txt = '';
            if(!Boolean(cancel_check)) {
                cancel_txt = '您的取消動作已在我們的合約協議10日內 會有取消訂單手續費詳見之前的協議合約書 若您確定要取消請按確認鍵 或者洽詢客服人員改日期避免損失!'
            } else {
                cancel_txt = '您將無法復原此筆訂單!'
            }

            Swal.fire({
                title: '是否確認刪除?',
                text: cancel_txt,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '是, 刪除!',
                cancelButtonText: '取消',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        beforeSend: function() {
                            $('#loading').css("display", "");
                        },
                        url: src,
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            setTimeout(function() {
                                $('#loading').css("display", "none");
                            }, 3000);
                            if (res.status == 'success') {
                                window.location.reload();
                            } else {
                                Swal.fire("注意!", "連線失敗", "warning");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#loading').css("display", "none");
                            Swal.fire("錯誤!", "程序失敗", "error");
                        }
                    })
                }
            })
        }

        function updateRemitRecord(src) {
            if ($('#order_remit')[0].files[0] == null) {
                Swal.fire("注意!", "照片欄位有誤，請再次確認！", "warning");
            }
            var form = $('#remit-form');
            console.log(new FormData(form[0]));
            $.ajax({
                beforeSend: function() {
                    $('#loading').css("display", "");
                },
                url: src,
                type: "POST",
                data: new FormData(form[0]),
                // {
                //     order_remit: $('#order_remit').val(),
                //     _token: '{{ csrf_token() }}'
                // },
                processData: false,
                contentType: false,
                success: function(res) {
                    setTimeout(function() {
                        $('#loading').css("display", "none");
                    }, 3000);
                    if (res.status == 'success') {
                        Swal.fire("注意!", "已成功上傳", "warning").then(function() {
                            $('#exampleModalCenter').modal('hide');
                            window.location.reload();
                        });
                    } else {
                        Swal.fire("注意!", "上傳失敗", "warning");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#loading').css("display", "none");
                    Swal.fire("錯誤!", "程序失敗", "error");
                }
            })
        }

        $(function() {
            $("#preview-content").hide();

            $('#order_remit').change(function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                    $("#preview-content").show();
                }

                reader.readAsDataURL(file);
            });

            $('.remit').click(function() {
                $('.update-remit')[0].setAttribute('onClick', "updateRemitRecord('" + $(this).data(
                    'order') + "')");
            });
        });
    </script>
    <script>
        localStorage.removeItem('savedInput');
    </script>
@endpush
