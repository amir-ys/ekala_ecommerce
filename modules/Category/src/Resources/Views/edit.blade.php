@extends('Dashboard::master')
@section('title' ,__('Category::translation.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.categories.index') }}"> @lang('Category::translation.index') </a></li>
    <li class="breadcrumb-item active"><a > @lang('Category::translation.edit') {{ $category->name }}</a></li>
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
                                    @lang('Category::translation.edit') "{{ $category->name }}"
                                </div>
                                <div class="col-md-6">
                                    <div class="font-size-12 text-left">  تاریخ اخرین بروزرسانی : {{ getJalaliDate($category->updated_at) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.categories.update' , $category->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-3 col-form-label">نام</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="نام"
                                                       value="{{ old('name' , $category->name) }}">
                                                <x-validation-error field="name" />
                                            </div>
                                        </div>
                                    </div>
{{--                                    @dd($parentCategories->pluck('id')->toArray())--}}

                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">دسته پدر</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="parent_id" aria-hidden="true">
                                                    <option value>دسته پدر را انتخاب کنید</option>
                                                    @foreach($parentCategories as  $parentCategory)
                                                        <option
                                                            value="{{ $parentCategory->id }}"
                                                            @selected($parentCategory->id == $category->parent_id)
                                                        >  {{ $parentCategory->name }} </option>
                                                    @endforeach
                                                </select>
                                                <x-validation-error field="parent_id" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">وضعیت</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="is_active" aria-hidden="true">
                                                    <option value>یک وضعیت را انتخاب کنید</option>
                                                    @foreach(\Modules\Category\Enums\CategoryStatus::cases() as  $status)
                                                        <option
                                                            value="{{ $status->value }}"
                                                            @selected($status->value == $category->is_active->value)
                                                        >
                                                            @lang($status->name) </option>
                                                    @endforeach
                                                </select>
                                                <x-validation-error field="is_active" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">قابل فیلتر باشد؟</label>
                                            <div class="col-sm-9 mt-md-3">
                                                <input type="checkbox" class="form-check" name="is_searchable"
                                                       value="{{ \Modules\Category\Models\Category::SEARCHABLE_TRUE }}"
                                                @checked($category->is_searchable)
                                                >
                                                <x-validation-error field="is_searchable" />
                                            </div>
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
                                        <a href="{{ route('panel.categories.index') }}"
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
    </div>
    <!-- end row -->
@endsection
