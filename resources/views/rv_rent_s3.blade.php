@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">
            <div class="section-title mx-auto text-center">
                <h2>露營車租賃契約書</h2>
            </div>
            <div class="row">

            </div>
            <div class="row justify-content-center">
                <a href="{{ route('car_rent_s4') }}" class="btn btn-primary2">下一步</a>
            </div>
        </div>
    </section>

@endsection
