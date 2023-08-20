@extends('layouts.master')

@section('content_section')
    <section class="section pt-5 mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="card map border-0">
                        <div class="card-body p-0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7281.646363622345!2d120.62356299999999!3d24.142847!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693dd7651b778d%3A0xbb47f28330ba021c!2z5b635ZyL5q2Q6aas5peX6Imm57i96YOoLeWPsOS4reWkluWMr-i7iuiyv-aYk-WVhu-8iOS5neatkOaXheihjOWutu-8iQ!5e0!3m2!1szh-TW!2stw!4v1671702734465!5m2!1szh-TW!2stw"
                                style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row align-items-end">
                <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="card custom-form rounded shadow border-0">
                        <div class="card-body">
                            <div id="message"></div>
                            <form method="post" action="php/contact.php.html" name="contact-form" id="contact-form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative">
                                            <label>Your Name <span class="text-danger">*</span></label>
                                            <input name="name" id="name" type="text" class="form-control"
                                                placeholder="First Name :">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative">
                                            <label>Your Email <span class="text-danger">*</span></label>
                                            <input name="email" id="email" type="email" class="form-control"
                                                placeholder="Your email :">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label>Subject</label>
                                            <input name="subject" id="subject" type="text" class="form-control"
                                                placeholder="Subject">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="form-group position-relative">
                                            <label>Comments</label>
                                            <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Your Message :"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <input type="submit" id="submit" name="send"
                                            class="submitBnt btn btn-primary3 btn-block" value="Send Message">
                                        <div id="simple-msg"></div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                            <!--end form-->
                        </div>
                    </div>
                    <!--end custom-form-->
                </div>
                <!--end col-->

                <div class="col-lg-7 col-md-6">
                    <img src="{{ asset('assets/images/contact.svg') }}" class="img-fluid" alt="">
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="media feature">
                        <div class="icons m-0 rounded-md h2 text-primary text-center px-3">
                            <i class="uil uil-phone"></i>
                        </div>
                        <div class="content ml-4">
                            <h5>Phone</h5>
                            {{-- <p class="text-muted">Start working with Landrick that can provide everything</p> --}}
                            <a href="tel:04-2380-4386" class="text-primary">04-2380-4386</a>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 mt-5 mt-sm-0">
                    <div class="media feature">
                        <div class="icons m-0 rounded-md h2 text-primary text-center px-3">
                            <i class="uil uil-envelope"></i>
                        </div>
                        <div class="content ml-4">
                            <h5>Email</h5>
                            {{-- <p class="text-muted">Start working with Landrick that can provide everything</p> --}}
                            <a href="mailto:contact@example.com" class="text-primary">contact@example.com</a>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 mt-5 mt-lg-0">
                    <div class="media feature">
                        <div class="icons m-0 rounded-md h2 text-primary text-center px-3">
                            <i class="uil uil-map-marker"></i>
                        </div>
                        <div class="content ml-4">
                            <h5>Location</h5>
                            <p class="text-muted">台中市南屯區環中路四段161號</p>
                            <a href="https://goo.gl/maps/biKuasq6JusbMqXo7" target="_blank"
                                class="text-primary">View on Google map</a>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
@endsection
@push('scripts')
    <script>
        localStorage.removeItem('savedInput');
    </script>
@endpush
