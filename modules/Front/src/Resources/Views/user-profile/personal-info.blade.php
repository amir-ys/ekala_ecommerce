@extends('Front::master')
@section('content')
    <section class="inner-page" id="profile-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>ناحیه کاربری</h1>
                                <p>به ناحیه کاربری روبیک مارکت خوش آمدید.</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="../index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item"><a href="#">ناحیه کاربری</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">ویرایش پروفایل</li>
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
                            <div class="col-12 col-lg-3">
                                <!-- Side Panel -->
                                @include('Front::partials.user-profile-sidebar')
                                <!-- /Side Panel -->
                            </div>
                            <div class="col-12 col-lg-9 pl-lg-0 pr-lg-2 mt-2 mt-lg-0">
                                <!-- Profile Fields -->
                                <div class="custom-container bg-light" id="profile-fields">
                                    <div class="row pt-2 px-3 ">
                                        <div class="col-12"><h1>اطلاعات شخصی</h1></div>
                                    </div>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">نام و نام خانوادگی</div>
                                                        <div class="value"> {{ auth()->user()->full_name }}</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#fullNameModal"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">کدملی</div>
                                                        <div class="value">  </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#nationalCodeModal"><i
                                                                class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">شماره تلفن همراه</div>
                                                        <div class="value">{{auth()->user()->mobile}}</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#mobileModal"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">تلفن ثابت</div>
                                                        <div class="value"></div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#telModal"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">پست الکترونیک</div>
                                                        <div class="value">{{auth()->user()->email}}</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#emailModal"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">تاریخ تولد</div>
                                                        <div class="value">{{auth()->user()->birth_date}}</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#birthdayModal"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">شماره کارت جهت مرجوع وجه</div>
                                                        <div class="value" dir="ltr">{{auth()->user()->cart_number}}</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#cardNumberModal"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 profile-field py-2">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="title">رمز عبور</div>
                                                        <div class="value">******</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="#" class="float-left" data-toggle="modal"
                                                           data-target="#passwordModal"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
