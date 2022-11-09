<!-- Footer -->
<section class="pt-4 pb-3" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="title">دسترسی سریع</div>
                <ul>
                    <li><a href="{{ route('front.blog.index') }}">وبلاگ </a></li>
                    {{--                    <li><a href="./faq.html">راهنمای خرید</a></li>--}}
                    {{--                    <li><a href="./faq.html">شیوه های پرداخت</a></li>--}}
                    {{--                    <li><a href="./contact.html">پیگیری سفارش</a></li>--}}
                    <li><a href="{{ route('front.faqs.show') }}">سوالات متداول</a></li>
                    <li><a href="{{ route('front.aboutUs.show') }}">درباره ما</a></li>
                    <li><a href="{{ route('front.contactUs.show') }}">تماس با ما</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="title">دسته بندی های محصولات</div>
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{ $category->path() }}"> {{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 d-none d-sm-inline-block">
                <div class="title">حساب کاربری</div>
                <ul>
                    <li><a href="{{ route('login') }}">ورود به سایت</a></li>
                    <li><a href="{{ route('register') }}">عضویت در سایت</a></li>
                    <li><a href="{{ route('front.cart.index') }}">سبد خرید</a></li>
                    <li><a href="{{ route('front.checkout.addressPage')  }}">پیش فاکتور</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <hr class="d-lg-none">
                <img src="/assets/front/assets/images/logo.png"
                     alt=""> {{ site_name() }}
                <br>
                <p>
                    {{ $shopFooter?->value }}
                </p>
                <div class="row">
                    <div class="col-12 col-md-6 text-center p-2" id="support-info">
                        {!! $shopFooterContact?->value !!}
                    </div>
                    <div class="col-12 col-md-6 pt-2 pt-md-0" id="certificates">
                        <div class="row">
                            <div class="col-4 text-center">
                                <a href="#"><img src="assets/front/assets/images/certificates/enamad.png" alt=""></a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#"><img src="assets/front/assets/images/certificates/samandehi.png" alt=""></a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#"><img src="assets/front/assets/images/certificates/etehadiye.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Footer -->

<!-- Copyright -->
<section class="py-2" id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6" id="social-links">
                <span>ما را دنبال کنید</span>
                <a href="{{ isset($socialMedia->json['instagram']) ? $socialMedia->json['instagram'] : null  }}"><img
                        src="/assets/front/assets/images/social/insta.png" alt=""></a>
                <a href="{{ isset($socialMedia->json['facebook']) ? $socialMedia->json['facebook'] : null  }}"><img
                        src="/assets/front/assets/images/social/facebook.png" alt=""></a>
                <a href="{{ isset($socialMedia->json['linkedin']) ? $socialMedia->json['linkedin'] : null  }}"><img
                        src="/assets/front/assets/images/social/linkedin.png" alt=""></a>
                <a href="{{ isset($socialMedia->json['twitter']) ? $socialMedia->json['twitter'] : null  }}"><img
                        src="/assets/front/assets/images/social/twitter.png" alt=""></a>
                <a href="{{ isset($socialMedia->json['youtube']) ? $socialMedia->json['youtube'] : null  }}"><img
                        src="/assets/front/assets/images/social/youtube.png" alt=""></a>
            </div>
            <div class="col-12 col-sm-6 text-sm-end pt-2 pt-sm-0">
                <span>کلیه حقوق و مادی معنوی محفوط است.</span>
            </div>
        </div>
    </div>
</section>
<!-- Copyright -->
