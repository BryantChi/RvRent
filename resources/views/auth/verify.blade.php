@extends('layouts.app_master')

@section('content')
    <!-- Hero Start -->
    <section class="user-pages d-flex align-items-center"
        style="background: url('{{ asset('assets/images/home/user.jpg') }} ') center center;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="login-page bg-white shadow-lg rounded p-4 mt-4 position-relative">
                <div class="text-center">
                    <a href="javascript:void(0)">
                        <img src="{{ url('assets/img/icon/9O_logo_02.png') }}" height="42" alt="">
                    </a>
                    <h5 class="my-4">Login</h5>
                </div>
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group position-relative">
                                <label for="email">{{ __('Email Address') }} <span
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
                                <label>{{ __('Password') }} <span class="text-danger">*</span></label>
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
                                            for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                    <p class="forgot-pass mb-0"><a href="{{ route('password.request') }}"
                                            class="text-dark font-weight-bold">{{ __('Forgot Your Password?') }}</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-12 mb-0">
                            <button type="submit" class="btn btn-primary3 w-100">{{ __('Login') }}</button>
                        </div>
                        <!--end col-->

                        <div class="col-12 text-center">
                            <p class="mb-0 mt-3"><small class="text-dark mr-2">Don't have an account ?</small>
                                <a href="{{ route('register') }}" class="text-dark font-weight-bold">Sign
                                    Up</a></p>
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
</div> --}}
        <!--end container-->
    </section>
    <!--end section-->
    <!-- Hero End -->
@endsection
