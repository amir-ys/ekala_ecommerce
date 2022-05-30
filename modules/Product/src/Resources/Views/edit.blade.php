@extends('Dashboard::master')
@section('title' , __('Product::translation.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.products.index') }}"> @lang('Product::translation.index') </a></li>
    <li class="breadcrumb-item active"><a > @lang('Product::translation.edit')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            <div class="row">
                                <div class="col-md-6">
                                    @lang('Product::translation.edit') "{{ $product->name }}"
                                </div>
                                <div class="col-md-6">
                                    <div class="font-size-12 text-left">  تاریخ اخرین بروزرسانی : {{ getJalaliDate($product->updated_at) }}</div>
                                </div>
                            </div>
                    </div>
                    <div class="card-body">
                            <form method="POST" action="{{ route('panel.products.update' , $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label>نام</label>
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="نام"
                                                   value="{{ old('name' , $product->name) }}">
                                            <x-validation-error field="name"/>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label>قیمت</label>
                                            <input type="text" class="form-control" name="price"
                                                   placeholder="قیمت"
                                                   value="{{ old('price' , $product->price) }}">
                                            <x-validation-error field="price"/>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label>موجودی</label>
                                            <input type="text" class="form-control" name="quantity"
                                                   placeholder="موجودی"
                                                   value="{{ old('quantity' , $product->quantity) }}">
                                            <x-validation-error field="quantity"/>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label>برند</label>
                                            <select class="form-control" name="brand_id">
                                                <option value>  یک برند را انتخاب کنید </option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                            @if($brand->id == $product->brand_id ) selected @endif>
                                                        {{ $brand->name }} </option>
                                                @endforeach
                                            </select>
                                            <x-validation-error field="brand_id"/>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label>وضعیت</label>
                                            <select class="form-control" name="is_active">
                                                <option value>  یک وضعیت را انتخاب کنید</option>
                                                @foreach(\Modules\Product\Enums\ProductStatus::cases() as $status)
                                                    <option value="{{ $status->value }}"
                                                            @selected($status->value == $product->is_active->value)
                                                    > {{ $status->name }} </option>
                                                @endforeach
                                            </select>
                                            <x-validation-error field="is_active"/>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label>دسته بندی ها</label>
                                            <select class="form-control"  name="category_id">
                                                <option value>  انتخاب  دسته بندی </option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            @if($category->id == $product->category_id ) selected @endif
                                                    >{{ $category->name }} </option>
                                                @endforeach
                                            </select>
                                            <x-validation-error field="category_id"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 mb-3" >
                                            <label>توضیحات</label>
                                            <textarea id="ckeditor" class="form-control" name="description"> {{ old('description' , $product->description) }}</textarea>
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
                                               <input type="file" class="form-control" name="primary_image" />
                                               <x-validation-error field="primary_image"/>
                                               @if(isset($product->primaryImage))
                                                   <p>تصویر اصلی : </p>
                                                   <img width="200" src="{{ route('panel.products.images.display' , $product->primaryImage->name) }}" alt="">
                                               @endif
                                           </div>
                                       </div>
                                        <div class="col-md-6">
                                           <div class="col-md-9">
                                               <label>انتخاب تصاوبر دیگر</label>
                                               <input type="file" multiple class="form-control" name="images[]" />
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
                                                       value="{{ old('special_price' , $product->special_price) }}" placeholder="مقدار تخفیف " />
                                                <x-validation-error field="special_price"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-9">
                                                <label>از تاریخ</label>
                                                <input type="text"  class="form-control"
                                                       value="{{ old('special_price_start' , $product->special_price_start) }}"
                                                       name="special_price_start" placeholder="تاریخ شروع" />
                                                <x-validation-error field="special_price_start"/>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="col-md-9">
                                                <label>تا تاریخ</label>
                                                <input type="text"  class="form-control"
                                                       value="{{ old('special_price_end' , $product->special_price_end) }}"
                                                       name="special_price_end" placeholder="تاریخ پایان" />
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
                                                <i class="ti-check-box m-l-5"></i>بروزرسانی
                                            </button>
                                            <a href="{{ route('panel.products.index') }}" class="btn btn-secondary waves-effect">
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
