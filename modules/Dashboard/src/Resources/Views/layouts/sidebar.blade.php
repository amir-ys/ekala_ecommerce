x
<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            {{--            <li class="side-menu-divider">فهرست</li>--}}


            <li><a
                   class="{{ request()->url(route('panel.home')) == route('panel.home') ? 'c-active' : '' }}"
                   href="{{ route('panel.home') }}">
                    <i class="icon ti-layout"></i>
                    <span>داشبرد</span> <span class="badge bg-danger-gradient"></span></a>
            </li>


            <li class="side-menu-divider">مدیریت کاربران</li>
            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS ,
                                                  \Modules\RolePermissions\Models\Permission::PERMISSION_READ_USERS ,
                                                   \Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS ,
                                         \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ROLE_PERMISSIONS ,
                                         \Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ADMINS ,
                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ADMINS
                                         ])
                <li><a href="#"><i class="icon ti-user"></i> <span> کاربران</span> </a>
                    <ul>
                        @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_USERS ,
                            \Modules\RolePermissions\Models\Permission::PERMISSION_READ_USERS])
                            <li><a href="{{ route('panel.users.index') }}">کاربران </a></li>
                        @endcanany

                            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ADMINS ,
                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ADMINS])
                                <li><a href="{{ route('panel.admins.index') }}">مدیران </a></li>
                            @endcanany


                        @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS ,
                                             \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ROLE_PERMISSIONS])
                            <li><a href="">سطوح دسترسی </a>
                                <ul>
                                    <li><a href="{{ route('panel.roles.index') }}"> نقش کاربری </a></li>
                                </ul>
                            </li>
                        @endcanany
                    </ul>
                </li>
            @endcanany

            <li class="side-menu-divider">فروشگاه</li>
            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_PRODUCTS ,
                                                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_PRODUCTS])
                <li><a href="{{ route('panel.products.index') }}"
                       class="{{ request()->url(route('panel.products.index')) == route('panel.products.index') ? 'c-active' : '' }}"
                    >
                        <i class="icon ti-shopping-cart"></i>
                        <span> محصولات </span> <span class="badge bg-danger-gradient"></span></a>
                </li>
            @endcanany

            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_CATEGORIES ,
                    \Modules\RolePermissions\Models\Permission::PERMISSION_READ_CATEGORIES ,\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_BRANDS ,
                                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_BRANDS , \Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ATTRIBUTE_GROUPS ,
                                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ATTRIBUTE_GROUPS , \Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ATTRIBUTES ,
                                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ATTRIBUTES])
            <li><a href="#"><i class="icon ti-shopping-cart-full"></i> <span> ویژگی های فروشگاه </span> </a>
                <ul>

                    @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_CATEGORIES ,
                                                           \Modules\RolePermissions\Models\Permission::PERMISSION_READ_CATEGORIES])
                    <li><a
                           class="{{ request()->url(route('panel.categories.index')) == route('panel.categories.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.categories.index') }}">

                            <span>دسته بندی ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>
                    @endcanany


                    @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_BRANDS ,
                                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_BRANDS])
                    <li><a
                           class="{{ request()->url(route('panel.brands.index')) == route('panel.brands.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.brands.index') }}">
                            <span>برند ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>
                    @endcanany

                    @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ATTRIBUTE_GROUPS ,
                                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ATTRIBUTE_GROUPS])
                    <li><a
                           class="{{ request()->url(route('panel.attributeGroups.index')) == route('panel.attributeGroups.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.attributeGroups.index') }}">

                            <span>گروه ویژگی ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>
                    @endcanany

                    @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_ATTRIBUTES ,
                                   \Modules\RolePermissions\Models\Permission::PERMISSION_READ_ATTRIBUTES])
                    <li><a
                           class="{{ request()->url(route('panel.attributes.index')) == route('panel.attributes.index') ? 'c-active' : '' }}"
                           href="{{ route('panel.attributes.index') }}">

                            <span>ویژگی ها</span> <span class="badge bg-danger-gradient"></span></a>
                    </li>
                    @endcanany

                </ul>
            </li>
            @endcanany
            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_COUPONS ,
                                       \Modules\RolePermissions\Models\Permission::PERMISSION_READ_COUPONS])
            <li><a href="#"><i class="icon ti-gift"></i> <span> تخفیف ها </span> </a>
                <ul>
                    <li><a href="{{ route('panel.coupons.index') }}">
                            کد تخفیف
                        </a></li>

                    <li><a href="{{ route('panel.commonDiscounts.index') }}">
                            تخفیف های عمومی
                        </a></li>

                </ul>
            </li>
            @endcanany

            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_PAYMENTS ,
                                                       \Modules\RolePermissions\Models\Permission::PERMISSION_READ_PAYMENTS])
            <li><a href="#"><i class="icon ti-credit-card"></i> <span> پرداخت ها </span> </a>
                <ul>
                    <li><a href="{{ route('panel.payments.index') }}">همه پرداخت ها </a></li>
                    <li><a href="{{ route('panel.payments.online') }}">پرداخت های آنلاین </a></li>
                    <li><a href="{{ route('panel.payments.offline') }}">پرداخت های آفلاین </a></li>
                </ul>
            </li>

            <li><a href="#"><i class="icon ti-bag"></i> <span>  سفارشات  </span> </a>
                <ul>
                    <li><a href="{{ route('panel.orders.index') }}"> همه سفارشات </a></li>
                    <li><a href="{{ route('panel.orders.sending.index') }}"> در حال ارسال </a></li>
                    <li><a href="{{ route('panel.orders.unpaid.index') }}">پرداخت نشده </a></li>
                    <li><a href="{{ route('panel.orders.canceled.index') }}"> باطل شده </a></li>
                    <li><a href="{{ route('panel.orders.returned.index') }}"> مرجوعی </a></li>
                </ul>
            </li>
            @endcanany

            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_COMMENTS ,
                                                       \Modules\RolePermissions\Models\Permission::PERMISSION_READ_COMMENTS])
            <li><a
                   class="{{ request()->url(route('panel.comments.index')) == route('panel.comments.index') ? 'c-active' : '' }}"
                   href="{{ route('panel.comments.index') }}">
                    <i class="icon ti-comments"></i>
                    <span>  نظرات</span> <span class="badge bg-danger-gradient"></span></a>
            </li>
            @endcanany


            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_SLIDES ,
                                                       \Modules\RolePermissions\Models\Permission::PERMISSION_READ_SLIDES])
            <li><a
                   class="{{ request()->url(route('panel.slides.index')) == route('panel.slides.index') ? 'c-active' : '' }}"
                   href="{{ route('panel.slides.index') }}">
                    <i class="icon ti-gallery"></i>
                    <span> اسلایدر </span> <span class="badge bg-danger-gradient"></span></a>
            </li>
            @endcanany


            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_BLOG ,
                                                       \Modules\RolePermissions\Models\Permission::PERMISSION_READ_BLOG])
            <li class="side-menu-divider">وبلاگ</li>

            <li><a href="#"><i class="icon ti-rocket"></i> <span> وبلاگ </span> </a>
                <ul>
                    <li><a href="{{ route('panel.blog.categories.index') }}">دسته بندی ها </a></li>
                    <li><a href="{{ route('panel.blog.posts.index') }}">پست ها </a></li>
                </ul>
            </li>
            @endcanany

            <li class="side-menu-divider">سایت</li>

            @canany([\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGE_SETTINGS ,
                                                       \Modules\RolePermissions\Models\Permission::PERMISSION_READ_SETTINGS])
            <li><a
                   class="{{ request()->url(route('panel.settings.index')) == route('panel.settings.index') ? 'c-active' : '' }}"
                   href="{{ route('panel.settings.index') }}">
                    <i class="icon ti-settings"></i>
                    <span> تنظیمات </span> <span class="badge bg-danger-gradient"></span></a>
            </li>
            @endcanany


        </ul>
    </div>
</div>

