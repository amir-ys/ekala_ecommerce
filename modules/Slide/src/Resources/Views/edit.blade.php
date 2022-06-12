@extends('Dashboard::master')
@section('title' , __('Slide::translation.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.slides.index') }}">@lang('Slide::translation.index') </a></li>
    <li class="breadcrumb-item active"><a> @lang('Slide::translation.edit')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card overflow-hidden">
                <div class="card-header border border-5">
                    <div class="alert alert-primary" role="alert">
                        <div class="row">
                            <div class="col-md-6">
                                @lang('Slide::translation.edit') "{{ $slide->title }}"
                            </div>
                            <div class="col-md-6">
                                <div class="font-size-12 text-left">  تاریخ اخرین بروزرسانی : {{ getJalaliDate($slide->updated_at) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-5">
                    <form method="POST" action="{{ route('panel.slides.update' , $slide->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label for="title" class="col-sm-4 col-form-label">موضوع</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="موضوع"
                                                   value="{{ old('title' , $slide->title) }}">
                                            <x-validation-error field="title"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label for="priority" class="col-sm-4 col-form-label">اولویت</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="priority" name="priority"
                                                   placeholder="اولویت"
                                                   value="{{ old('priority' , $slide->priority) }}">
                                            <x-validation-error field="priority"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label"> وضعیت</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="status"
                                                    aria-hidden="true">
                                                <option value>یک وضعیت را انتخاب کنید</option>
                                                @foreach(\Modules\Slide\Enums\SlideStatus::cases() as $status)
                                                    <option
                                                        value="{{ $status->value  }}"
                                                        @selected($slide->status->value == $status->value)
                                                    > @lang($status->name ) </option>
                                                @endforeach
                                            </select>
                                            <x-validation-error field="status"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label">  نوع </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="type"
                                                    aria-hidden="true">
                                                <option value>یک نوع را انتخاب کنید</option>
                                                @foreach(\Modules\Slide\Enums\SlideType::cases() as $type)
                                                    <option
                                                        value="{{ $type->value  }}"
                                                    @selected($slide->type->value == $type->value)
                                                    >  @lang($type->name ) </option>
                                                @endforeach
                                            </select>
                                            <x-validation-error field="type"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label for="link" class="col-sm-4 col-form-label"> لینک </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="link" name="link"
                                                   placeholder="لینک"
                                                   value="{{ old('link' , $slide->link) }}">
                                            <x-validation-error field="link"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label for="btn_text" class="col-sm-4 col-form-label">  نام دکمه</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="btn_text" name="btn_text"
                                                   placeholder="نام دکمه"
                                                   value="{{ old('btn_text' , $slide->btn_text) }}">
                                            <x-validation-error field="btn_text"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="row">
                                        <label for="photo" class="col-sm-4 col-form-label">تصویر</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="photo" name="photo"
                                                   placeholder="تصویر"
                                                   value="{{ old('photo') }}">
                                            <x-validation-error field="photo"/>
                                            <div class="mt-3">
                                                <span> عکس کنونی: </span>
                                                <a href="{{ route('panel.slides.image' , $slide->photo) }}">
                                                    <img width="50%" src="{{ route('panel.slides.image' , [$slide->photo]) }}" alt="">
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>





                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary btn-uppercase">
                                                <i class="ti-check-box m-l-5"></i>ذخیره
                                            </button>
                                            <a href="{{ route('panel.slides.index') }}" class="btn btn-secondary waves-effect">
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
