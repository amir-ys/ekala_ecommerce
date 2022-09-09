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
                                        @if(\Request::segment(1) == 'blog' )
                                            <li class="droopmenu-parent" aria-haspopup="true">
                                                <a href="#" aria-expanded="false"><i class="fa fa-bars"></i>&nbsp;&nbspدسته بندی ها<em class="droopmenu-topanim"></em></a>
                                                <ul class="droopmenu-grid droopmenu-grid-6">
                                                    <li class="droopmenu-tabs ">
                                                        @foreach($postCategories as $postCategory)
                                                            <div class="droopmenu-tabsection" id="droopmenutab10">
                                                                <a class="droopmenu-tabheader"
                                                                   href="{{ route('front.blog.postCategory' , $postCategory->slug) }}">
                                                                    {{ $postCategory->name }}</a>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('front.home') }}"> فروشگاه<em
                                                        class="droopmenu-topanim"></em></a></li>
                                        @else
                                            <li class="droopmenu-parent" aria-haspopup="true">
                                                <a href="#" aria-expanded="false"><i class="fa fa-bars"></i>&nbsp;&nbspدسته
                                                    بندی ها<em class="droopmenu-topanim"></em></a>
                                                <div class="dm-arrow"></div>
                                                <ul class="droopmenu-grid droopmenu-grid-9">
                                                    <li class="droopmenu-tabs droopmenu-tabs-vertical">
                                                        @foreach($categories as $category)
                                                            <div class="droopmenu-tabsection" id="droopmenutab10">
                                                                <a class="droopmenu-tabheader"
                                                                   href="{{ $category->path() }}">{{ $category->name }}</a>
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
                                                <a href="./products.html" aria-expanded="false"> فروشگاه<em
                                                        class="droopmenu-topanim"></em></a>
                                                <div class="dm-arrow"></div>
                                                <ul style="">
                                                    <li><a href="{{ route('front.products.list') }}">محصولات </a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('front.faqs.show') }}">سوالات متداول</a></li>
                                            <li><a href="{{ route('front.blog.index') }}"> وبلاگ<em
                                                        class="droopmenu-topanim"></em></a></li>
                                        @endif

                                        @auth()
                                            <li class="droopmenu-parent" aria-haspopup="true">
                                                <a href="{{ route('front.user.personalInfo.index') }}"
                                                   aria-expanded="false">پروفایل کاربری<em
                                                        class="droopmenu-topanim"></em></a>
                                                <div class="dm-arrow"></div>
                                                <ul style="">
                                                    <li><a href="{{ route('front.user.personalInfo.index') }}">مشخصات
                                                            کاربری</a></li>
                                                    <li><a href="{{ route('front.user.orders.index') }}">سفارشات</a>
                                                    </li>
                                                    <li><a href="{{ route('front.user.addresses.index') }}">آدرس ها</a>
                                                    </li>
                                                    <li><a href="{{ route('front.user.wishlists.index') }}">علاقه مندی
                                                            ها</a></li>
                                                </ul>
                                            </li>
                                        @endauth
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
