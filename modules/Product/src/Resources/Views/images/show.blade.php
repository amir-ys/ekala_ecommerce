@extends('Dashboard::master')
@section('title'  ,__('Product::translation.index'))
@section('breadcrumb')
    <li class="breadcrumb-item active"><a>@lang('Product::translation.index')</a></li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border border-5 border-primary">
                        <div class="card-header">
                            <h5> تصویر اصلی</h5>
                        </div>
                        @if($product->primaryImage)
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('panel.products.images.display'  ,[ $product->id ,  $product->primaryImage->images['large'] ])  }}">
                                        <img
                                            src="{{ route('panel.products.images.display'  , [ $product->id ,  $product->primaryImage->images['small'] ])  }}"
                                            width="100%"
                                            alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <p> هیچ تصاویر اصلی انتخاب نشده است.
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border border-5 border-primary">
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="{{ route('panel.products.images.upload' , $product->id) }}"
                                      method="post" enctype="multipart/form-data" id="upload-primary">
                                    @csrf
                                    <input type="hidden" name="is_primary" value="1">
                                    <label for=""> آپلود عکس جدید </label>
                                    <input class="form-control" type="file" name="primary_image">
                                    <button class="btn btn-primary btn-sm mt-2" form="upload-primary"> آپلود</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    دیگر تصاویر محصول
                </div>
                <div class="col-md-2">
                    <form method="post"
                          action="{{ route('panel.products.images.deleteAll' , [ 'product' => $product->id ]) }}"
                          id="delete-all-image">
                        @csrf
                        @method('delete')
                        <button type="submit" form="delete-all-image"
                                class="btn btn-danger"> حذف تمام تصاوبر
                        </button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                @if(!is_null($product->images()->first()))
                    @foreach($product->images()->get() as $image)
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card border border-5 border-primary">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="{{ route('panel.products.images.display', [$product->id ,$image->images['large'] ] )  }}">
                                                        <img
                                                            src="{{ route('panel.products.images.display', [ $product->id ,$image->images['small'] ] )  }}"
                                                            width="100%"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <form method="post"
                                                          action="{{ route('panel.products.images.delete' , [ 'product' => $product->id , 'image' => $image->id ]) }}"
                                                          id="delete-image-{{ $image->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" form="delete-image-{{ $image->id }}"
                                                                class="btn btn-danger mt-md-2"> حذف
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-2">
                        <div class="card border border-5 border-primary">
                            <div class="card-body">
                                هیچ تصاویر دیگری انتخاب نشده است.
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-3">
                    <div class="card border border-5 border-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <form
                                            action="{{ route('panel.products.images.upload' , $product->id ) }}"
                                            method="post" enctype="multipart/form-data" id="upload-image">
                                            @csrf
                                            <input type="hidden" name="is_primary" value="0">
                                            <label for=""> آپلود عکس جدید </label>
                                            <input class="form-control" type="file" multiple name="images[]">
                                            <button class="btn btn-primary btn-sm mt-2" form="upload-image">
                                                آپلود
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
