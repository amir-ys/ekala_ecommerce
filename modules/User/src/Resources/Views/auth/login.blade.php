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
                                <p>با عضویت در سایت از همه امکانات سایت بهره مند شوید.</p>

                                <a href="{{ route('user.oauth.google.redirect') }}"
                                   class="border border-primary font-size-10 btn-block w-100 btn btn-outline-dark"
                                   role="button" style="text-transform:none"
                                >
                                    <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in"
                                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png"/>
                                    ورود با گوگل
                                </a>
                                <hr>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div >ورود با حساب</div>

                                    <div class="form-group">
                                        <label for="email" class="col-form-label">پست الکترونیک :</label>
                                        <input type="email" name="email"
                                               value="{{ old('email') }}"
                                               autocomplete="email"
                                               autofocus
                                               class="form-control  @error('email') is-invalid @enderror" id="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label">رمز عبور :</label>
                                        <input type="password" name="password"
                                               class="form-control  @error('email') is-invalid @enderror"
                                               autocomplete="current-password"
                                               id="password">
                                    </div>

                                    <x-validation-error field="password"/>
                                    <x-validation-error field="email"/>


                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="g-recaptcha"
                                                 data-sitekey="{{ config('services.google_recaptcha.key') }}">
                                            </div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                            @endif
                                    </div>




                                    <div class="form-group">
                                        <a href="profile/personal-info.html"><input type="submit"
                                                                                    value="ورود"
                                                                                    class="btn btn-success btn-square"></a>
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
