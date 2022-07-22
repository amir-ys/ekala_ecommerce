@extends('Dashboard::master')
@section('title'  ,__('Setting::translation.faqs.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a
            href="{{ route('panel.settings.index') }}">@lang('Setting::translation.index')</a></li>
    <li class="breadcrumb-item active"><a>@lang('Setting::translation.faqs.index')</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-2">
            <a href="{{ route('panel.settings.faqs.create') }}"
               class="btn btn-primary btn-rounded waves-effect waves-light mb-3 me-2">
                <i class="mdi mdi-plus me-1"></i>
                @lang('Setting::translation.faqs.create')</a>
        </div>
        <div class="col-md-12">
            <div class="card border border-secondary">
                <div class="card-body">
                    <h5 class="card-title"> @lang('Setting::translation.faqs.index')  </h5>
                    <div class="accordion" id="accordionExample">
                        @if($faqs->count() > 0 )
                            @foreach($faqs as $faq)
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="col-md-10">
                                            <button class="btn btn-link primary-font" type="button"
                                                    data-toggle="collapse"
                                                    data-target="#collapseOne_{{ $faq->id }}" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                {{ $faq->question }}
                                            </button>
                                        </div>
                                        <div class="col-md-2">

                                            <span class="badge bg-{{ $faq->is_published ? 'success' : 'warning' }}">
                                                {{ $faq->is_published ? 'نمابش' : 'عدم نمابش' }}
                                            </span>

                                            <a class="btn btn-sm bg-transparent d-inline"
                                               href="{{ route('panel.settings.faqs.edit' , $faq) }}"><i
                                                    class="fa fa-pencil fa-5m text-success"></i></a>

                                            <a href="{{ route('panel.settings.faqs.destroy' , $faq->id) }}"
                                               onclick="deleteFaq(event , '{{ $faq->id }}')"
                                               class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                                                    class="fa fa-trash fa-15m text-danger"></i></a>
                                            <form action="{{ route('panel.settings.faqs.destroy' , $faq->id) }}"
                                                  method="post"
                                                  id="delete_faq_form_{{ $faq->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                    <div id="collapseOne_{{ $faq->id }}" class="collapse show"
                                         aria-labelledby="headingOne"
                                         style="">
                                        <div class="card-body">
                                            <p class="mb-0">
                                                {{ $faq->answer }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>
                                اطلاعاتی برای نمایش وجود ندارد.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        function deleteFaq(event, id) {
            event.preventDefault()
            swal({
                title: "آیا اطمینان دارید؟",
                text: "پس از حذف قادر به بازیابی نخواهید بود!",
                icon: "warning",
                buttons: {
                    confirm: 'بله',
                    cancel: 'خیر'
                },
                dangerMode: true
            }).then(function (willDelete) {
                if(willDelete){
                    document.getElementById('delete_faq_form_' + id).submit()
                }
            })
        }
    </script>
@endsection
