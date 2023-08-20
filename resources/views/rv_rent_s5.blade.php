@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    @include('layouts.rent_step_bar')

    <section class="section">
        <div class="container">
            {{-- <div class="section-title mx-auto text-center">
                <h2>露營車租賃契約書</h2>
            </div> --}}
            <div class="row justify-content-center">
                <div class="col-md-8 text-center p-3 rounded" style="border: 1px dotted rgba(197, 197, 197, 0.704)">
                    <img src="{{ asset('assets/img/icon/check-pre.gif') }}" class="img-fluid w-50" alt="{{ __('') }}">
                    <img src="{{ asset('assets/img/s-remit.jpg') }}" class="img-fluid" alt="{{ __('') }}">
                    {{-- <h2>預定成功</h2> --}}
                </div>
            </div>


        </div>
    </section>

@endsection

@push('scripts')

    <script>
        destroyCookies();
        function destroyCookies() {
            $.ajax({
                url:'{{ route("remove-carrent-cookie") }}',
                method:'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(){
                    localStorage.removeItem('savedInput');
                    console.log("cookie deleted");
                }
            });
        }
    </script>

@endpush
