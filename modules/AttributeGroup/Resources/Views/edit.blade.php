@extends('Dashboard::master')
@section('title' , 'ویرایش  گروه مشخصات')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.attributeGroups.index') }}"> گروه مشخصات  </a></li>
    <li class="breadcrumb-item active"><a> ویرایش گروه مشخصات</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header">
                        <div class="alert alert-primary" role="alert">
                            <div class="font-size-12 text-left">  تاریخ اخرین بروزرسانی : {{ getJalaliDate($attributeGroup->updated_at) }}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.attributeGroups.update' , $attributeGroup->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{ old('name' , $attributeGroup->name) }}">
                                                @error('name')
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
                                <a href="{{ route('panel.attributeGroups.index') }}" class="btn btn-secondary waves-effect">
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