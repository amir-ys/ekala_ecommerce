@extends('Dashboard::master')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-sm-12">

            <div class="card overflow-hidden">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center m-b-10">
                        <div class="icon-block icon-block-outline-primary icon-block-floating m-l-20">
                            <i class="ti-user"></i>
                        </div>
                        <h2 class="m-b-0 text-primary font-weight-800 primary-font">{{ number_format($totalUserCount) }}</h2>
                    </div>
                    <p>تعداد کل کاربران</p>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-12">

            <div class="card overflow-hidden">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center m-b-10">
                        <div class="icon-block icon-block-outline-danger icon-block-floating m-l-20">
                            <i class="ti-user"></i>
                        </div>
                        <h2 class="m-b-0 text-danger font-weight-800 primary-font">{{ number_format($getTodayRegisteredUsersCount) }}</h2>
                    </div>
                    <p> کاربران ثبت نام شده امروز</p>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-12">

            <div class="card overflow-hidden">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center m-b-10">
                        <div class="icon-block icon-block-outline-success icon-block-floating m-l-20">
                            <i class="ti-user"></i>
                        </div>
                        <h2 class="m-b-0 text-success font-weight-800 primary-font">{{ number_format($getThisMonthReqisteredUsersCount) }}</h2>
                    </div>
                    <p>تعداد کاربران جدید این ماه  </p>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-12">

            <div class="card overflow-hidden">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center m-b-10">
                        <div class="icon-block icon-block-outline-warning icon-block-floating m-l-20">
                            <i class="ti-server"></i>
                        </div>
                        <h2 class="m-b-0 text-warning font-weight-800 primary-font">{{ number_format($getAdminCount) }}</h2>
                    </div>
                    <p>تعداد مدیران </p>
                </div>
            </div>

        </div>
    </div>

@endsection
