<div class="col-12 col-lg-3">
    <div class="row">
        <!-- Side Panel -->
        <div class="col-12 col-sm-6 col-lg-12 px-lg-2">
            <div class="blog-side-panel">
                <div class="row pt-2 px-3">
                    <div class="col">
                        <div class="title">پربازدیدترین محصولات</div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        <!-- Side Panel Product -->
                        @foreach(getMostVisitedProductFromRedis(3) as $product)
                            @include('Front::blog._partials.product-box-sidebar' , ['product' => $product])
                        @endforeach
                        <!-- /Side Panel Product -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-12 px-lg-2">
            <div class="blog-side-panel">
                <div class="row pt-4 pt-sm-2 px-3">
                    <div class="col">
                        <div class="title">پربازدیدترین مطالب</div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        <!-- Side Panel Post -->
                        @foreach(getMostVisitedPostsFromRedis() as $post)
                            @include('Front::blog._partials.post-box-sidebar' , ['post' => $post])
                        @endforeach
                        <!-- /Side Panel Post -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Side Panel -->
    </div>
</div>
