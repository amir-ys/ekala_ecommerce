@extends('Dashboard::master')
@section('title' , __('Product::translation.color.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.products.colors.index' , $product->id) }}"> @lang('Product::translation.color.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Product::translation.color.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        @lang('Product::translation.color.create')
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.products.colors.store' , $product->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>نام</label>
                                    <input type="text" class="form-control" name="color_name"
                                           placeholder="نام"
                                           value="{{ old('color_name') }}">
                                    <x-validation-error field="color_name"/>
                                </div>

                                <div class="col-md-4">
                                        <label>کد رنگ (hex)</label>
                                    <div class="input-group sample-selector colorpicker-element">
                                        <input type="text" class="form-control text-right" dir="ltr" name="color_value"
                                               placeholder="کد رنگ (hex)" id="color_name"
                                               value="{{ old('color_value') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i style="background-color: rgb(225, 72, 72);"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>مقدار افزایش قیمت </label>
                                    <input type="number" class="form-control" name="price_increase"
                                           placeholder="مقدار افزایش قیمت "
                                           value="{{ old('price_increase') }}">
                                    <x-validation-error field="price_increase"/>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary btn-uppercase">
                                        <i class="ti-check-box m-l-5"></i>ذخیره
                                    </button>
                                    <a href="{{ route('panel.products.colors.index' , $product->id) }}"
                                       class="btn btn-secondary waves-effect">
                                        بازگشت
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('css')
    <link rel="stylesheet" href="/assets/panel/vendors/colorpicker/css/bootstrap-colorpicker.min.css" type="text/css">
@endsection
@section('script')
    <script src="/assets/panel/vendors/colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/panel/js/examples/colorpicker.js"></script>
    <script>
        $('.sample-selector').colorpicker().on('changeColor', function(e) {
            $('#color_name').attr( 'value' ,e.color.toString('rgba'));
        });
    </script>
@endsection
