<div class="accordion" id="side-panel">
    <div class="accordion-item menu-container">
        <h2 class="accordion-header">
            <button class="accordion-button bg-light" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne">
                                            <span class="row">
                                                <span class="col-3 col-sm-2 col-lg-3">
                                                    <img src="/assets/front/assets/images/user-no-image.jpg"
                                                         class="rounded-circle">
                                                </span>
                                                <span
                                                    class="col-7 col-sm-8 col-lg-7 pt-0 pt-sm-2 pt-md-3 pt-lg-0 align-self-center">
                                                    <div id="full-name">{{ auth()->user()->username ?? auth()->user()->mobile  }}</div>
                                                    <div class="mt-2" id="email-mobile">{{auth()->user()->mobile }}</div>
                                                </span>
                                            </span>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
             aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <ul>
                    <li>
                        <a href="{{ route('front.user.personalInfo.index') }}" class="{{ \Illuminate\Support\Facades\Route::is('front.user.personalInfo.index') ? 'active' : '' }}">
                            <div>
                                <div class="icon d-inline-block">
                                    <img src="/assets/front/assets/images/icons/profile-menu/profile.webp" class="pl-2"></div>
                                اطلاعات حساب
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.user.orders.index') }}" class="{{ \Illuminate\Support\Facades\Route::is('front.user.orders.index') ? 'active' : '' }}" >
                            <div>
                                <div class="icon d-inline-block"><img src="/assets/front/assets/images/icons/profile-menu/orders.webp" class="pl-2"></div>
                                سفارش های من
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.user.wishlists.index') }}" class="{{ \Illuminate\Support\Facades\Route::is('front.user.wishlists.index') ? 'active' : '' }}">
                            <div>
                                <div class="icon d-inline-block"><img src="/assets/front/assets/images/icons/profile-menu/favorites.webp" class="pl-2"></div>
                                علاقه مندی ها
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.user.addresses.index') }}" class="{{ \Illuminate\Support\Facades\Route::is('front.user.addresses.index') ? 'active' : '' }}">
                            <div>
                                <div class="icon d-inline-block"><img
                                        src="/assets/front/assets/images/icons/profile-menu/addresses.webp"
                                        class="pl-2"></div>
                                آدرس های من
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <div>
                                <div class="icon d-inline-block"><img
                                        src="/assets/front/assets/images/icons/profile-menu/exit.webp"
                                        class="pl-2"></div>
                                خروج از حساب
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
