@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col">
                    <h2>{{ $newsInfo->title }}</h2>
                </div>

            </div>

            <div class="container mt-3">
                <div class="row news-content">
                    {!! $newsInfo->content !!}
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->
@endsection
