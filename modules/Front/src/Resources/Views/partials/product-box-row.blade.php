<div class="product-box-row">
    <div class="row">
        <div class="col-12 col-md-4">
            <a href="{{ $product->path() }}">
                <div class="image" style="background-image: url({{ $product->primaryImage
                                                ? route('image.display' , [ $product->id , $product->primaryImage->images['default']]) : ''}})">
                    @if($product->hasDiscount)
                        <span class="badge on-sale-badge">فروش ویژه</span>
                    @endif
                </div>
            </a>
        </div>
        <div class="col-12 col-md-8">
            <div class="details py-3 px-3">
                <div class="category">
                    <a href="{{ $product->category->path() }}">{{ $product->category->name }}</a>
                    &nbsp;/&nbsp;
                    <a href="">{{ $product->brand->name }}</a>
                </div>
                <a href="{{ $product->path() }}"><h2>{{ $product->name }}</h2></a>
{{--                <div class="rate">--}}
{{--                    <i class="fa fa-star-half-alt"></i>--}}
{{--                    <i class="fa fa-star"></i>--}}
{{--                    <i class="fa fa-star"></i>--}}
{{--                    <i class="fa fa-star"></i>--}}
{{--                    <i class="fa fa-star"></i>--}}
{{--                    <span class="reviews">(14 رای دهنده)</span>--}}
{{--                </div>--}}
                <p>{!! str($product->description)->limit(75)  !!}</p>
                <div class="price mb-2">{{ $product->formattedPrice() }} تومان</div>
                <a href=""><div class="btn btn-sm btn-success">مشاهده و خرید</div></a>
            </div>
        </div>
    </div>
</div>
