<div class="col-12 col-md-4 col-lg-12 px-0 mt-2">
    <a href="{{ $product->path() }}">
        <div class="side-product">
            <div class="row pl-3">
                <div class="col-3 pl-2">
                    <img src="{{ $product->primaryImage ? route('image.display' ,[ $product->id ,  $product->primaryImage->images['small']]) : ''}}" alt="">
                </div>
                <div class="col-9 pr-0">
                    <h2>{{ $product->name }}</h2>
                    <div class="row">
                        <div class="col-7 pl-0">
                            <span class="price">{{ number_format($product->finalPrice()) }} تومان</span>
                        </div>
                        <div class="col-5 pr-0 text-end">
                            <span class="views">{{ productVisitCount($product->id) }} بازدید</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
