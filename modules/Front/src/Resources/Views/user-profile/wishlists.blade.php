@extends('Front::master')
@section('content')
    <section class="inner-page" id="profile-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>ناحیه کاربری</h1>
                                <p>به ناحیه کاربری روبیک مارکت خوش آمدید.</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">محصولات مورد علاقه</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <!-- Side Panel -->
                                @include('Front::partials.user-profile-sidebar')
                                <!-- /Side Panel -->
                            </div>
                            <div class="col-12 col-lg-9 pl-lg-0 pr-lg-2 mt-2 mt-lg-0">
                                <!-- Favorite Products -->
                                <div class="custom-container" id="favorites">
                                    <div class="row pt-2 px-3">
                                        <div class="col-12"><h1>محصولات مورد علاقه</h1></div>
                                    </div>
                                    <hr>
                                    <div class="container">
                                        @if(count($wishlist = auth()->user()->wishlist) > 0)

                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-md-4">
                                                <!-- Products -->
                                                {{--                                            <div class="col">--}}
                                                <!-- Product Box -->
                                                @foreach($wishlist as $wishlist )
                                                    @include('Front::partials.product-box' , ['product' => $wishlist->product , 'discount' => false ])
                                                @endforeach
                                            </div>

                                        @else
                                            <div class="card mt-md-3 mb-md-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <h5 class="text-center mt-md-5 mb-md-4">
                                                            شما هنوز به محصولی علاقه مند نشدید.
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <!-- /Product Box -->
                                        {{--                                            </div>--}}
                                    </div>
                                </div>
                                <!-- /Favorite Products -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
