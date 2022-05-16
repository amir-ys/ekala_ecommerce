
@extends('Dashboard::master')
@section('title' , 'ایجاد ویژگی')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('panel.attributes.index') }}"> ویژگی ها </a></li>
    <li class="breadcrumb-item active"><a> {{ $attribute->name }} ذخیره مقادیر ویژگی</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-9">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        مقادیر
                    </div>
                    <div class="card-body border border-5">
                        <form method="POST" action="{{ route('panel.attributes.value.save' , $attribute->id) }}">
                            @csrf
                            <div id="attribute-value-div">

                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="button" class="btn btn-light" id="add-value-input">
                                    <i class="ti-check-box m-l-5"></i> افزودن مقدار جدید
                                </button>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-uppercase">
                                    <i class="ti-check-box m-l-5"></i> ذخیره
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script>
       $(document).ready(function () {
         $('#add-value-input').click(function() {
            var token = ( Math.random() * 100 ) + 1 ;
             $('#attribute-value-div').append(
                 '<div class="form-group" id=' + token + '>' +
                      '<div class="row">' +
                          '<div class="col-md-11 mb-3">' +
                             '<div class="row">' +
                                 '<div class="col-sm-12">' +
                                      '<input type="text" class="form-control" id="attribute-value-input" name="attributeValue[]" required placeholder="مقدار" >' +
                                  '</div>' +
                              '</div>' +
                          '</div>' +
                          '<div class="col-md-1">' +
                              '<a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('+token+').remove()">' +
                                 '<i class="fa fa-trash"> </i>' +
                              '</a>' +
                          '</div>' +
                      '</div>' +
                  '</div>'
             )
         })



       })

    </script>
@endsection
