@extends('Dashboard::master')
@section('title'  ,__('AttributeGroup::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('AttributeGroup::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body border border-5">
                    <div class="row mb-3">
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>دسته بندی</th>
                                <th> تاریخ ایجاد</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attributeGroups as $attributeGroup)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $attributeGroup->name }}</td>
                                    <td>{{ $attributeGroup->category->name }}</td>
                                    <td>{{ getJalaliDate($attributeGroup->created_at) }}</td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.attributeGroups.edit' , $attributeGroup) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.attributeGroups.destroy' , $attributeGroup->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.attributeGroups.destroy' , $attributeGroup->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.attributeGroups.destroy' , $attributeGroup->id) }}" method="post"
                                              id="destroy-brand-{{ $attributeGroup->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('AttributeGroup::create')
    </div>
    <!-- /basic responsive table -->
@endsection
