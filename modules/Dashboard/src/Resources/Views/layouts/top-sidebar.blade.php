<div class="sidebar">
    <ul class="nav nav-pills nav-justified m-b-30" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="pill" href="#messages" role="tab" aria-controls="messages" aria-selected="true">
                <i class="fa fa-envelope"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="comments-tab" data-toggle="pill" href="#comments" role="tab" aria-controls="comments" aria-selected="false">
                <span> {{ $unseenComments->count() }}  </span>
                <i class="fa fa-comment"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="notifications-tab" data-toggle="pill" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">
                <i class="fa fa-bell"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">
                <i class="ti-settings"></i>
            </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
{{--        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">--}}
{{--            <div class="tab-pane-body">--}}
{{--                <h5 class="font-weight-bold m-b-20">گفتگو ها</h5>--}}
{{--                <form>--}}
{{--                    <input type="text" class="form-control" placeholder="جستجوی گفتگو">--}}
{{--                </form>--}}
{{--                <ul class="list-group list-group-flush">--}}
{{--                    <a href="#" class="list-group-item d-flex align-items-center p-l-r-0">--}}
{{--                        <div>--}}
{{--                            <figure class="avatar avatar-sm m-l-15">--}}
{{--                                <span class="avatar-title bg-whatsapp rounded-circle">V</span>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h6 class="m-b-0">جان اسنو</h6>--}}
{{--                            <span class="text-muted small">مهندس</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item d-flex align-items-center p-l-r-0">--}}
{{--                        <div>--}}
{{--                            <figure class="avatar avatar-sm m-l-15">--}}
{{--                                <img src="/assets/panel/media/image/avatar.jpg" class="rounded-circle" alt="image">--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h6 class="m-b-0">تونی استارک</h6>--}}
{{--                            <span class="text-muted small">منابع انسانی</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item d-flex align-items-center p-l-r-0">--}}
{{--                        <div>--}}
{{--                            <figure class="avatar avatar-sm m-l-15">--}}
{{--                                <span class="avatar-title rounded-circle">M</span>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h6 class="m-b-0">استیو راجرز</h6>--}}
{{--                            <span class="text-muted small">مشاور املاک</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item d-flex align-items-center p-l-r-0">--}}
{{--                        <div>--}}
{{--                            <figure class="avatar avatar-sm m-l-15">--}}
{{--                                <span class="avatar-title rounded-circle">ک</span>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h6 class="m-b-0">پیتر پارکر</h6>--}}
{{--                            <span class="text-muted small">مهندس</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item d-flex align-items-center p-l-r-0">--}}
{{--                        <div>--}}
{{--                            <figure class="avatar avatar-sm m-l-15">--}}
{{--                                <span class="avatar-title bg-warning rounded-circle">V</span>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h6 class="m-b-0">جان اسنو</h6>--}}
{{--                            <span class="text-muted small">مهندس</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="tab-pane-footer">--}}
{{--                <a href="#" class="btn btn-primary btn-block">گفتگوی جدید</a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="tab-pane" id="comments" role="tabpanel" aria-labelledby="comments-tab">
            <div class="tab-pane-body">
                <h5 class="font-weight-bold m-b-20">نظرات جدید</h5>
                <div>
                    <p class="text-muted">امروز</p>
                    <ul class="list-group list-group-flush m-b-10">
                        @foreach($unseenComments as $unseenComment)
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title rounded-circle">
                                        <i class="fa fa-commenting-o"></i>
                                    </span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">یک نظر جدید</p>
                                <p class="m-b-0">{{ str($unseenComment->body)->limit(15 , '...') }}</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">{{ getJalaliDate($unseenComment->created_at) }}</li>
                                    <li class="list-inline-item">
                                        <a href="{{ route('panel.comments.changeSeenStatus' , $unseenComment->id) }}">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="{{ route('panel.comments.index') }}">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-pane-footer">
                <a href="{{ route('panel.comments.changeSeenStatus') }}" class="btn btn-primary btn-block">علامت خوانده شده به همه</a>
            </div>
        </div>

        <div class="tab-pane" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <div class="tab-pane-body">
                <h5 class="font-weight-bold m-b-20">اعلان ها</h5>
                <div>
                    <p class="text-muted">امروز</p>
                    <ul class="list-group list-group-flush m-b-10">
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title bg-success rounded-circle">آ</span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">
                                    <span class="badge small badge-danger">جدید</span>
                                    ثبت نام کاربر جدید.
                                </p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">8 دقیقه پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title rounded-circle">
                                        <i class="fa fa-cloud-upload"></i>
                                    </span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">فایل ها با موفقیت آپلود شدند.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">50 دقیقه پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="text-muted">دیروز</p>
                    <ul class="list-group list-group-flush m-b-10">
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title bg-warning rounded-circle">V</span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">ثبت نام کاربر جدید.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">5 ساعت پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title rounded-circle">
                                        <i class="fa fa-file-o"></i>
                                    </span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">صورتحساب شما آماده شد.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">10 ساعت پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title rounded-circle">
                                        <i class="fa fa-cloud-upload"></i>
                                    </span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">فایل ها با موفقیت آپلود شدند.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">16 ساعت پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane-footer">
                <a href="#" class="btn btn-primary btn-block">علامت خوانده شده به همه</a>
            </div>
        </div>
        <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="tab-pane-body">
                <div class="m-b-30">
                    <h5 class="font-weight-bold m-b-20">تنظیمات</h5>
                    <h6 class="font-weight-bold">سیستم</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>به روز رسانی خودکار</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>وضعیت کنونی</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                <label class="custom-control-label" for="customSwitch2"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>پیشنهادات کاربران</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                                <label class="custom-control-label" for="customSwitch3"></label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="m-b-30">
                    <h6 class="font-weight-bold">حساب کاربری</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>امنیت حساب کاربری ارشد</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch4">
                                <label class="custom-control-label" for="customSwitch4"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>حفاظت حساب کاربری</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch5" checked>
                                <label class="custom-control-label" for="customSwitch5"></label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="m-b-30">
                    <h6 class="font-weight-bold">اعلان ها</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>اعلان های مرورگر</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch6">
                                <label class="custom-control-label" for="customSwitch6"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>اعلان های موبایل</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch7">
                                <label class="custom-control-label" for="customSwitch7"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>اشتراک ایمیل</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch8">
                                <label class="custom-control-label" for="customSwitch8"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>اعلان های sms</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch9" checked>
                                <label class="custom-control-label" for="customSwitch9"></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane-footer">
                <a href="#" class="btn btn-primary btn-block">ذخیره تنظیمات</a>
            </div>
        </div>
    </div>
</div>
