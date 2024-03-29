@extends('Dashboard::master')
@section('title'  ,__('Category::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Category::translation.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_CATEGORIES)
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.categories.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2">
                        <i class="mdi mdi-plus me-1"></i>
                        @lang('Category::translation.create')</a>
                </div>
            </div>
            @endcan
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>دسته پدر</th>
                                <th> تاریخ ایجاد</th>
                                <th>قابل فیلتر است ؟</th>
                                <th>وضعیت</th>
                                @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_CATEGORIES)
                                <th> عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent_id ? $category->parent->name : 'ندارد' }}</td>
                                    <td>{{ getJalaliDate($category->created_at) }}</td>
                                    <td>
                                          <span
                                              class="badge py-1 badge-{{ $category->is_searchable == \Modules\Category\Models\Category::SEARCHABLE_TRUE
                                                      ? 'success'  : 'danger'   }}">
                                              {{ $category->is_searchable == \Modules\Category\Models\Category::SEARCHABLE_TRUE
                                                      ? 'بله'  : 'خیر'   }}
                                        </span>
                                        </td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $category->statusCssClass }}"> @lang($category->is_active->name)
                                        </span>
                                    </td>

                                    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_CATEGORIES)
                                    <td>
                                        <a class="btn btn-sm bg-transparent d-inline"
                                           href="{{ route('panel.categories.edit' , $category->id) }}"><i
                                                class="fa fa-pencil fa-15m text-success"></i></a>

                                        <a href="{{ route('panel.categories.destroy' , $category->id) }}"
                                           onclick="deleteItem(event ,  '{{ route('panel.categories.destroy' , $category->id) }}')"
                                           class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                class="fa fa-trash fa-15m text-danger"></i></a>

                                        <form action="{{ route('panel.categories.destroy' , $category->id) }}" method="post"
                                              id="destroy-brand-{{ $category->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
