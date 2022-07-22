@extends('Dashboard::master')
@section('title' , __('Setting::translation.contact.show'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('panel.settings.index') }}">@lang('Setting::translation.index')</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('panel.settings.contact.index') }}">@lang('Setting::translation.contact.index')</a></li>
    <li class="breadcrumb-item active"><a >@lang('Setting::translation.contact.show')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-11">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        @lang('Setting::translation.contact.show')
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="name">نام
                                    </label>
                                    <input type="text" readonly class="form-control" id="name"
                                           value="{{ $contact->name }}">
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="phone_number"> تلفن تماس
                                    </label>
                                    <input type="text" readonly class="form-control" id="phone_number"
                                           value="{{ $contact->phone_number }}">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="email">پست الکترونیکی
                                    </label>
                                    <input type="text" readonly class="form-control" id="email"
                                           value="{{ $contact->email }}">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="text-capitalize"
                                           for="subject"> موضوع پیام
                                    </label>
                                    <input type="text" readonly class="form-control" id="subject"
                                           value="{{ $contact->subject }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="text-capitalize" for="message"> متن پیام
                                    </label>
                                    <textarea class="form-control" id="message" rows="10" readonly>
                                        {{ $contact->message }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <a href="{{ route('panel.settings.contact.index') }}"
                                   class="btn btn-secondary waves-effect">
                                    بازگشت
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
