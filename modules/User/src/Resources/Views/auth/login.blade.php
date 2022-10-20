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
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="title">وارد شوید</div>
                                    <p>با عضویت در سایت از همه امکانات سایت بهره مند شوید.</p>

                                    <div class="form-group">
                                        <label for="email">پست الکترونیک :</label>
                                        <input type="email" name="email"
                                               value="{{ old('email') }}"
                                               autocomplete="email"
                                               autofocus
                                               class="form-control  @error('email') is-invalid @enderror" id="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">رمز عبور :</label>
                                        <input type="password" name="password"
                                               class="form-control  @error('email') is-invalid @enderror"
                                               autocomplete="current-password"
                                               id="password">
                                    </div>

                                    <x-validation-error field="password"/>
                                    <x-validation-error field="email"/>

                                    <div class="form-group">
                                        <a href="profile/personal-info.html"><input type="submit"
                                                                                    value="ورود"
                                                                                    class="btn btn-success"></a>
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
