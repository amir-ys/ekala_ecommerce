@extends('Front::master')
@section('content')

    <section class="inner-page" id="contact-page">
        <div class="container py-2 py-md-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1">
                    <div class="content">
                        <div class="row">
                            <div class="col-12 col-lg-5 text-center">
                                <img src="assets/front/assets/images/login.png" alt="">
                            </div>
                            <div class="col-12 col-lg-7 pt-5 pt-md-0 align-self-center">
                                @csrf
                                <div class="title">تایید حساب کاربری</div>
                                <p>
                                    یک لینک تایید به ایمیل شما فرستاد
                                </p>

                                <form action="{{ route('verification.send') }}" method="post">
                                    @csrf
                                    <button type="submit" href="" class="btn btn-primary"> ارسال مجدد لینک تایید</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
