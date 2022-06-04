@extends('Front::master')
@section('content')
    <section class="inner-page" id="contact-page">
        <div class="container py-2 py-md-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1">
                    <div class="content">
                        <div class="row">
                            <div class="col-12 col-lg-5 text-center">
                                <img src="/assets/front/assets/images/login.png" alt="">
                            </div>
                            <div class="col-12 col-lg-7 pt-2 pt-md-0 align-self-center">
                                <div class="title">عضویت در فروشگاه</div>
                                <p>با ورود به حساب کاربری خود از همه امکانات سایت بهره مند شوید.</p>
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">نام و نام خانوادگی :</label>
                                        <input type="text" name="fullname"
                                               class="form-control @error('fullname') is-invalid @enderror"
                                               value="{{ old('fullname') }}"
                                               id="fullname"
                                               autocomplete="name" >
                                        <x-validation-error field="fullname"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">پست الکترونیک :</label>
                                        <input type="email" name="email"
                                               value="{{ old('email') }}"
                                               autocomplete="email"
                                               class="form-control  @error('email') is-invalid @enderror" id="email">
                                        <x-validation-error field="email"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">رمز عبور :</label>
                                        <input type="password" name="password"
                                               class="form-control  @error('password') is-invalid @enderror"
                                               autocomplete="new-password"
                                               id="password">
                                        <x-validation-error field="password"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">تایید رمز عبور :</label>
                                        <input type="password"
                                               name="password_confirmation"  class="form-control @error('password') is-invalid @enderror"
                                               id="password_confirmation"
                                               autocomplete="new-password">
                                        <x-validation-error field="password"/>
                                    </div>

                                    <div class="form-group">
                                        <a href="profile/personal-info.html"><input type="submit" value="تکمیل عضویت"  class="btn btn-success"></a>
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
