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
                            <div class="col-12 col-lg-7  pt-md-0 align-self-center">
                                <div class="title">عضویت در فروشگاه</div>
                                <p>با ورود به حساب کاربری خود از همه امکانات سایت بهره مند شوید.</p>
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="first_name">نام   :</label>
                                        <input type="text" name="first_name"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               value="{{ old('first_name') }}"
                                               id="first_name"
                                               autocomplete="first_name" >
                                        <x-validation-error field="first_name"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name"> نام خانوادگی :</label>
                                        <input type="text" name="last_name"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               value="{{ old('last_name') }}"
                                               id="last_name"
                                               autocomplete="last_name" >
                                        <x-validation-error field="last_name"/>
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
                                        <input type="submit" value="عضویت"  class="btn btn-success">
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
