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
    </div>
@endsection
