{{-- @extends('layouts.master')

@section('content_section')
<section class="section bg-half-200">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary3">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection --}}

@extends('layouts.app_master')


@section('content')

    <!-- Hero Start -->
    <section class="user-pages d-flex align-items-center"
        style="background: url('{{ asset('assets/images/home/user.jpg') }} ') center center;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="login-page bg-white shadow-lg rounded p-4 mt-4 position-relative">
                        <div class="text-center">
                            <a href="javascript:void(0)">
                                <img src="{{ url('assets/img/icon/9O_logo_02.png') }}" height="42" alt="">
                            </a>
                            <h5 class="my-4">登入</h5>
                        </div>
                        <form class="login-form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label for="email">{{ __('信箱') }} <span
                                                class="text-danger">*</span></label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Your Email :">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label>{{ __('密碼') }} <span class="text-danger">*</span></label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Password :">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group d-inline-block">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="remember">{{ __('記住我') }}</label>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <p class="forgot-pass mb-0"><a href="{{ route('password.request') }}"
                                                    class="text-dark font-weight-bold">{{ __('忘記密碼?') }}</a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-12 mb-0">
                                    <button type="submit" class="btn btn-primary3 w-100">{{ __('登入') }}</button>
                                </div>
                                <!--end col-->

                                <div class="col-12 text-center">
                                    <p class="mb-0 mt-3"><small class="text-dark mr-2">還沒加入會員 ?</small>
                                        <a href="{{ route('register') }}" class="text-dark font-weight-bold">註冊</a></p>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                        <!--end form-->
                    </div>
                    <!--end login-->
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- Hero End -->

@endsection


