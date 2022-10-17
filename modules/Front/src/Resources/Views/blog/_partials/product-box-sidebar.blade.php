<div class="col-12 col-lg-12 px-0 mt-2">
    <a href="{{ $product->path() }}">
        <div class="side-blog-product">
            <div class="row pl-3">
                <div class="col-4 pl-2">
                    <img src="{{ $product->primaryImage ? route('image.display' , [ 'product' => $product->id  , 'image' =>  $product->primaryImage->images['small']]) : ''}}" alt="">
                </div>
                <div class="col-8 px-0">
                    <h2>{{ $product->name }}</h2>
                    <div class="row">
                        <div class="col-8 pl-0">
                            <span class="price">{{ number_format($product->finalPrice())  }} تومان</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
