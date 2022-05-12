@extends('Dashboard::master')
@section('title'  ,'دسته بندی ها')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>دسته بندی ها</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12 col-lg-2">
                    <a href="{{ route('panel.categories.create') }}"
                       class="btn btn-primary
                        btn-rounded waves-effect waves-light mb-2 me-2 w-100">
                        <i class="mdi mdi-plus me-1"></i>
                        ساخت دسته بندی جدید</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body border border-5">
                    <div class="table-responsive">
                        <table id="tbl_users" class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>دسته پدر</th>
                                <th> تاریخ ایجاد</th>
                                <th>قابل فیلتر است ؟</th>
                                <th>وضعیت</th>
                                <th> عملیات</th>
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
                                              class="badge py-1 bg-light">
                                              {{ $category->is_searchable == \Modules\Category\Models\Category::SEARCHABLE_TRUE
                                                      ? 'بله'  : 'خیر'   }}
                                        </span>
                                        </td>
                                    <td>
                                        <span
                                            class="badge py-1 bg-{{ $category->statusCssClass }}"> @lang($category->is_active->name)
                                        </span>
                                    </td>

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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $categories->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic responsive table -->
@endsection
