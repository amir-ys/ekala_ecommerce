<div class="product-box-row">
    <div class="row">
        <div class="col-12 col-md-4">
            <img style="height:200px"  src="{{ $product->primaryImage
                                                ? route('image.display' , $product->primaryImage->name) : ''}}" alt="">        </div>
        <div class="col-12 col-md-8">
            <div class="details py-3 px-3">
                <div class="category">
                    <a href="./products.html">{{ $product->category->name }}</a>
                    &nbsp;/&nbsp;
                    <a href="./products.html">{{ $product->brand->name }}</a>
                </div>
                <a href="{{ $product->path() }}"><h2>{{ $product->name }}</h2></a>
                <div class="rate">
                    <i class="fa fa-star-half-alt"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span class="reviews">(14 رای دهنده)</span>
                </div>
                <p>{{ $product->description }}</p>
                <div class="price mb-2">{{ $product->formattedPrice() }} تومان</div>
                <a href=""><div class="btn btn-sm btn-success">مشاهده و خرید</div></a>
            </div>
        </div>
    </div>
</div>
