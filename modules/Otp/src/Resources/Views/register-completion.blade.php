@extends('Front::master-without-header')
@section('content')
    <section class="inner-page" id="contact-page">
        <div class="container py-2 py-md-5">
            <div class="row d-flex justify-content-around">
                <div class="col-12 col-lg-4 pt-5 pt-md-0 align-self-center ">
                    <div class="card border border-2 ">
                        <div class="card-body shadow">

                            <div class="row justify-content-around">
                                <div class="col-12 col-md-3 col-xl-2 text-center text-md-start pb-2" id="header-logo">
                                    <a href="/">
                                        <img src="/assets/front/assets/images/logo.png" alt=""> ای کالا
                                    </a>
                                </div>

                                <form action="{{ route('front.otp.registerCompletion') }}" method="post">
                                    @csrf
                                    <h5> تکمیل ثبت نام  </h5>

                                    <input type="hidden" name="phone_number" value="{{session()->get('phone_number') }}">
                                    <div class="form-group">
                                        <label class="col-form-label text-capitalize" for="first_name"> نام  </label>
                                        <input type="text" name="first_name"
                                               value="{{ old('first_name') }}"
                                               autocomplete="first_name"
                                               autofocus
                                               class="form-control  @error('first_name') is-invalid @enderror"
                                               id="first_name">
                                    </div>

                                    <x-validation-error field="first_name"/>


                                    <div class="form-group">
                                        <label class="col-form-label text-capitalize"
                                               for="last_name"> نام خانوادگی </label>
                                        <input type="text" name="last_name"
                                               value="{{ old('last_name') }}"
                                               class="form-control  @error('last_name') is-invalid @enderror"
                                               id="last_name">
                                    </div>

                                    <x-validation-error field="last_name"/>

                                    <div class="form-group">
                                        <label class="col-form-label text-capitalize"
                                               for="email">  ایمیل </label>
                                        <input type="email" name="email"
                                               value="{{ old('email') }}"
                                               class="form-control  @error('email') is-invalid @enderror"
                                               id="email">
                                    </div>
                                    <x-validation-error field="email"/>

                                        <div class="col-md-12">
                                                <input type="submit" value="تکمیل ثبت نام" style="width:100%!important;"
                                                       class="btn input-block-level  btn-block btn-success btn-square width-100">
                                        </div>

                                    <div class="col-md-12 mt-md-2">
                                        <a  href="{{ route('front.home') }}"  style="width:100%!important;"
                                               class="btn input-block-level  btn-block btn-danger btn-square width-100">
                                            بعدا تکمیل میکنم
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src='https://www.google.com/recaptcha/api.js?hl=fa'></script>
@endsection


