<div id="main-nav">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="droopmenu-navbar dmarrow-down droopmenu-horizontal dmpos-top dmfade">
                    <div class="droopmenu-inner">
                        <div class="droopmenu-header">
                            <a href="#" class="droopmenu-toggle"><i class="dm-burg"></i></a>
                            <span class="d-md-none">منوی فروشگاه</span>
                        </div>
                        <!-- Header Mega Menu-->
                        <div class="droopmenu-nav">
                            <div class="droopmenu-nav-wrap">
                                <div class="droopmenu-navi">
                                    <ul class="droopmenu">
                                        <li class="droopmenu-parent" aria-haspopup="true">
                                            <a href="#" aria-expanded="false"><i class="fa fa-bars"></i>&nbsp;&nbspدسته بندی ها<em class="droopmenu-topanim"></em></a><div class="dm-arrow"></div>
                                            <ul class="droopmenu-grid droopmenu-grid-9">
                                                <li class="droopmenu-tabs droopmenu-tabs-vertical">
                                                    @foreach($categories as $category)
                                                        <div class="droopmenu-tabsection" id="droopmenutab10">
                                                            <a class="droopmenu-tabheader" href="#">{{ $category->name }}</a>
                                                            <div class="droopmenu-tabcontent">
                                                                <div class="droopmenu-row">
                                                                    @foreach($category->childes as $childCategory)
                                                                        <ul class="droopmenu-col droopmenu-col4">
                                                                            <li class="mb-3">{{  $childCategory->name }}</li>
                                                                        </ul>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="droopmenu-parent" aria-haspopup="true">
                                            <a href="./products.html" aria-expanded="false">صفحات فروشگاه<em class="droopmenu-topanim"></em></a><div class="dm-arrow"></div>
                                            <ul style="">
                                                <li><a href="./products.html">محصولات <sup>(کاشی کاری)</sup></a></li>
                                                <li><a href="./products-list.html">محصولات <sup>(لیست)</sup></a></li>
                                                <li><a href="./products.html">جزئیات محصول</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="./about.html">درباره ما<em class="droopmenu-topanim"></em></a></li>
                                        <li class="droopmenu-parent" aria-haspopup="true">
                                            <a href="./contact.html" aria-expanded="false">تماس با فروشگاه<em class="droopmenu-topanim"></em></a><div class="dm-arrow"></div>
                                            <ul style="">
                                                <li><a href="./faq.html">سوالات متداول</a></li>
                                                <li><a href="./contact.html">تماس با ما</a></li>
                                            </ul>
                                        </li>
                                        <li class="droopmenu-parent" aria-haspopup="true">
                                            <a href="./blog.html" aria-expanded="false">بلاگ آموزشی<em class="droopmenu-topanim"></em></a><div class="dm-arrow"></div>
                                            <ul style="">
                                                <li><a href="./blog.html">آرشیو مطالب</a></li>
                                                <li><a href="./blog-post.html">داخلی بلاگ</a></li>
                                            </ul>
                                        </li>
                                        <li class="droopmenu-parent" aria-haspopup="true">
                                            <a href="#" aria-expanded="false">سایر صفحات<em class="droopmenu-topanim"></em></a><div class="dm-arrow"></div>
                                            <ul style="">
                                                <li><a href="./compare.html">مقایسه محصول</a></li>
                                                <li><a href="./cart.html">سبد خرید</a></li>
                                                <li><a href="./checkout.html">پیش فاکتور</a></li>
                                                <li class="dm-bottom-separator"></li>
                                                <li><a href="./login.html">ورود به سایت</a></li>
                                                <li><a href="./register.html">عضویت در سایت</a></li>
                                                <li><a href="./reset-password.html">بازگردانی رمز عبور</a></li>
                                                <li class="dm-bottom-separator"></li>
                                                <li><a href="./error-404.html">خطای 404</a></li>
                                            </ul>
                                        </li>
                                        <li class="droopmenu-parent" aria-haspopup="true">
                                            <a href="profile/personal-info.html" aria-expanded="false">پروفایل کاربری<em class="droopmenu-topanim"></em></a><div class="dm-arrow"></div>
                                            <ul style="">
                                                <li><a href="profile/personal-info.html">مشخصات کاربری</a></li>
                                                <li><a href="profile/factors.html">سفارشات</a></li>
                                                <li><a href="profile/addresses.html">آدرس ها</a></li>
                                                <li><a href="profile/favorites.html">علاقه مندی ها</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /Header Menu Menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
