@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    @include('layouts.rent_step_bar')

    <section class="section">
        <div class="container">
            <div class="section-title mx-auto text-center">
                <h2>露營車租賃契約書</h2>
            </div>
            <div class="row mb-3 mx-md-auto mx-3">
                <iframe src="pdfjs-dist/web/viewer.html?file={{ env('APP_URL') . '/uploads/' . $series }}" width="100%" style="height: 100vh;" seamless scrolling="yes" ></iframe>

                <p class="my-3"><a class="h5" target="_blank" href="{{ env('APP_URL') . '/uploads/' . $series }}">點此下載租賃條款契約書</a></p>
            </div>
            <div class="row mb-3 mx-md-auto mx-3">
                <div class="form-group form-check form-control-lg d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" name="readed"
                        id="readed" value="*請選擇“同意”繼續操作*">
                    <label class="form-check-label" style="font-size: 1.2rem !important;" for="readed">*請選擇“同意”繼續操作*</label>
                </div>
            </div>
            <div class="row justify-content-center">
                <input type="button" class="btn btn-next" value="下一步">
            </div>
        </div>
    </section>
    <script>
        $('.btn-next').attr('disabled', true);
        $('.btn-next').addClass('btn-secondary');
        $('#readed').click(function() {
            if ($('#readed').is(":checked")) {
                $('#readed').attr('disabled', true)
                $('.btn-next').attr('disabled', false);
                $('.btn-next').removeClass('btn-secondary');
                $('.btn-next').addClass('btn-primary3');
            }
        });


        $('.btn-next').click(function() {
            window.location.href = "{{ route('car_rent_s4') }}";
        });
    </script>
@endsection
