@extends('layouts.master')

@section('content_section')

    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 col-12">
                    <div class="positon-relative">
                        <img src="{{ asset('assets/img/hero/手機模擬1-背景圖-2.jpg') }}" class="img-fluid rounded-md shadow-md" alt="">
                        {{-- <div class="play-icon">
                            <a href="https://www.youtube.com/watch?v=-rnEepQ_jpI" class="play-btn video-play-icon">
                                <i class="mdi mdi-play text-primary rounded-circle bg-white shadow-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div><!--end col-->

                <div class="col-md-7 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="section-title ml-lg-5">
                        {{-- “ Sweet as the Moment When <br> the coworking Went 'Pop ” : --}}
                        <h4 class="title mb-4"> <span class="font-weight-bold">Our Story</span></h4>
                        {!! $aboutUsInfo->content !!}
                        {{-- <p class="text-muted mb-0">This is required when, for example, the final text is not yet available. Dummy text is also known as 'fill text'. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to have a 'ready-made' text to sing with the melody.</p> --}}
                        {{-- <div class="mt-4">
                            <a href="page-about.html" class="btn btn-primary">Learn More <i data-feather="arrow-right" class="fea icon-sm"></i></a>
                        </div> --}}
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>

@endsection
@push('scripts')
    <script>
        localStorage.removeItem('savedInput');
    </script>
@endpush
