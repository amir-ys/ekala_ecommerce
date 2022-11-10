@extends('Dashboard::master')
@section('title' , __('Product::translation.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.products.index') }}"> @lang('Product::translation.index') </a>
    </li>
    <li class="breadcrumb-item active"><a> @lang('Product::translation.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card overflow-hidden border border-5">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        @lang('Product::translation.create')
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <label>نام</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="نام"
                                           value="{{ old('name') }}">
                                    <x-validation-error field="name"/>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label>قیمت</label>
                                    <input type="number" class="form-control" name="price"
                                           placeholder="قیمت"
                                           value="{{ old('price') }}">
                                    <x-validation-error field="price"/>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>برند</label>
                                    <select class="form-control" name="brand_id">
                                        <option value> یک برند را انتخاب کنید</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                    @if($brand->id == old('brand_id')) selected @endif>
                                                {{ $brand->name }} </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="brand_id"/>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>دسته بندی </label>
                                    <select class="form-control" name="category_id">
                                        <option value> یک دسته بندی را انتخاب کنید</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($category->id == old('category_id')) selected @endif
                                            >{{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="category_id"/>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>قابل فروش بودن</label>
                                    <select class="form-control" name="is_marketable">
                                        <option value> یک وضعیت را انتخاب کنید</option>
                                        @foreach(\Modules\Product\Models\Product::$morketableStatuses as $name => $status)
                                            <option value="{{ $status }}"
                                                @selected(\Modules\Product\Models\Product::MARKETABLE == $status)
                                            > {{ $name }} </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="is_marketable"/>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>وضعیت</label>
                                    <select class="form-control" name="is_active">
                                        <option value> یک وضعیت را انتخاب کنید</option>
                                        @foreach(\Modules\Product\Enums\ProductStatus::cases() as $status)
                                            <option value="{{ $status->value }}"
                                                    @selected(old('is_active') == $status->value)
                                            > @lang($status->name) </option>
                                        @endforeach
                                    </select>
                                    <x-validation-error field="is_active"/>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>  انتخاب رنگ محصول : </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="col-form-label">نام</label>
                                        <input type="text" class="form-control" name="color_name"
                                               placeholder="نام"
                                               value="{{ old('color_name') }}">
                                        <x-validation-error field="color_name"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">کد رنگ (hex)</label>
                                    <div class="input-group sample-selector colorpicker-element">
                                        <input type="text" class="form-control text-right" dir="ltr" name="color_value"
                                               placeholder="کد رنگ (hex)" id="color_name"
                                               value="{{ old('color_value') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i style="background-color: rgb(225, 72, 72);"></i></span>
                                        </div>
                                        <x-validation-error field="color_value"/>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="col-form-label">موجودی</label>
                                    <input type="text" class="form-control" name="quantity"
                                           placeholder="موجودی"
                                           value="{{ old('quantity') }}">
                                    <x-validation-error field="quantity"/>
                                </div>

                            </div>
                        </div>


                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>توضیحات</label>
                                    <textarea id="description" class="form-control"
                                              name="description"> {{ old('description') }}</textarea>
                                    <x-validation-error field="description"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label> انتخاب تصاویر محصول : </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-9">
                                        <label>انتخاب تصویر اصلی</label>
                                        <input type="file" class="form-control" name="primary_image"/>
                                        <x-validation-error field="primary_image"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-9">
                                        <label>انتخاب تصاوبر دیگر</label>
                                        <input type="file" multiple class="form-control" name="images[]"/>
                                        <x-validation-error field="images"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label> تخفیف کالا : </label>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-9">
                                        <label> مقدار تخفیف محصول </label>
                                        <input type="number" class="form-control" name="special_price"
                                               value="{{ old('special_price') }}" placeholder="مقدار تخفیف "/>
                                        <x-validation-error field="special_price"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-9">
                                        <label>از تاریخ</label>
                                        <input type="text" class="form-control"
                                               value="{{ old('special_price_start') }}" id="special_price_start"
                                               name="special_price_start" placeholder="تاریخ شروع"/>
                                        <x-validation-error field="special_price_start"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-9">
                                        <label>تا تاریخ</label>
                                        <input type="text" class="form-control"
                                               value="{{ old('special_price_end') }}" id="special_price_end"
                                               name="special_price_end" placeholder="تاریخ پایان"/>
                                        <x-validation-error field="special_price_end"/>
                                    </div>
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
                                    <a href="{{ route('panel.products.index') }}"
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
    <link rel="stylesheet" href="/assets/panel/vendor/persian-datepicker/persian-datepicker.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/panel/vendors/colorpicker/css/bootstrap-colorpicker.min.css" type="text/css">
@endsection
@section('script')
    <script src="/assets/panel/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/panel/vendor/persian-datepicker/persian-date.min.js"></script>
    <script src="/assets/panel/vendor/persian-datepicker/persian-datepicker.min.js"></script>
    <script>

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        $('#special_price_start').persianDatepicker({
            observer: true,
            initialValue: false,
            initialValueType: 'persian' ,
            format: 'YYYY/MM/DD HH:mm',
            timePicker  : {
                enabled : true ,
                second : {
                    enabled : false,
                }
            }
        });
        $('#special_price_end').persianDatepicker({
            observer: true,
            initialValue: false,
            initialValueType: 'persian' ,
            format: 'YYYY/MM/DD HH:mm',
            timePicker  : {
                enabled : true ,
                second : {
                    enabled : false,
                }
            }
        });
    </script>

{{--    //color--}}
    <script src="/assets/panel/vendors/colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/panel/js/examples/colorpicker.js"></script>
    <script>
        $('.sample-selector').colorpicker().on('changeColor', function(e) {
            $('#color_name').attr( 'value' ,e.color.toString('rgba'));
        });
    </script>
@endsection


