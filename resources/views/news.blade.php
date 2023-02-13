@extends('layouts.master')

<link href="{{ asset('assets/css/news.css') }}" rel="stylesheet" type="text/css" />

@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">

            <div class="row">
                <h4 class="w-100">熱門</h4>
                @foreach ($popular as $item)
                @if ($item->show_status)
                <div class="col-lg-4 col-md-6 col-12 mb-4 pb-2">
                    <div class="card blog-post border-0 rounded shadow overflow-hidden">
                        <img src="{{ $item->news_front_cover != '' ? env('APP_URL') . '/uploads/' . $item->news_front_cover : asset('assets/img/hero/hero-02.jpg') }}" class="img-fluid news-item-img" alt="">
                        <div class="card-body content p-4 newinfo-content">
                            <div class="d-flex">
                                <ul class="date text-center text-primary mr-3 mb-0 list-unstyled">
                                    <li class="day shadow h6 font-weight-bold mb-2">{{ date("d",strtotime($item->created_at)) }}</li>
                                    <li class="month h6 font-weight-bold">{{ date("M",strtotime($item->created_at)) }}</li>
                                </ul>
                                <a href="news/{{ $item->id }}" class="title text-dark h5 my-auto">{{ $item->title }}</a>
                            </div>

                            <div class="post-meta d-flex justify-content-end mt-3">
                                {{-- <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item mr-2 mb-0"><a href="javascript:void(0)" class="text-muted like"><i class="mdi mdi-heart-outline mr-1"></i>33</a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i class="mdi mdi-comment-outline mr-1"></i>08</a></li>
                                </ul> --}}
                                <a href="news/{{ $item->id }}" class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                @endif
                @endforeach
            </div>

            <div class="line-hr mx-auto mb-5"></div>



            <h4 class="w-100 mb-3">最新消息</h4>
            <div class="overflow-auto mb-3">
                {{ $newInfo->onEachSide(1)->links() }}
            </div>
            <div class="row">

                {{-- @foreach ($newInfo as $item)
                <div class="col-lg-6 mt-4 pt-2">
                    <div class="card event-schedule rounded border-0 shadow">
                        <div class="card-body">
                            <div class="media">
                                <ul class="date text-center text-primary mr-3 mb-0 list-unstyled">
                                    <li class="day shadow h6 font-weight-bold mb-2">{{ date("d",strtotime($item->created_at)) }}</li>
                                    <li class="month h6 font-weight-bold">{{ date("M",strtotime($item->created_at)) }}</li>
                                </ul>
                                <div class="media-body content">
                                    <h5><a href="news/{{ $item->id }}" class="text-dark title">{{ $item->title }}</a></h5>
                                    <p class="text-muted mb-0">{{ $item->category }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach --}}

                @foreach ($newInfo as $item)
                @if ($item->show_status)
                <div class="col-lg-4 col-md-6 col-12 mb-4 pb-2">
                    <div class="card blog-post border-0 rounded shadow overflow-hidden">
                        <img src="{{ $item->news_front_cover != '' ? env('APP_URL') . '/uploads/' . $item->news_front_cover : asset('assets/img/hero/hero-02.jpg') }}" class="img-fluid news-item-img" alt="">
                        <div class="card-body content p-4 newinfo-content">
                            <div class="d-flex">
                                <ul class="date text-center text-primary mr-3 mb-0 list-unstyled">
                                    <li class="day shadow h6 font-weight-bold mb-2">{{ date("d",strtotime($item->created_at)) }}</li>
                                    <li class="month h6 font-weight-bold">{{ date("M",strtotime($item->created_at)) }}</li>
                                </ul>
                                <a href="news/{{ $item->id }}" class="title text-dark h5 my-auto">{{ $item->title }}</a>
                            </div>

                            <div class="post-meta d-flex justify-content-end mt-3">
                                {{-- <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item mr-2 mb-0"><a href="javascript:void(0)" class="text-muted like"><i class="mdi mdi-heart-outline mr-1"></i>33</a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-muted comments"><i class="mdi mdi-comment-outline mr-1"></i>08</a></li>
                                </ul> --}}
                                <a href="news/{{ $item->id }}" class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                @endif
                @endforeach


            </div><!--end row-->

            {{-- <div class="row">
                <div class="col-12">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item"><a class="page-link" href="javascript:void(0)" aria-label="Previous">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next">Next</a></li>
                    </ul>
                </div>
            </div> --}}
        </div><!--end container-->
    </section><!--end section-->
@endsection
