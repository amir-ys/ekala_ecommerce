<div id="search-nav">
    <div class="container pt-1">
        <div class="row py-3 align-content-center">
            <div class="col-12 col-md-3 col-xl-2 text-center text-md-start pb-2" id="header-logo">
                <a href="/">
                    <img src="/assets/front/assets/images/logo.png" alt=""> روبیک مارکت
                </a>
            </div>
            <div class="col-12 col-md-5 col-xl-6">
                <div id="search-bar">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="جستجو کنید...">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="row">
                    @auth
                        <div class="col-12 col-md-7 col-lg-6 text-center" id="btn-login-register">
                            <a href="{{ route('front.user.personalInfo.index') }}"> پروفایل کاربری </a>
                        </div>
                    @else
                        <div class="col-12 col-md-7 col-lg-6 text-center" id="btn-login-register">
                            <a href="{{ route('login') }}">ورود</a> /
                            <a href="{{ route('register') }}">عضویت</a>
                        </div>
                    @endauth
                    <div class="col-12 col-md-5 col-lg-6">
                        <a href="{{ route('front.cart.index') }}">
                            <div class="btn btn-warning w-100"><i class="fa fa-shopping-cart"></i>&nbsp;<span class="d-md-none d-lg-inline-block">سبد خرید</span> ({{  Cart::getContent()->count() }})</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
