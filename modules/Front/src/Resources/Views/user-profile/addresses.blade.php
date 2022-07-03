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
                                        <li class="breadcrumb-item active" aria-current="page">آدرس های من</li>
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
                                <!-- New Address Form -->
                                <div class="custom-container mb-2" id="new-address">
                                    <div class="row pt-2 px-3">
                                        <div class="col-12"><h1>افزودن آدرس جدید</h1></div>
                                    </div>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 pt-3">
                                                <div class="row">
                                                    <div class="col-12 col-md-4 pl-2">
                                                        <div class="form-group m-1">
                                                            <label for="province">استان:</label>
                                                            <select name="province" id="province" class="form-control">
                                                                <option value="tehran">تهران</option>
                                                                <option value="fars">فارس</option>
                                                                <option value="esfehan">اصفهان</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 pl-2">
                                                        <div class="form-group m-1">
                                                            <label for="city">استان:</label>
                                                            <select name="city" id="city" class="form-control">
                                                                <option value="tehran">تهران</option>
                                                                <option value="shiraz">شیراز</option>
                                                                <option value="esfehan">اصفهان</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-8 pl-2">
                                                        <div class="form-group m-1">
                                                            <label for="address">نشانی کامل:</label>
                                                            <input type="text" name="address" id="address"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 pl-2">
                                                        <div class="form-group m-1">
                                                            <label for="postal_code">کد پستی:</label>
                                                            <input type="text" name="postal_code" id="postal_code"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 pl-2">
                                                        <div class="form-group m-1">
                                                            <label for="receiver">تحویل گیرنده:</label>
                                                            <input type="text" name="receiver" id="receiver"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 pl-2">
                                                        <div class="form-group m-1">
                                                            <label for="tel">تلفن تماس:</label>
                                                            <input type="text" name="tel" id="tel" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group m-1 pb-3">
                                                            <input type="submit" class="btn btn-primary px-5"
                                                                   value="ذخیره آدرس">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /New Address Form -->

                                <!-- User Addresses -->
                                <div class="custom-container" id="addresses">
                                    <div class="row pt-2 px-3">
                                        <div class="col-12"><h1>آدرس های من</h1></div>
                                    </div>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <!-- Address Record -->
                                            <div class="col-12 address py-2">
                                                <div class="row">
                                                    <div class="col-12 col-sm-10">
                                                        <div class="title">تهران، بلوار ولی عصر</div>
                                                        <div class="sub-title">تهران، تهران</div>
                                                        <div class="sub-title">1234567890</div>
                                                        <div class="sub-title">امید کریمی</div>
                                                        <div class="sub-title">02112345678</div>
                                                    </div>
                                                    <div class="col-12 col-sm-2 text-lg-end">
                                                        <a href="#"
                                                           onclick="return confirm('آیا جهت حذف این آدرس اطمینان دارید؟')"
                                                           class="float-right float-sm-left pr-2 pl-sm-2"><i
                                                                class="fa fa-trash-alt font-weight-normal"></i></a>
                                                        <a href="#" class="float-right float-sm-left"><i
                                                                class="fa fa-edit font-weight-normal"></i></a>
                                                        <a href="#" class="float-right float-sm-left ml-2"
                                                           title="آدرس پیش فرض"><i class="fa fa-check-circle"
                                                                                   style="color: #fcb941"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Address Record -->
                                            <!-- Address Record -->
                                            <div class="col-12 address py-2">
                                                <div class="row">
                                                    <div class="col-12 col-sm-10">
                                                        <div class="title">تهران، بلوار ولی عصر</div>
                                                        <div class="sub-title">تهران، تهران</div>
                                                        <div class="sub-title">1234567890</div>
                                                        <div class="sub-title">امید کریمی</div>
                                                        <div class="sub-title">02112345678</div>
                                                    </div>
                                                    <div class="col-12 col-sm-2 text-lg-end">
                                                        <a href="#"
                                                           onclick="return confirm('آیا جهت حذف این آدرس اطمینان دارید؟')"
                                                           class="float-right float-sm-left pr-2 pl-sm-2"><i
                                                                class="fa fa-trash-alt font-weight-normal"></i></a>
                                                        <a href="#" class="float-right float-sm-left"><i
                                                                class="fa fa-edit font-weight-normal"></i></a>
                                                        <a href="#" class="float-right float-sm-left ml-2"
                                                           title="آدرس پیش فرض"><i class="fa fa-circle-notch"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Address Record -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /User Addresses -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
