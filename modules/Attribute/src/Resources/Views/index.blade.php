@extends('Dashboard::master')
@section('title'  ,__('Attribute::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Attribute::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.attributes.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Attribute::translation.create')
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table  id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>گروه ویژگی</th>
                                <th> تاریخ ایجاد</th>
                                <th>قابل فیلتر است ؟</th>
                                <th> عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $attribute->attributeGroup ? $attribute->attributeGroup->name : 'ندارد' }}</td>
                                    <td>{{ getJalaliDate($attribute->created_at) }}</td>
                                    <td>
                                          <span
                                              class="badge py-1 badge-{{ $attribute->is_filterable == \Modules\Attribute\Models\Attribute::FILTERABLE_TRUE
                                                      ? 'success'  : 'danger'   }}">
                                              {{ $attribute->is_filterable == \Modules\Attribute\Models\Attribute::FILTERABLE_TRUE
                                                      ? 'بله'  : 'خیر'   }}
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.attributes.edit' , $attribute->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.attributes.destroy' , $attribute->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.attributes.destroy' , $attribute->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.attributes.destroy' , $attribute->id) }}" method="post"
                                              id="destroy-brand-{{ $attribute->id }}">
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
    <!-- /basic responsive table -->
@endsection
