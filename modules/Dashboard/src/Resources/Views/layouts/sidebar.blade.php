x
<div class="side-menu">
    <div class="side-menu-body">
        <ul>
{{--            <li class="side-menu-divider">فهرست</li>--}}


            <li><a data-attr="layout-builder-toggle"
                   class="{{ request()->url(route('panel.home')) == route('panel.home') ? 'c-active' : '' }}"
                   href="/home">
                    <i class="icon ti-layout"></i>
                    <span>داشبرد</span> <span class="badge bg-danger-gradient"></span></a>
            </li>


{{--            <li class="side-menu-divider">مدیریت کاربران</li>--}}

            <li><a href="#"><i class="icon ti-user"></i> <span> کاربران</span> </a>
                <ul>
                    <li><a href="{{ route('panel.users.index') }}">کاربران </a></li>
                    <li><a href="#">سطوح دسترسی </a>
                        <ul>
                            <li><a href="inbox.html"> نقش کاربری </a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="side-menu-divider">فروشگاه</li>

            <li><a data-attr="layout-builder-toggle"
                   class="{{ request()->url(route('panel.products.index')) == route('panel.products.index') ? 'c-active' : '' }}"
                   href="{{ route('panel.products.index') }}">
                    <i class="icon ti-shopping-cart"></i>
                    <span> محصولات </span> <span class="badge bg-danger-gradient"></span></a>
            </li>

            <li><a href="#"><i class="icon ti-shopping-cart-full"></i> <span> ویژگی های فروشگاه </span> </a>
                <ul>

                    <li><a data-attr="layout-builder-toggle"
                           class="{{ request()->url(route('panel.categories.index')) == route('panel.categories.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.categories.index') }}">

                            <span>دسته بندی ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>

                    <li><a data-attr="layout-builder-toggle"
                           class="{{ request()->url(route('panel.brands.index')) == route('panel.brands.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.brands.index') }}">
                            <span>برند ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>

                    <li><a data-attr="layout-builder-toggle"
                           class="{{ request()->url(route('panel.attributeGroups.index')) == route('panel.attributeGroups.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.attributeGroups.index') }}">

                            <span>گروه ویژگی ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>

                    <li><a data-attr="layout-builder-toggle"
                           class="{{ request()->url(route('panel.attributes.index')) == route('panel.attributes.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.attributes.index') }}">

                            <span>ویژگی ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>

                    <li><a data-attr="layout-builder-toggle"
                           class="{{ request()->url(route('panel.delivery.index')) == route('panel.delivery.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.delivery.index') }}">

                            <span> روش های ارسال </span> <span class="badge bg-danger-gradient"></span></a>
                    </li>

                    <li><a data-attr="layout-builder-toggle"
                           class="{{ request()->url(route('panel.slides.index')) == route('panel.slides.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.slides.index') }}">

                            <span> اسلایدر </span> <span class="badge bg-danger-gradient"></span></a>
                    </li>
                </ul>
            </li>


{{--            <li class="side-menu-divider"> نظرات</li>--}}

            <li><a data-attr="layout-builder-toggle"
                   class="{{ request()->url(route('panel.comments.index')) == route('panel.comments.index') ? 'c-active' : '' }}"
                   href="{{ route('panel.comments.index') }}">
                    <i class="icon ti-comments"></i>
                    <span>  نظرات</span> <span class="badge bg-danger-gradient"></span></a>
            </li>

{{--            <li class="side-menu-divider">تخفیف ها</li>--}}

            <li><a data-attr="layout-builder-toggle"
                   class="{{ request()->url(route('panel.coupons.index')) == route('panel.coupons.index') ? 'c-active' : '' }}"
                   href="{{ route('panel.coupons.index') }}">
                    <i class="icon ti-money"></i>
                    <span> کوپن ها / کد تخفیف </span> <span class="badge bg-danger-gradient"></span></a>
            </li>




            <li><a href="#"><i class="icon ti-write"></i> <span> پرداخت ها </span> </a>
                <ul>
                    <li><a href="{{ route('panel.payments.online') }}">پرداخت های آنلاین </a></li>
                    <li><a href="{{ route('panel.payments.offline') }}">پرداخت های آفلاین </a></li>
                    <li><a href="{{ route('panel.payments.cash') }}">پرداخت در محل </a></li>
                </ul>
            </li>



            <li class="side-menu-divider">وبلاگ</li>

            <li><a href="#"><i class="icon ti-write"></i> <span> وبلاگ </span> </a>
                <ul>
                    <li><a href="{{ route('panel.blog.categories.index') }}">دسته بندی ها </a></li>
                    <li><a href="{{ route('panel.blog.posts.index') }}">پست ها  </a></li>
                </ul>
            </li>


            {{--            <li class="side-menu-divider">سایت</li>--}}

            <li><a data-attr="layout-builder-toggle"
                   class="{{ request()->url(route('panel.settings.index')) == route('panel.settings.index') ? 'c-active' : '' }}"
                   href="{{ route('panel.settings.index') }}">
                    <i class="icon ti-settings"></i>
                    <span> تنظیمات </span> <span class="badge bg-danger-gradient"></span></a>
            </li>


        </ul>
    </div>
</div>

