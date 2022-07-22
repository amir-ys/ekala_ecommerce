@extends('Dashboard::master')
@section('title'  ,__('Setting::translation.about.show'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Setting::translation.about.show')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card border border border-5">
                <div class="card-header bg-transparent border border-5">
                    <h5 class="my-0 text-primary"><i class="mdi mdi-application-settings me-3"></i> درباره ما </h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('panel.settings.about.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-md-2">

                            <div class="col-md-6">
                                <label for="title"> عنوان </label>
                                <input type="text" name="title" id="title"
                                       value="{{ $about ? $about->json['title'] : null  }}" class="form-control">
                                <x-validation-error field="title"/>
                            </div>

                            <div class="col-md-6">
                                <label for="photo"> تصویر </label>
                                <input type="file" name="photo" id="photo" class="form-control">
                                <x-validation-error field="photo"/>
                            </div>


                            <div class="col-md-12 mt-md-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="description">توضیحات</label>
                                        <textarea name="description" id="description" class="form-control" cols="10"
                                                  rows="10">
                                           {{ ($about ? $about->json['description'] :null )  }}
                                       </textarea>
                                        <x-validation-error field="description"/>
                                    </div>
                                </div>
                            </div>

                            @if(($about && $about->json['photo'] ) )
                                <div class="col-md-6 mt-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for=""> تصویر فعلی : </label>
                                            <div class="col-md-12">
                                                <img width="100%" style="height:100%"
                                                     src="{{ $about->imagePath($about->json['photo']) }}"
                                                     class="img-fluid" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex flex-wrap mt-md-2 ">
                            <button type="submit" class="btn btn-primary waves-effect waves-light ml-md-2">ذخیره</button>
                            <a href="{{ route('panel.settings.index') }}"  class="btn btn-secondary waves-effect waves-light">بازگشت</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



