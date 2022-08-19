@extends('Dashboard::master')
@section('title' , __('Setting::translation.contact.save'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('panel.settings.index') }}">@lang('Setting::translation.index')</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('panel.settings.contact.index') }}">@lang('Setting::translation.contact.index')</a></li>
    <li class="breadcrumb-item active"><a >@lang('Setting::translation.contact.save')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        @lang('Setting::translation.contact.save')
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.settings.contact.save') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="email"> پست الکترونیک
                                    </label>
                                    <input type="text" class="form-control" id="email"
                                           name="email" placeholder="پست الکترونیک" value="{{ $contact ?  $contact->json['email'] : null }}">
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="phone_number_1"> تلفن تماس
                                    </label>
                                    <input type="text" class="form-control" id="phone_number_1"
                                           name="phone_number_1" placeholder="تلفن تماس" value="{{ $contact ?  $contact->json['phone_number_1'] : null }}">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-md-2">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="phone_number_2">  </label>
                                    <input type="text" class="form-control" id="phone_number_2"
                                           name="phone_number_2" placeholder="تلفن تماس" value="{{ $contact ?  $contact->json['phone_number_2'] : null }}">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="text-capitalize" for="shop_address"> آدرس فروشگاه
                                    </label>
                                    <textarea class="form-control" name="shop_address" id="shop_address" rows="3">{{ $contact ?  $contact->json['shop_address'] : null }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-uppercase">
                                    <i class="ti-check-box m-l-5"></i>ذخیره
                                </button>
                                <a href="{{ route('panel.settings.contact.index') }}"
                                   class="btn btn-secondary waves-effect">
                                    بازگشت
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="/assets/panel/vendors/ckeditor/ckeditor.js"></script>
    <script>

        ClassicEditor
            .create(document.querySelector('#shop_address'))
            .catch(error => {
                console.error(error);
            });

    </script>
@endsection
