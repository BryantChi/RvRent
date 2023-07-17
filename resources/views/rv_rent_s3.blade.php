@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    @include('layouts.rent_step_bar')

    <section class="section">
        <div class="container">
            <div class="section-title mx-auto text-center">
                <h2>露營車租賃契約書</h2>
            </div>
            <div class="row">

                <iframe src="{{ asset('assets/file/租賃條款契約書（0111）-Ranger.pdf') }}" width="100%" height="600px"></iframe>
            </div>
            <div class="row justify-content-center">
                <a href="{{ route('car_rent_s4') }}" class="btn btn-primary3">下一步</a>
            </div>
        </div>
    </section>

@endsection
