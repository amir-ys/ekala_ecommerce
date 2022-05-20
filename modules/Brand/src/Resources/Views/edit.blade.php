@extends('Dashboard::master')
@section('title' , __('Brand::translation.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.brands.index') }}"> @lang('Brand::translation.index') </a></li>
    <li class="breadcrumb-item active"><a> @lang('Brand::translation.edit')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            <div class="row">
                                <div class="col-md-6">
                                    @lang('Brand::translation.edit') "{{ $brand->name }}"
                                </div>
                                <div class="col-md-6">
                                    <div class="font-size-12 text-left"> تاریخ اخرین بروزرسانی
                                        : {{ getJalaliDate($brand->updated_at) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.brands.update' , $brand->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="نام"
                                                       value="{{ old('name' , $brand->name) }}">
                                                <x-validation-error field="name"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">وضعیت</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="is_active" aria-hidden="true">
                                                    <option value>یک وضعیت را انتخاب کنید</option>
                                                    @foreach(\Modules\Brand\Enums\BrandStatus::cases() as  $status)
                                                        <option
                                                            value="{{ $status->value }}"
                                                            @selected($status->value == $brand->is_active->value)
                                                        >  @lang($status->name) </option>
                                                    @endforeach
                                                </select>
                                                <x-validation-error field="is_active"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-9 offset-md-3">
                                            <button type="submit" class="btn btn-primary btn-uppercase">
                                                <i class="ti-check-box m-l-5"></i>بروزرسانی
                                            </button>
                                            <a href="{{ route('panel.brands.index') }}" class="btn btn-secondary waves-effect">
                                                بازگشت
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->
@endsection
