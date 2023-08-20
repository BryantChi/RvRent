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
                                    <li><a href="{{ route('member.profile') }}">個人資料</a> <span class="float-right"></span></li>
                                    <li>
                                        <a href="{{ route('member.order') }}">訂單資料</a>
                                        <span class="float-right order-count">{{ count(DB::table('rent_order_infos')->whereNull('deleted_at')->where('order_user', $user->customer_id)->get()) }}</span>
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
                    {{-- @if ($errors->count())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <div class="alert-icon">
                                    <i class="material-icons">error_outline</i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                </button>
                                <b>Error Alert:</b> {{ $error }}
                            </div>
                        @endforeach
                    @endif --}}
                    <form action="{{ route('member.profile.update', $user->id) }}" method="post" class="needs-validation"
                        enctype="multipart/form-data">

                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
                        <div class="rounded border p-4 mt-4">
                            <h5>個人資料</h5>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold" for="name">姓名</label>
                                <input name="name" id="name" type="text"
                                    class="form-control bg-white @error('name') is-invalid @enderror" required
                                    placeholder="姓名" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold"> 身分證字號 </label>
                                <input name="IDNumber" type="text"
                                    class="form-control bg-white @error('IDNumber') is-invalid @enderror"
                                    id="IDNumber" name="IDNumber" value="{{ $user->IDNumber }}">
                                @error('IDNumber')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold" for="nick_name">暱稱</label>
                                <input name="nick_name" id="nick_name" type="text"
                                    class="form-control bg-white @error('nick_name') is-invalid @enderror" placeholder="暱稱"
                                    value="{{ $user->nick_name }}">
                                @error('nick_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold" for="country">國別</label>
                                <input name="country" id="country" type="text"
                                    class="form-control bg-white @error('country') is-invalid @enderror" required
                                    placeholder="國別" value="{{ $user->country }}">
                                @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold" for="phone">聯絡電話</label>
                                <input name="phone" id="phone" type="tel"
                                    class="form-control bg-white @error('phone') is-invalid @enderror" required
                                    placeholder="聯絡電話" value="{{ $user->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold" for="line_id">LineID</label>
                                <input name="line_id" id="line_id" type="text"
                                    class="form-control bg-white @error('line_id') is-invalid @enderror" required
                                    placeholder="LineID" value="{{ $user->line_id }}">
                                @error('line_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold" for="gender">性別</label>
                                <select class="form-control custom-select bg-white @error('gender') is-invalid @enderror"
                                    name="gender">
                                    <option {{ $user->gender == 'n' || $user->gender == null ? 'selected' : '' }}
                                        value="n">不顯示</option>
                                    <option {{ $user->gender == 'm' ? 'selected' : '' }} value="m">男</option>
                                    <option {{ $user->gender == 'f' ? 'selected' : '' }} value="f">女</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold"> 生日 </label>
                                <input name="date" type="text"
                                    class="flatpickr flatpickr-input form-control bg-white @error('date') is-invalid @enderror"
                                    id="birth-date">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative">
                                <label class="font-weight-bold"> 駕照照片 </label>
                                <div class="custom-file">
                                    <input type="file" name="driving_licence"
                                        class="custom-file-input @error('driving_licence') is-invalid @enderror"
                                        id="driving-licence">
                                    <label class="custom-file-label" for="driving-licence"
                                        aria-describedby="inputGroupFileAddon">選擇圖片</label>
                                </div>
                                {{-- <input type="file" name="driving_licence"
                                    class="custom-file-input2 form-control @error('driving_licence') is-invalid @enderror"
                                    id="driving-licence"> --}}
                                @error('driving_licence')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div id="licence" class="licence d-inline-block float-left position-relative mr-md-2 {{ $user->driving_licence != '' || $user->driving_licence != null ? '' : 'd-none' }}">
                                    <img class="my-2 img-fluid" src="{{ $user->driving_licence != null || $user->driving_licence != "" ? env('APP_URL') . '/uploads/' . $user->driving_licence : '' }}" style="width: 350px;"
                                        alt="">

                                    <span class="position-absolute {{ $user->driving_licence != '' || $user->driving_licence != null ? '' : 'd-none' }}" style="position: absolute;top: 15px;left: 15px;background: #ffffffa4; padding: 5px;">
                                        <img src="{{ asset('assets/img/icon/certificate.png') }}" class="{{ $user->driving_licence_certified == true ? '' : 'd-none' }}" width="30"/>
                                        {{ $user->driving_licence_certified == true ? '驗證通過' : '待驗證' }}
                                    </span>
                                </div>
                                <div id="preview-content" class="preview-content" style="display: inline-block;position: relative;float: left;">
                                    <img id="preview" class="preview my-2 img-fluid" src="" style="width: 300px;"
                                        alt="預覽圖片">
                                    <label for="preview" class="" style="position: absolute;top: 15px;left: 15px;background: #ffffffa4; padding: 5px;">預覽圖片</label>
                                </div>

                            </div>
                            @csrf
                            <div class="form-group position-relative">
                                <input type="submit" class="form-control btn btn-primary3" id="submit"
                                    value="儲存變更" />
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        var today = new Date();
        var lastBirthdayYear = today.getFullYear() - 20;
        var lastBirthdayMonth = today.getMonth() + 1;
        var lastBirthdayDate = today.getDate();
        var lastBirthdayStr = lastBirthdayYear + '-' + lastBirthdayMonth + '-' + lastBirthdayDate
        var lastBirthday = null;
        var lastBirth = '<?php echo $user->birthday; ?>';
        if (lastBirth != '') {
            lastBirthday = new Date(lastBirth);
        } else {
            lastBirthday = new Date(lastBirthdayStr)
        }

        $("#birth-date").flatpickr({
            defaultDate: lastBirthday,
            maxDate: lastBirthday,
            "locale": "zh_tw",
        });

        $(function () {
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
        })


        // function previewImage(event) {
        //     var input = event.target;
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();

        //         reader.onload = function(e) {
        //             var previewElement = document.getElementById('preview');
        //             previewElement.src = e.target.result;
        //             $('.preview').show();
        //         }

        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }
    </script>
@endsection
@push('scripts')
    <script>
        localStorage.removeItem('savedInput');
    </script>
@endpush
