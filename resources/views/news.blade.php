@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    <section class="section">
        <div class="container">
            <div class="row">

                @foreach ($newInfo as $item)
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

                                    {{-- <div class="row">
                                        <div class="col-12">
                                            <div class="subcribe-form mt-4">
                                                <form>
                                                    <div class="form-group mb-0">
                                                        <input type="email" id="email1" name="email" class="rounded-pill shadow" placeholder="Your Email Id">
                                                        <button type="submit" class="btn btn-pills btn-soft-primary">Join now</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
