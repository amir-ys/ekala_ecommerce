@extends('Dashboard::master')
@section('title'  ,__('Product::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Product::translation.index')</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p>
                        انتخاب ویژگی های محصول

                    </p>
                </div>
                @if($product->category->attributeGroups->count()  > 0)
                    <div class="card-body">
                        <form action="{{ route('panel.products.attributes.save' , $product->id) }}" method="post">
                            @csrf
                            <div class="row">
                                @foreach($product->category->attributeGroups as $attributeGroup)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{  $attributeGroup->name }}</h5>
                                                @foreach($attributeGroup->attributes as $attribute)
                                                    <div class="form-group">
                                                        <div class="custom-control">
                                                            <label for="customCheck">{{ $attribute->name }}</label>
                                                            <input type="text" name="attributes[{{ $attribute->id }}]"
                                                                   placeholder="{{ $attribute->name }}"
                                                                   value="{{ $attribute->getValueForProduct($product) }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                            </div>
                        </form>
                    </div>
                @else
                    <div class="text-center mb-3">
                        <h5>
                            هیچ ویژگی انتخاب نشده است
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
