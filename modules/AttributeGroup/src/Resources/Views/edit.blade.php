@extends('Dashboard::master')
@section('title' , __('AttributeGroup::translation.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.attributeGroups.index') }}"> @lang('AttributeGroup::translation.index') </a></li>
    <li class="breadcrumb-item active"><a>@lang('AttributeGroup::translation.edit')</a></li>
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
                                    @lang('AttributeGroup::translation.edit') "{{ $attributeGroup->name }}"
                                </div>
                                <div class="col-md-6">
                                    <div class="font-size-12 text-left"> تاریخ اخرین بروزرسانی
                                        : {{ getJalaliDate($attributeGroup->updated_at) }}</div>
                                </div>
                            </div>
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
                                                <x-validation-error field="name"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label">دسته بندی</label>
                                        <div class="col-sm-9">
                                            <select name="category_ids[]" class="select2-multiple form-control" id="select-category-id" multiple aria-hidden="true">
                                                @foreach($categories as  $category)
                                                    <option
                                                        value="{{ $category->id  }}"
                                                       @selected($attributeGroup->categories->contains($category->id))
                                                    >  {{ $category->name }} </option>
                                                @endforeach
                                            </select>
                                            <x-validation-error field="category_ids" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-9 offset-md-3">
                                            <button type="submit" class="btn btn-primary btn-uppercase">
                                                <i class="ti-check-box m-l-5"></i>بروزرسانی
                                            </button>
                                            <a href="{{ route('panel.attributeGroups.index') }}"
                                               class="btn btn-secondary waves-effect">
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
@section('css')
    <link rel="stylesheet" href="/assets/panel/vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('script')
    <script src="/assets/panel/vendors/select2/js/select2.min.js"></script>
    <script>
        $('#select-category-id').select2({
            placeholder: "دسته بندی را انتخاب کنید",
            // allowClear: true
        });
    </script>
@endsection
