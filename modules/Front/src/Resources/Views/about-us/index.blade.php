@extends('Front::master')
@section('content')

    <section class="inner-page" id="contact-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>درباره ما</h1>
                                <p>با ما بیشتر آشنا شوید.</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">درباره ما</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <div class="title">{{ $about ? $about->json['title'] : null }}</div>
                                    {!!  $about ? $about->json['description'] : null !!}
                                </div>
                                <div class="col-12 col-lg-5 align-self-center h-100">
                                    <img src="{{ $about ? $about->imagePath() : null }}" alt="">
                                </div>
                            </div>
                            <!-- Team -->
{{--                            <div class="row pt-5">--}}
{{--                                <div class="col-12 text-center pt-4 pb-3">--}}
{{--                                    <h2 class="center-title">تیم ما</h2>--}}
{{--                                    <span class="sub-title">با تیم ما بیشتر آشنا شوید.</span>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6 col-lg-3">--}}
{{--                                    <!-- Person Box -->--}}
{{--                                    <figure class="team-person">--}}
{{--                                        <div class="profile-image"><img src="assets/images/team/team-person1.jpg" alt="sample47" /></div>--}}
{{--                                        <figcaption>--}}
{{--                                            <h3>مجید کیانی</h3>--}}
{{--                                            <h4>مدیر عامل</h4>--}}
{{--                                            <p>به عنوان مدیر عامل در تیم فعالیت دارد.</p>--}}
{{--                                            <div class="icons"><a href="#"><i class="ion-social-reddit"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-twitter"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-vimeo"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </figcaption>--}}
{{--                                    </figure>--}}
{{--                                    <!-- /Person Box -->--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6 col-lg-3">--}}
{{--                                    <!-- Person Box -->--}}
{{--                                    <figure class="team-person">--}}
{{--                                        <div class="profile-image"><img src="assets/images/team/team-person2.jpg" alt="sample47" /></div>--}}
{{--                                        <figcaption>--}}
{{--                                            <h3>پوریا طلایی</h3>--}}
{{--                                            <h4>برنامه نویس</h4>--}}
{{--                                            <p>به عنوان برنامه نویس در تیم فعالیت دارد.</p>--}}
{{--                                            <div class="icons"><a href="#"><i class="ion-social-reddit"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-twitter"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-vimeo"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </figcaption>--}}
{{--                                    </figure>--}}
{{--                                    <!-- /Person Box -->--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6 col-lg-3">--}}
{{--                                    <!-- Person Box -->--}}
{{--                                    <figure class="team-person">--}}
{{--                                        <div class="profile-image"><img src="assets/images/team/team-person3.jpg" alt="sample47" /></div>--}}
{{--                                        <figcaption>--}}
{{--                                            <h3>امیر جاوید</h3>--}}
{{--                                            <h4>تولید کننده محتوا</h4>--}}
{{--                                            <p>به عنوان تولید کننده محتوا در تیم فعالیت دارد.</p>--}}
{{--                                            <div class="icons"><a href="#"><i class="ion-social-reddit"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-twitter"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-vimeo"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </figcaption>--}}
{{--                                    </figure>--}}
{{--                                    <!-- /Person Box -->--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6 col-lg-3">--}}
{{--                                    <!-- Person Box -->--}}
{{--                                    <figure class="team-person">--}}
{{--                                        <div class="profile-image"><img src="assets/images/team/team-person4.jpg" alt="sample47" /></div>--}}
{{--                                        <figcaption>--}}
{{--                                            <h3>وحید کمالی</h3>--}}
{{--                                            <h4>دیجیتال مارکتر</h4>--}}
{{--                                            <p>به عنوان دیجیتال مارکتر در تیم فعالیت دارد.</p>--}}
{{--                                            <div class="icons"><a href="#"><i class="ion-social-reddit"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-twitter"></i></a>--}}
{{--                                                <a href="#"> <i class="ion-social-vimeo"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </figcaption>--}}
{{--                                    </figure>--}}
{{--                                    <!-- /Person Box -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- Team -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
