@extends('Dashboard::master')
@section('title' , __('Blog::translation.post.create'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('panel.blog.posts.index') }}"> @lang('Blog::translation.post.index') </a></li>
    <li class="breadcrumb-item active"><a> @lang('Blog::translation.post.create')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-12">
                <div class="card overflow-hidden border border-5">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            @lang('Blog::translation.post.create')
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.blog.posts.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="title" class="col-form-label">موضوع</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="موضوع"
                                               value="{{ old('title') }}">
                                        <x-validation-error field="title"/>
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
                                            @foreach(\Modules\Blog\Models\Post::$statuses as $name =>  $status)
                                                <option value="{{ $status }}"
                                                        @selected($status == old('status'))
                                                >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="status"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label"> قابلیت درج کامنت </label>
                                    <div class="form-group">
                                        <select class="form-control" name="is_commentable" aria-hidden="true">
                                            @foreach(\Modules\Blog\Models\Post::$commentable as $name =>  $isCommentable)
                                                <option value="{{ $isCommentable }}"
                                                {{ $isCommentable == \Modules\Blog\Models\Post::IS_COMMENTABLE ? 'selected' : '' }}
                                                >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="is_commentable"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label"> دسته بندی </label>
                                    <div class="form-group">
                                        <select class="form-control" name="category_id" aria-hidden="true">
                                            <option value>یک دسته بندی را انتخاب کنید</option>
                                        @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @selected($category->id == old('category_id'))
                                                >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-validation-error field="category_id"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <input  name="published_at" type="hidden" id="published_at">
                                    <label for="published_at_field" class="col-form-label">زمان انتشار</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="published_at_field" name="published_at"
                                               placeholder="زمان انتشار"
                                               value="{{ old('published_at') }}">
                                        <x-validation-error field="published_at"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="tags" class="col-form-label">تگ ها</label>
                                    <div class="form-group">
                                        <select class="form-control" id="tags" name="tags[]" multiple="multiple">
                                        </select>
                                    </div>
                                    <x-validation-error field="tags"/>
                                </div>



                                <div class="col-md-12 mb-3">
                                    <label for="summary" class="col-form-label">متن خلاصه </label>
                                    <div class="form-group">
                                        <textarea name="summary" class="form-control" id="summary">{{ old('summary') }}</textarea>
                                        <x-validation-error field="summary"/>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="body" class="col-form-label">متن اصلی </label>
                                    <div class="form-group">
                                        <textarea name="body" class="form-control" id="body">{{ old('body') }}</textarea>
                                        <x-validation-error field="body"/>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-uppercase">
                                        <i class="ti-check-box m-l-5"></i>ذخیره
                                    </button>
                                    <a href="{{ route('panel.blog.posts.index') }}"
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
        <link rel="stylesheet" href="/assets/panel/vendor/persian-datepicker/persian-datepicker.min.css" type="text/css">
    @endsection
@endsection
@section('script')
    <script src="/assets/panel/vendor/select2/select2.min.js"></script>
    <script src="/assets/panel/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/panel/vendor/persian-datepicker/persian-date.min.js"></script>
    <script src="/assets/panel/vendor/persian-datepicker/persian-datepicker.min.js"></script>
    <script>

        $('#tags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

        ClassicEditor
            .create(document.querySelector('#summary'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });


        $('#published_at_field').persianDatepicker({
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
@endsection
