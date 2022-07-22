@extends('Dashboard::master')
@section('title'  ,__('Setting::translation.faqs.edit'))
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('panel.settings.index') }}">@lang('Setting::translation.index')</a></li>
    <li class="breadcrumb-item "><a  href="{{ route('panel.settings.faqs.index') }}">@lang('Setting::translation.faqs.index')</a></li>
    <li class="breadcrumb-item active"><a>@lang('Setting::translation.faqs.edit')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> @lang('Setting::translation.faqs.edit')  </h5>
                    <div class="row justify-content-around">
                        <div class="col-md-6">
                            <div class="card border border-5">
                                <div class="card-header"> فرم @lang('Setting::translation.faqs.edit')</div>
                                <div class="card-body">
                                    <form action="{{ route('panel.settings.faqs.update' , $faq->id) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="question"> سوال </label>
                                                    <input type="text" name="question" id="question"
                                                           value="{{ old('question' , $faq->question) }}" class="form-control @error('question') is-invalid @enderror">
                                                <x-validation-error field="question"/>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="answer"> جواب </label>
                                                    <textarea type="text" id="answer" name="answer"
                                                              class="form-control @error('answer') is-invalid @enderror">{{ old('answer' , $faq->answer) }}</textarea>
                                                <x-validation-error field="answer"/>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="is_published"> وضعیت نمایش </label>
                                                    </div>
                                                    <div class="col-md-9 mt-md-2">
                                                        <input type="checkbox" name="is_published" id="is_published"
                                                               value="{{ \Modules\Setting\Models\Faq::STATUS_PUBLISHED }}"
                                                               @checked($faq->is_published)
                                                               class="form-check">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-12 mt-2">
                                                <button type="submit" class="btn btn-primary btn-uppercase">
                                                    <i class="ti-check-box"></i>ذخیره
                                                </button>
                                                <a href="{{ route('panel.settings.faqs.index') }}"
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
            </div>
        </div>
    </div>
@endsection
