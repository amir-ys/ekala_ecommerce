@extends('Front::master')
@section('content')
    <section class="inner-page" id="products-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>فروشگاه {{ site_name()}}</h1>
                                <p>هر آنچه نیاز دارید در این فروشگاه موجود است</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">محصولات</li>
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
                            <div class="col-12 col-lg-3 px-3 px-lg-0">
                                <!-- Side Panel -->
                                <div class="accordion filters-container">
                                    @if(isset($categories) && count($categories) > 0)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button py-2 px-3" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                    گروه های محصولات
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                 aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach($categories as $category)
                                                        <div class="form-group">
                                                            <input type="checkbox"
                                                                   onclick="findProduct('{{ $category->id }}')"
                                                                   id="checkbox-{{ $category->id }}"
                                                                {{ request()->category == $category->id ? 'checked' : '' }}
                                                            >
                                                            <label for="category5"> {{ $category->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="accordion filters-container mt-3">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button py-2 px-3" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="true" aria-controls="collapseTwo">
                                                محدوده قیمت
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse show"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-12 py-1 px-4 mt-3">
                                                        <div id="steps-slider" dir="rtl"></div>
                                                    </div>
                                                        <div class="col-6 text-center price-range mt-3">
                                                            <div>از</div>
                                                            <div id="price-range-from">10000</div>
                                                            <div>تومان</div>
                                                        </div>
                                                        <div class="col-6 text-center price-range mt-3">
                                                            <div>از</div>
                                                            <div id="price-range-to">500000</div>
                                                            <div>تومان</div>
                                                        </div>
                                                        <div class="col-12 text-center py-2">
                                                            <button onclick="priceRange()" id="price_range" class="btn btn-warning">اعمال محدوده قیمت</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion filters-container mt-3">
                                    <div class="accordion-item">
                                        <div id="collapseThree" class="accordion-collapse show"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body pb-2">
                                                <div class="form-group">
                                                    <input type="checkbox" onclick="availableProducts()"
                                                           {{ request()->input('only-available') == true ? 'checked' : '' }} id="only-available">
                                                    <label for="only-available">فقط کالاهای موجود</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion filters-container mt-3">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button py-2 px-3" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                    aria-expanded="true" aria-controls="collapseFive">
                                                جدیدترین محصولات
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse show"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <!-- Side Product -->
                                                    @foreach($products as $product)
                                                        @include('Front::partials.product-box-sidebar' , ['product' => $product])
                                                    @endforeach
                                                    <!-- Side Product -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Side Panel -->
                            </div>
                            <div class="col-12 col-lg-9 px-0 pl-lg-0 pr-lg-2 mt-2 mt-lg-0">
                                <!-- Filters -->
                                <div id="order-filters">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 col-sm-10 my-1">
                                                <span class="d-block d-sm-inline-block">مرتب سازی بر اساس:</span>

                                                <a href="{{ request()->url()}}?order=newest">
                                                    <span class="order-filter d-block d-sm-inline-block
                                                    {{ request()->input('order') == 'newest' ? 'active' : '' }}">جدیدترین</span>

                                                </a>

                                                <a href="{{ request()->url()}}?order=most-visited">
                                                    <span class="order-filter d-block d-sm-inline-block
                                                    {{ request()->input('order') == 'most-visited' ? 'active' : '' }}
                                                    ">پربازدیدترین</span>

                                                </a>

                                                <a href="{{ request()->url()}}?order=best-selling">
                                                    <span class="order-filter d-block d-sm-inline-block
                                                    {{ request()->input('order') == 'best-selling' ? 'active' : '' }}
                                                    ">پرفروش‌ترین</span>
                                                </a>

                                                <a href="{{ request()->url()}}?order=cheapest">
                                                    <span class="order-filter d-block d-sm-inline-block
                                                    {{ request()->input('order') == 'cheapest' ? 'active' : '' }}
                                                    ">ارزان‌ترین</span>

                                                </a>
                                            </div>
                                            <div class="col-12 col-sm-2 pt-1 text-end">
                                            <span>
                                                <a href="{{ route('front.products.list') }}?show=list"
                                                   class="products-view-type {{ request()->show == 'list' || request()->url() == route('front.products.list')   ? 'active' : '' }}"><i
                                                        class="fa fa-th-list"></i></a>
                                                <a href="{{ route('front.products.list') }}?show=tile"
                                                   class="products-view-type {{ request()->show == 'tile' ? 'active' : '' }}"><i
                                                        class="fa fa-th"></i></a>
                                            </span>
                                                &nbsp;|&nbsp;
                                                <span>{{ $products->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Filters -->
                                <div class="mt-2" id="pager">
                                    @if(count($products) > 0)
                                    @if( request()->show == 'tile' )
                                        <div class="container">
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-md-4">
                                                <!-- Products -->
                                                @foreach($products as $product)
                                                    @include('Front::partials.product-box' , ['product' , $product , 'discount' => false])
                                                @endforeach
                                                <!-- /Products -->
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="pagination-bg">
                                                        <ul class="pagination justify-content-center pagination-sm">
                                                            {{   $products->withQueryString()->links() }}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="container">
                                            <div class="row row-cols-1 gx-md-4">
                                                <!-- Products -->
                                                <div class="col">
                                                    <!-- Product Box -->
                                                    @foreach($products as $product)
                                                        @include('Front::partials.product-box-row' , ['product' , $product])
                                                    @endforeach
                                                    <!-- /Product Box -->
                                                </div>
                                                <!-- /Products -->
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="pagination-bg">
                                                        <ul class="pagination justify-content-center pagination-sm"></ul>
                                                        {{   $products->withQueryString()->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @else
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <h4 class="text-center mt-md-5 mb-md-4">
                                                            محصولی یافت نشد.
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script>
        function findProduct(id) {
            if ($('#checkbox-' + id).is(':checked')) {
                var url = '{{ route('front.products.list') }}?' + "category=" + id
                window.location.href = url
            } else {
                var url = '{{ route('front.products.list') }}'
                window.location.href = url
            }
        }

        function availableProducts() {
            if ($('#only-available').is(':checked')) {
                var url = '{{ route('front.products.list') }}?' + 'only-available=true'
                window.location.href = url
            } else {
                var url = '{{ route('front.products.list') }}'
                window.location.href = url
            }
        }

        function priceRange() {
            event.preventDefault()
           var price_range_from = $('#price-range-from').text()
           var price_range_to = $('#price-range-to').text()
            var url = '{{ route('front.products.list') }}?' +
                'price_range_from=' +   price_range_from.split(',').join("") + '&price_range_to=' + price_range_to.split(',').join("") ;
            window.location.href = url
        }



    </script>
@endsection
