    <!-- Product Box -->
    <div class="product-box" >
            <a href="{{ $product->path() }}">
                <div class="image" style="background-image: url({{ $product->primaryImage
                                                ? route('image.display' , [ $product->id , $product->primaryImage->images['default']]) : ''}})">

                    @if($product->hasDiscount)
                    <span class="badge on-sale-badge">فروش ویژه</span>
                    @endif
                </div>
            </a>

        <div class="details p-3">
            <div class="category">
                <a href="{{ $product->category->path() }}">{{ $product->category->name }}</a>
                &nbsp;/&nbsp;
                <a >{{ $product->brand->name }}</a>
            </div>
            <a href="{{ $product->path() }}"><h2>{{ $product->name }}</h2></a>
            @if($product->hasDiscount)
                <div>
                    <span class="discounted">{{ number_format($product->formattedPrice()) }} تومان</span>
                    <br class="d-sm-none">
                    <span class="price">{{ number_format($product->priceWithDiscount()) }} تومان</span>
                </div>
            @else
                <div>
                    <span class="price">{{ number_format($product->priceWithDiscount()) }} تومان</span>
                </div>
            @endif
{{--            <div class="rate">--}}
{{--                <i class="fa fa-star-half-alt"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <i class="fa fa-star"></i>--}}
{{--                <span class="reviews">(14 رای دهنده)</span>--}}
{{--            </div>--}}
        </div>
    </div>
    <!-- /Product Box -->
