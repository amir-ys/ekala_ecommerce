@extends('Dashboard::master')
@section('title' , 'ویرایش  برند')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.brands.index') }}"> برند ها </a></li>
    <li class="breadcrumb-item active"><a > ویرایش برند</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header">
                        <div class="alert alert-primary" role="alert">
                            <div class="font-size-12 text-left">  تاریخ اخرین بروزرسانی : {{ getJalaliDate($brand->updated_at) }}</div>
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
                                                       value="{{ old('name' , $brand->name) }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
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
                                                @error('is_active')
                                                <div class="invalid-feedback">
                                                    <strong> {{ $message }} </strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 offset-3">
                                <button type="submit" class="btn btn-primary btn-uppercase">
                                    <i class="ti-check-box m-l-5"></i>بروزرسانی
                                </button>
                                <a href="{{ route('panel.brands.index') }}" class="btn btn-secondary waves-effect">
                                    بازگشت
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->
@endsection
