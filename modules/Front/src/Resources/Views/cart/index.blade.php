@extends('Front::master')
@section('content')

    <section class="inner-page" id="cart-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>سبد خرید</h1>
                                <p>مدیریت و خرید همزمان چند محصول</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">سبد خرید</li>
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
                            <div class="col-12 col-lg-9">
                                <div id="cart-products">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 py-3">
                                                <div class="pb-3" id="return-to-shop">می‌خواهید محصولات دیگری اضافه
                                                    کنید؟ <a href="/">بازگشت به فروشگاه</a></div>
                                                <div class="d-none d-md-block">
                                                    <div class="row my-2" id="heading">
                                                        <div class="col-4">
                                                            <div>کالا</div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div>قیمت واحد</div>
                                                        </div>
                                                        <div class="col-2 pl-4">
                                                            <div>تعداد</div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div>تخفیف</div>
                                                        </div>
                                                        <div class="col-2 pr-0">
                                                            <div class="pr-3">قیمت نهایی</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Order Product Record -->
                                                @foreach($cartItems as $cartItem)
                                                    <div class="row product">
                                                        <div class="col-12 col-md-4">
                                                            <div class="row">
                                                                <div class="col-2 col-md-4 pl-0">
                                                                    <img src="{{ route('image.display'  , $cartItem->associatedModel->primaryImage->name) }}" alt="">
                                                                </div>
                                                                <div class="col-10 col-md-8">
                                                                    <a href="./product.html" target="_blank">
                                                                        <div class="title pt-2">
                                                                            {{  $cartItem->associatedModel->name }}
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-2">
                                                            <div class="d-md-none font-weight-bold">قیمت</div>
                                                            <div class="pt-1"><span class="product-price">{{  $cartItem->price }} </span>
                                                                <span>تومان</span></div>
                                                        </div>
                                                        <div class="col-6 col-md-2 pl-4 pr-0 pr-md-3">
                                                            <div class="d-md-none font-weight-bold">{{  $cartItem->quantity }} </div>
                                                            <div class="input-group mb-3 order-number">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-outline-secondary btn-plus"
                                                                            type="button">+
                                                                    </button>
                                                                </div>
                                                                <input type="text" name="order-number[]" value="1"
                                                                       class="form-control text-center order-number"
                                                                       readonly>
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-outline-secondary btn-minus"
                                                                            type="button">_
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-2">
                                                            <div class="d-md-none font-weight-bold">تخفیف</div>
                                                            <div class="pt-1"><span
                                                                    class="product-discount">{{  $cartItem->associatedModel->discountAmount() }} </span>
                                                                <span>تومان</span></div>
                                                        </div>
                                                        <div class="col-6 col-md-2 pr-0">
                                                            <div class="d-md-none font-weight-bold">قیمت نهایی</div>
                                                            <div class="pt-1 pr-2 bg-light"><span class="product-total">{{  $cartItem->associatedModel->finalPrice() }}</span>
                                                                <span>تومان</span></div>
                                                            <a href="{{ route('front.cart.remove' , $cartItem->id) }}" class="product-remove btn-remove-from-basket"
                                                               data-id="">
                                                                <div class="small pl-2"><i class="fa fa-times"></i> حذف
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <!-- Order Product Record -->
                                                <div class="row product">
                                                    <div class="col-12">
                                                        <a href="#" class="product-remove btn-remove-from-basket"
                                                           data-id="all">
                                                            <a href="{{ route('front.cart.clear') }}" class="float-end small pl-2 font-weight-bold">خالی کردن
                                                                سبد
                                                            </a>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mt-2 mt-lg-0 pr-3 pr-lg-0">
                                <div id="factor">
                                    <div class="container">
                                        <div class="row py-2">
                                            <div class="col-6">
                                                <div>جمع کل فاکتور:</div>
                                            </div>
                                            <div class="col-6">
                                                <div><span id="factor-total-price">3.200.000</span> تومان</div>
                                            </div>
                                        </div>
                                        <div class="row py-2 bg-light">
                                            <div class="col-6">
                                                <div>جمع تخفیف:</div>
                                            </div>
                                            <div class="col-6">
                                                <div><span id="factor-total-discount">200.000</span> تومان</div>
                                            </div>
                                        </div>
                                        <div class="row py-2" id="total">
                                            <div class="col-6">
                                                <div>مبلغ قابل پرداخت:</div>
                                            </div>
                                            <div class="col-6">
                                                <div><span id="factor-total">3.000.000</span> تومان</div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <a href="./checkout.html"><input type="submit" value="ادامه ثبت سفارش"
                                                                                 class="btn btn-success w-100"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Suggested Products -->
                            <div class="col-12 pt-5" id="suggested-products">
                                <div class="title py-3 text-center">سایر محصولات پیشنهادی</div>
                                <div class="owl-carousel products-carousel">
                                    <!-- Product Item -->
                                    <div class="product-box item">
                                        <a href="./product.html">
                                            <div class="image"
                                                 style="background-image: url('assets/images/products/p102.png')"></div>
                                        </a>
                                        <div class="details p-3">
                                            <div class="category">
                                                <a href="./products.html">گوشی موبایل</a>
                                                &nbsp;/&nbsp;
                                                <a href="./products.html">سامسونگ</a>
                                            </div>
                                            <a href="./product.html"><h2>گوشی موبایل سامسونگ مدل Galaxy A21s دو سیم کارت
                                                    ظرفیت 128 گیگابایت</h2></a>
                                            <div class="price">4.000.000 تومان</div>
                                            <div class="rate">
                                                <i class="fa fa-star-half-alt"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span class="reviews">(14 رای دهنده)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Product Item -->
                                    <!-- Product Item -->
                                    <div class="product-box item">
                                        <a href="./product.html">
                                            <div class="image"
                                                 style="background-image: url('assets/images/products/p102.png')"></div>
                                        </a>
                                        <div class="details p-3">
                                            <div class="category">
                                                <a href="./products.html">گوشی موبایل</a>
                                                &nbsp;/&nbsp;
                                                <a href="./products.html">سامسونگ</a>
                                            </div>
                                            <a href="./product.html"><h2>گوشی موبایل سامسونگ مدل Galaxy A21s دو سیم کارت
                                                    ظرفیت 128 گیگابایت</h2></a>
                                            <div class="price">4.000.000 تومان</div>
                                            <div class="rate">
                                                <i class="fa fa-star-half-alt"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span class="reviews">(14 رای دهنده)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Product Item -->
                                    <!-- Product Item -->
                                    <div class="product-box item">
                                        <a href="./product.html">
                                            <div class="image"
                                                 style="background-image: url('assets/images/products/p102.png')"></div>
                                        </a>
                                        <div class="details p-3">
                                            <div class="category">
                                                <a href="./products.html">گوشی موبایل</a>
                                                &nbsp;/&nbsp;
                                                <a href="./products.html">سامسونگ</a>
                                            </div>
                                            <a href="./product.html"><h2>گوشی موبایل سامسونگ مدل Galaxy A21s دو سیم کارت
                                                    ظرفیت 128 گیگابایت</h2></a>
                                            <div class="price">4.000.000 تومان</div>
                                            <div class="rate">
                                                <i class="fa fa-star-half-alt"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span class="reviews">(14 رای دهنده)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Product Item -->
                                    <!-- Product Item -->
                                    <div class="product-box item">
                                        <a href="./product.html">
                                            <div class="image"
                                                 style="background-image: url('assets/images/products/p102.png')"></div>
                                        </a>
                                        <div class="details p-3">
                                            <div class="category">
                                                <a href="./products.html">گوشی موبایل</a>
                                                &nbsp;/&nbsp;
                                                <a href="./products.html">سامسونگ</a>
                                            </div>
                                            <a href="./product.html"><h2>گوشی موبایل سامسونگ مدل Galaxy A21s دو سیم کارت
                                                    ظرفیت 128 گیگابایت</h2></a>
                                            <div class="price">4.000.000 تومان</div>
                                            <div class="rate">
                                                <i class="fa fa-star-half-alt"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span class="reviews">(14 رای دهنده)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Product Item -->
                                    <!-- Product Item -->
                                    <div class="product-box item">
                                        <a href="./product.html">
                                            <div class="image"
                                                 style="background-image: url('assets/images/products/p102.png')"></div>
                                        </a>
                                        <div class="details p-3">
                                            <div class="category">
                                                <a href="./products.html">گوشی موبایل</a>
                                                &nbsp;/&nbsp;
                                                <a href="./products.html">سامسونگ</a>
                                            </div>
                                            <a href="./product.html"><h2>گوشی موبایل سامسونگ مدل Galaxy A21s دو سیم کارت
                                                    ظرفیت 128 گیگابایت</h2></a>
                                            <div class="price">4.000.000 تومان</div>
                                            <div class="rate">
                                                <i class="fa fa-star-half-alt"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span class="reviews">(14 رای دهنده)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Product Item -->
                                </div>
                            </div>
                            <!-- /Suggested Products -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
