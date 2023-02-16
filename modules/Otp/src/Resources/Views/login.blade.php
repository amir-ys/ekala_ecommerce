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

                                <form action="{{ route('front.otp.request') }}" method="post">
                                    @csrf
                                    <h5>ورود | ثبت‌نام</h5>

                                    <div class="form-group">
                                       <div class="mb-md-4">
                                           <small style="color: #3f4064 ; font-size: 13px">
                                               سلام!
                                           </small>
                                           <br>
                                           <small style="color: #3f4064 ; font-size: 13px">
                                               لطفا شماره موبایل خود را وارد کنید
                                           </small>
                                       </div>
                                        <input type="number" name="phone_number"
                                               value="{{ old('phone_number') }}"
                                               autocomplete="phone_number"
                                               autofocus
                                               class="form-control  @error('phone_number') is-invalid @enderror"
                                               id="phone_number">
                                    </div>

                                    <x-validation-error field="phone_number"/>


                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="g-recaptcha"
                                                 data-sitekey="{{ config('services.google_recaptcha.key') }}">
                                            </div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <small
                                                    class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                            @endif
                                        </div>


                                        <div class="col-md-12">
                                                <input type="submit" value="ورود" style="width:100%!important;" class="btn input-block-level  btn-block btn-success btn-square width-100">
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


