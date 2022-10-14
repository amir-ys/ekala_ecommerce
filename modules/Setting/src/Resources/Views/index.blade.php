@extends('Dashboard::master')
@section('title'  ,__('Setting::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Setting::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="card border border-primary">
                <div class="card-body">
                    <a class="btn btn-outline-primary" href="{{ route('panel.settings.about.page') }}">
                        <span>
                            مدیریت صفحه درباره ما
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card border border-primary">
                <div class="card-body">
                    <a class="btn btn-outline-primary" href="{{ route('panel.settings.contact.index') }}">
                        <span>
                            مدیریت صفحه تماس با ما
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 text-center">
            <div class="card border border-primary">
                <div class="card-body">
                    <a class="btn btn-outline-primary" href="{{ route('panel.settings.faqs.index') }}">
                        <span>
                            مدیریت سوالات متداول
                        </span>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card border border-primary">
                <div class="card-header">
                    اطلاعات فروشگاه
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.settings.siteInfo.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shop_name"> نام فروشگاه </label>
                                    <input type="text" name="shop_name" id="shop_name" class="form-control"
                                           value="{{ optional($shopName)->value }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shop_footer"> پاورقی (footer) </label>
                                    <textarea name="shop_footer" class="form-control"
                                              id="shop_footer">{{ optional($shopFooter)->value }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shop_footer_contact"> پاورقی تماس (footer) </label>
                                    <textarea name="shop_footer_contact" class="form-control"
                                              id="shop_footer_contact">{{ optional($shopFooterContact)->value }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"
                                        href="{{ route('panel.settings.siteInfo.store') }}">
                                    ذخیره
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border border-primary">
                <div class="card-header">
                    شبکه های اجتماعی
                    <br>
                <small>*
                    لینک باید با https وارد شود</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.settings.socialMedia.store') }}" method="post">
                        @csrf
                        <div class="row">


                            <div class="col-md-12 mb-md-1">
                                <div class="row">
                                       <div class="col-md-2">
                                           <label for="facebook"> فیسبوک </label>
                                       </div>
                                       <div class="col-md-10">
                                           <input type="text" name="facebook" id="facebook" class="form-control"
                                                  value="{{ isset($socialMedia->json['facebook']) ? $socialMedia->json['facebook'] : '' }}">
                                       </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-md-1">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="instagram"> اینستاگرام </label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="instagram" id="instagram" class="form-control"
                                               value="{{ isset($socialMedia->json['instagram']) ? $socialMedia->json['instagram'] : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-md-1">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="linkedin"> لینکدین </label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="linkedin" id="linkedin" class="form-control"
                                               value="{{ isset($socialMedia->json['linkedin']) ? $socialMedia->json['linkedin'] : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-md-1">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="twitter"> توییتر </label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="twitter" id="twitter" class="form-control"
                                               value="{{ isset($socialMedia->json['twitter']) ? $socialMedia->json['twitter'] : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-md-1">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="youtube"> یوتیوب </label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="youtube" id="youtube" class="form-control"
                                               value="{{ isset($socialMedia->json['youtube']) ? $socialMedia->json['youtube'] : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-md-3">
                                <button type="submit" class="btn btn-primary"
                                        href="{{ route('panel.settings.siteInfo.store') }}">
                                    ذخیره
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
