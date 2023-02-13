@extends('layouts.master')

<link href="{{ asset('assets/css/car_rent.css') }}?v=20230213" rel="stylesheet" type="text/css" />

@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h4 class="ml-md-5 ml-1 mb-3">{{ $model->rv_name }}</h4>
                    <div class="text-center">
                        <img src="{{ env('APP_URL') . '/uploads/' . $model->rv_front_cover }}"
                        class="img-fluid img-thumbnail rv-front mx-auto" alt="{{ __('') }}"/>
                    </div>

                </div>
                <div class="col-md-6 align-self-center mt-4 mt-md-0">
                    <div class="row g-0">
                        @foreach ($attachmentInfo->attachments->attach as $item)
                            <div class="col-md-4 col-6 my-2 d-flex align-items-center" style="color: #f7c000">
                                <img src="{{ env('APP_URL') . '/uploads/' . $item->attachment_icon }}"
                                    class="img_fluid mr-3" width="36" alt="{{ __('') }}">
                                <span>{{ $item->attachment_name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="line-hr mx-auto my-5"></div>
                <div class="col-md-12">
                    <div class="detail-content">
                        {!! $model->rv_discription !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .rv-front {
            width: 75%;
        }

        .line-hr {
            height: 1.2px;
            width: 90%;
            background-color: #f7c000;
        }

        .detail-content img {
            max-width: 100%;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .detail-content video {
            max-width: 100%;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .detail-content iframe {
            max-width: 100%;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .detail-content table {
            width: auto !important;
            margin-left: auto;
            margin-right: auto;
        }

        .detail-content table tr td {
            max-width: 100%;
            text-align: center;
        }

        .detail-content table img {
            max-width: 100%;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 80% !important;
        }

        .detail-content table video {
            max-width: 100%;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 80% !important;
        }

        .detail-content table iframe {
            max-width: 100%;
            width: auto !important;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        @media (max-width: 768px) {
            .rv-front {
                width: 100%;
            }
        }
    </style>
@endsection
