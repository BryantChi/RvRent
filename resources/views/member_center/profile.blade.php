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

                        <div class="p-4 rounded border mt-4 text-center">
                            <img src="{{ asset('assets/images/client/01.jpg')}}" class="rounded-circle shadow-md img-fluid avatar avatar-medium" alt="">
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
                                    <li><a href="jvascript:void(0)">個人資料</a> <span class="float-right"></span></li>
                                    <li><a href="jvascript:void(0)">訂單資料</a> <span class="float-right">09</span></li>
                                    {{-- <li><a href="jvascript:void(0)">Meeting Room</a> <span class="float-right">18</span></li>
                                    <li><a href="jvascript:void(0)">Kitchen</a> <span class="float-right">20</span></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-md-8">

                </div>
            </div>
        </div>
    </section>

@endsection
