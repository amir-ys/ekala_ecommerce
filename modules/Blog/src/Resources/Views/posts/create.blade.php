@extends('Dashboard::master')
@section('title' , __('Blog::translation.category.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.blog.categories.index') }}"> @lang('Blog::translation.category.index') </a></li>
    <li class="breadcrumb-item active"><a> @lang('Blog::translation.category.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            @lang('Blog::translation.category.create')
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.blog.categories.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="name" class="col-form-label">نام</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="نام"
                                               value="{{ old('name') }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="image" class="col-form-label">عکس</label>
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="image" name="image"
                                               placeholder="عکس"
                                               value="{{ old('image') }}">
                                        <x-validation-error field="image"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label"> وضعیت </label>
                                    <div class="form-group">
                                        <select class="form-control" name="status" aria-hidden="true">
                                            <option value>یک وضعیت را انتخاب کنید</option>
                                            @foreach(\Modules\Blog\Models\Category::$statuses as $name =>  $status)
                                                <option value="{{ $status }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <label for="tags" class="col-form-label">تگ ها</label>
                                    <div class="form-group">
                                        <select class="form-control" id="tags" name="tags[]" multiple="multiple">
                                        </select>
                                    </div>
                                    <x-validation-error field="tags"/>
                                </div>

                                <div class="col-md-9 mb-3">
                                    <label for="description" class="col-form-label">توضیحات</label>
                                    <div class="form-group">
                                        <textarea name="description" class="form-control" id="description"></textarea>
                                        <x-validation-error field="description"/>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-uppercase">
                                        <i class="ti-check-box m-l-5"></i>ذخیره
                                    </button>
                                    <a href="{{ route('panel.blog.categories.index') }}"
                                       class="btn btn-secondary waves-effect">
                                        بازگشت
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->
    @section('css')
        <link rel="stylesheet" href="/assets/panel/vendor/select2/select2.min.css" type="text/css">
    @endsection
@endsection
@section('script')
    <script src="/assets/panel/vendor/select2/select2.min.js"></script>
    <script src="/assets/panel/vendors/ckeditor/ckeditor.js"></script>
    <script>

        $('#tags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

    </script>
@endsection
