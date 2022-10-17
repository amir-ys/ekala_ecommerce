@extends('Front::master')
@section('content')
    <section class="inner-page" id="contact-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>مقایسه محصول</h1>
                                <p>محصولات را با هم مقایسه کنید.</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">مقایسه محصول</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-none d-lg-block" id="compare-table">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-12">
                                <div id="products-compared">
                                    <div class="row mt-2 bg-white">
                                        @foreach($products as $product)
                                            <div class="col-3 px-2 pb-2 products-compare-item">
                                                <div class="bg-light p-2 text-center">
                                                    <div
                                                        class="btn btn-sm btn-outline-secondary btn-cancel-compare float-left rounded-circle">
                                                        X
                                                    </div>
                                                    <div><img
                                                            src="{{ route('image.display' , [$product->id , $product->primaryImage->images['small']]) }}"
                                                            alt=""></div>
                                                    <div class="title">{{ $product->name }}</div>
                                                    <div class="price-container">
                                                        <span class="price">{{ $product->formattedPrice()  }} <span>تومان</span></span>
                                                    </div>
                                                    <div class="cta-container">
                                                        <a href="product.html">
                                                            <div class="btn btn-sm btn-primary px-3 px-lg-2 px-xl-4">
                                                                مشاهده و خرید محصول
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="compare-table-details">
                            <div class="col-12 px-lg-0">
                                <!-- Detail Group -->
                                <div class="row">
                                    <div class="col-12 my-2 ">
                                        <div class="bg-light-yellow px-2 py-1 rounded">
                                            <span class="detail-title "><i
                                                    class="fa fa-chevron-left small"></i> برند</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    @foreach($products as $product)
                                        <div class="col-12 col-md-3 px-2">
                                            <div class="bg-light p-2"> {{ $product->brand->name }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- /Detail Group -->

                                <!-- Detail Group -->
                                <div class="row">
                                    <div class="col-12 my-2">
                                        <div class="bg-light-yellow px-2 py-1 rounded">
                                            <span class="detail-title"><i class="fa fa-chevron-left small"></i> دسته بندی</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <!--<div class="col-12 mb-1 px-2 font-weight-light"><div class="sub-detail-title p-2">عنوان ویژگی</div></div>-->
                                    @foreach($products as $product)
                                        <div class="col-12 col-md-3 px-2">
                                            <div class="bg-light p-2"> {{ $product->category->name }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- /Detail Group -->

                                <!-- Detail Group -->
                                <div class="row">
                                    <div class="col-12 my-2">
                                        <div class="bg-light-yellow px-2 py-1 rounded">
                                            <span class="detail-title"><i class="fa fa-chevron-left small"></i>  ویژگی های محصول </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <!--<div class="col-12 mb-1 px-2 font-weight-light"><div class="sub-detail-title p-2">عنوان ویژگی</div></div>-->
                                    @foreach($products as $product)
                                        <div id="details-tab" class="tabs-container px-0 px-md-3 pb-0 pb-md-3">
                                            @foreach($product->category->attributeGroups as $attributeGroup)
                                                <!-- Detail Section -->
                                                <div class="row">
                                                    <div class="col-12 my-2"><span class="detail-title"><i
                                                                class="fa fa-chevron-left small"></i> {{ $attributeGroup->name }} </span>
                                                    </div>
                                                </div>
                                                @foreach($attributeGroup->attributes as $attribute)
                                                    <div class="row mb-2">
                                                        <div class="col-12 col-md-3 font-weight-bold">
                                                            <div
                                                                class="bg-light p-2">{{ $attribute->name }}</div>
                                                        </div>
                                                        <div class="col-12 col-md-9 pr-md-0">
                                                            <div
                                                                class="bg-light p-2">  {{ $attribute->getValueForProduct($product) }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- /Detail Section -->
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /Detail Group -->

                        <!-- Detail Group -->
                        <div class="row">
                            <div class="col-12 my-2">
                                <div class="bg-light-yellow px-2 py-1 rounded">
                                    <span class="detail-title"><i class="fa fa-chevron-left small"></i> دوربین‌های پشت گوشی</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <!--<div class="col-12 mb-1 px-2 font-weight-light"><div class="sub-detail-title p-2">عنوان ویژگی</div></div>-->
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">3 ماژول دوربین</div>
                            </div>
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">2 ماژول دوربین</div>
                            </div>
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">5 ماژول دوربین</div>
                            </div>
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">4 ماژول دوربین</div>
                            </div>
                        </div>
                        <!-- /Detail Group -->

                        <!-- Detail Group -->
                        <div class="row">
                            <div class="col-12 my-2">
                                <div class="bg-light-yellow px-2 py-1 rounded">
                                    <span class="detail-title"><i
                                            class="fa fa-chevron-left small"></i> تعداد سیم کارت</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <!--<div class="col-12 mb-1 px-2 font-weight-light"><div class="sub-detail-title p-2">عنوان ویژگی</div></div>-->
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">2 عدد</div>
                            </div>
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">1 عدد</div>
                            </div>
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">1 عدد</div>
                            </div>
                            <div class="col-12 col-md-3 px-2">
                                <div class="bg-light p-2">2 عدد</div>
                            </div>
                        </div>
                        <!-- /Detail Group -->
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

        <section id="mobile-forbidden" class="d-lg-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="container px-lg-0">
                            <div class="row mb-0 mb-sm-5">
                                <div class="col-12 px-0">
                                    <div class="row">
                                        <div class="col-12 p-5 text-center">
                                            <span>این صفحه در موبایل قابل مشاهده نمی باشد.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
