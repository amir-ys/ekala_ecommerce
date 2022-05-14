@extends('Dashboard::master')
@section('title' , 'ایجاد ویژگی')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.attributes.index') }}"> ویژگی ها </a></li>
    <li class="breadcrumb-item active"><a> ایجاد ویژگی</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="col-xl-12">
                <div class="card overflow-hidden">
                    <div class="card-header border border-5">
                        <div class="alert alert-primary" role="alert">
                            ایجاد ویژگی جدید
                        </div>
                    </div>
                    <div class="card-body border border-5">
                        <form method="POST" action="{{ route('panel.attributes.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label for="name" class="col-sm-4 col-form-label">نام</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="نام"
                                                       value="{{ old('name') }}">
                                                <x-validation-error field="name"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mb-3">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">گروه ویژگی</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="attribute_group_id"
                                                        aria-hidden="true">
                                                    <option value>یک گروه ویژگی را انتخاب کنید</option>
                                                    @foreach($attributeGroups as  $attributeGroup)
                                                        <option
                                                            value="{{ $attributeGroup->id }}">  {{ $attributeGroup->name }} </option>
                                                    @endforeach
                                                </select>
                                                <x-validation-error field="attribute_group_id"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">قابل فیلتر باشد؟</label>
                                            <div class="col-sm-8 mt-md-3">
                                                <input type="checkbox" class="form-check" name="is_filterable"
                                                       value="{{ \Modules\Attribute\Models\Attribute::FILTERABLE_TRUE }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-9 offset-3">
                                <button type="submit" class="btn btn-primary btn-uppercase">
                                    <i class="ti-check-box m-l-5"></i> ذخیره
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
