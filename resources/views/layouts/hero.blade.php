<section class="bg-half-00 d- w-100"
    style="/*background: url('{{ asset('assets/img/hero/首頁模擬1-背景圖.jpg') }}') center center;*/height: 75vh;background-size:cover;"
    id="hero">

    <div class="h-100 w-100 hero-slick d-none d-md-block mt-md-6 mt-74">
        @foreach ($pageInfo as $item)
            @foreach ($item->page_banner_img as $item_img)
                <img src="{{ 'http://9o-traveller.com.tw/uploads/' . $item_img }}" class="img-fluid hero-img" alt="">
            @endforeach
        @endforeach
    </div>

    <div class="h-100 w-100 hero-slick d-block d-md-none mt-md-6 mt-74" style="height: 100vmax">
        @foreach ($pageInfo as $item)
            @foreach ($item->page_banner_img_mob as $item_img_mob)
                <img src="{{ 'http://9o-traveller.com.tw/uploads/' . $item_img_mob }}" class="img-fluid hero-img" alt="">
            @endforeach
        @endforeach
    </div>



</section>
{{-- <div class="bg-overlay" style="opacity: 0.4;"></div> --}}
{{-- <div class="home-shape-arrow">
        <a href="#newcar" class="scroll-down"><i class="mdi mdi-arrow-down arrow-icon bg-light shadow-md text-dark h5"></i></a>
    </div> --}}


<div class="position-relative">
    <div class="shape overflow-hidden text-white">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
<section class="section bg-white pb-0" id="reserve-form2s">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-12">
                <div class="card feature-top border-0 shadow-md rounded-md overflow-hidden hero-box2">
                    <form class="py-md-2 py-3 px-md-0 px-3 shadow rounded">
                        <div class="row justify-content-center text-left">
                            <div class="/*col-lg-9 col-md-8*/ col-md-10">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="form-group mb-4 mb-md-0">
                                            <label class="d-block"><span style="letter-spacing: 8px;">租車</span>地 <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control custom-select">
                                                <option selected value="台中市">台中市</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-3">
                                        <div class="form-group mb-4 mb-md-0">
                                            <label class="d-block"> 日期/時間 : </label>
                                            <input name="date" type="text"
                                                class="flatpickr flatpickr-input form-control" id="checkin-date">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-3">
                                        <div class="form-group mb-4 mb-md-0">
                                            <label class="d-block"><span style="letter-spacing: 8px;">還車</span>地 <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control custom-select">
                                                <option selected value="台中市">台中市</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-3">
                                        <div class="form-group mb-4 mb-md-0">
                                            <label class="d-block"> 日期/時間 : </label>
                                            <input name="date" type="text"
                                                class="flatpickr flatpickr-input form-control" id="checkin-date2">
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </div>

                            <div class="col-auto mt-md-4 pt-md">
                                <!-- <input type="submit" id="search" name="search" class="searchbtn btn btn-primary btn-block" value="Search"> -->
                                <a href="" class="img-fluid btn-block"><img
                                        src="{{ asset('assets/img/icon/search.png') }}" class="pb-2" width="50px"
                                        alt=""></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->


{{-- <div class="container">
    <div class="row mt-5 align-items-center">
        <div class="col-lg-4 col-md-6 position-relative hero-content">
            <div class="bg-white shadow-lg rounded p-4 hero-box">
                <div class="text-center">
                    <h5 class="mb-4 pb-2">Book Rv</h5>
                </div>
                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Your Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control bg-light" name="email" required=""
                                    placeholder="Your Email :">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                            <div class="form-group">
                                <label> Date : <span class="text-danger">*</span></label>
                                <input name="date" type="text" class="flatpickr flatpickr-input form-control bg-light"
                                    id="checkin-date">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Space size : <span class="text-danger">*</span></label>
                                <input type="number" min="1" autocomplete="off" id="adult"
                                    required="" class="form-control bg-light" placeholder="1">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Company <span class="text-danger">*</span></label>
                                <select class="form-control custom-select bg-light">
                                    <option selected value="1">Private office</option>
                                    <option value="2">Dedicated Space</option>
                                    <option value="3">Small office</option>
                                    <option value="4">Floating Seat</option>
                                    <option value="5">Startups Desk</option>
                                    <option value="6">Retail Space</option>
                                    <option value="7">Meeting Room</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input bg-light" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">I Accept <a
                                            href="#" class="text-primary">Terms And Condition</a></label>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                            <button class="btn btn-danger btn-block">Reserve Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>
<!--end container--> --}}

{{-- <div class="container">
    <div class="row justify-content-center hero-content mt-5 pt-5">
        <div class="col-lg-auto my-auto">
            <div class="card border-0 shadow-md rounded-lg overflow-hidden hero-box2">
                <form class="py-md-2 py-3 px-md-0 px-3 shadow bg-white rounded">
                    <div class="row justify-content-center text-left">
                        <div class="/*col-lg-9 col-md-8*/ col-md-10">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group mb-4 mb-md-0">
                                        <label class="d-block">租車地 <span class="text-danger">*</span></label>
                                        <select class="form-control custom-select">
                                            <option selected value="us">U.S.A</option>
                                            <option value="in">India</option>
                                            <option value="nz">New Zealand</option>
                                            <option value="ch">China</option>
                                            <option value="pak">Pakistan</option>
                                            <option value="kor">Korea</option>
                                            <option value="rus">Russia</option>
                                        </select>
                                    </div>
                                </div><!--end col-->

                                <div class="col-md-3">
                                    <div class="form-group mb-4 mb-md-0">
                                        <label class="d-block"> 日期/時間 : </label>
                                        <input name="date" type="text" class="flatpickr flatpickr-input form-control" id="checkin-date">
                                    </div>
                                </div><!--end col-->

                                <div class="col-md-3">
                                    <div class="form-group mb-4 mb-md-0">
                                        <label class="d-block">還車地 <span class="text-danger">*</span></label>
                                        <select class="form-control custom-select">
                                            <option selected value="us">U.S.A</option>
                                            <option value="in">India</option>
                                            <option value="nz">New Zealand</option>
                                            <option value="ch">China</option>
                                            <option value="pak">Pakistan</option>
                                            <option value="kor">Korea</option>
                                            <option value="rus">Russia</option>
                                        </select>
                                    </div>
                                </div><!--end col-->

                                <div class="col-md-3">
                                    <div class="form-group mb-4 mb-md-0">
                                        <label class="d-block"> 日期/時間 : </label>
                                        <input name="date" type="text" class="flatpickr flatpickr-input form-control" id="checkin-date2">
                                    </div>
                                </div><!--end col-->
                            </div>
                        </div>

                        <div class="col-auto mt-md-4 pt-md">
                            <!-- <input type="submit" id="search" name="search" class="searchbtn btn btn-primary btn-block" value="Search"> -->
                            <a href="" class="img-fluid btn-block"><img src="{{ asset('assets/img/icon/search.png') }}" class="pb-2" width="50px" alt=""></a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container--> --}}
