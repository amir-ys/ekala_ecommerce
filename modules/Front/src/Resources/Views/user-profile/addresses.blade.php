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
                                        <li class="breadcrumb-item"><a href="/">صفحه نخست</a></li>
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
                                        <form action="{{ route('panel.users.address.store') }}" method="post"
                                              id="address-su-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 pt-3">
                                                    <div class="row">
                                                        <div id="hidden_div">

                                                        </div>
                                                        <div class="col-12 col-md-4 pl-2">
                                                            <div class="form-group m-1">
                                                                <label for="province">استان:</label>
                                                                <select name="province_id" id="province_id"
                                                                        class="form-control">
                                                                    <option value> یک استان را انتخاب کنید</option>
                                                                    @foreach($provinces as $province)
                                                                        <option
                                                                            value="{{ $province->id }}">{{ $province->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <x-validation-error field="province_id" bag="store"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4 pl-2">
                                                            <div class="form-group m-1">
                                                                <label for="city">شهر:</label>
                                                                <select name="city_id" id="city_id"
                                                                        class="form-control">
                                                                    <option value> یک شهر را انتخاب کنید</option>
                                                                </select>
                                                            </div>
                                                            <x-validation-error field="city_id"/>
                                                        </div>
                                                        <div class="col-12 col-md-8 pl-2">
                                                            <div class="form-group m-1">
                                                                <label for="address">نشانی کامل:</label>
                                                                <input type="text" name="address" id="address"
                                                                       class="form-control">
                                                            </div>
                                                            <x-validation-error field="address"/>
                                                        </div>
                                                        <div class="col-12 col-md-4 pl-2">
                                                            <div class="form-group m-1">
                                                                <label for="postal_code">کد پستی:</label>
                                                                <input type="text" name="postal_code" id="postal_code"
                                                                       class="form-control">
                                                            </div>
                                                            <x-validation-error field="postal_code"/>
                                                        </div>
                                                        <div class="col-12 col-md-4 pl-2">
                                                            <div class="form-group m-1">
                                                                <label for="receiver">تحویل گیرنده:</label>
                                                                <input type="text" name="receiver" id="receiver"
                                                                       class="form-control">
                                                            </div>
                                                            <x-validation-error field="receiver"/>
                                                        </div>
                                                        <div class="col-12 col-md-4 pl-2">
                                                            <div class="form-group m-1">
                                                                <label for="tel">تلفن تماس:</label>
                                                                <input type="text" name="phone_number" id="tel"
                                                                       class="form-control">
                                                            </div>
                                                            <x-validation-error field="phone_number"/>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group m-1 pb-3">
                                                                <input type="submit" class="btn btn-primary px-5"
                                                                       id="submit_btn"
                                                                       value="ذخیره آدرس">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
                                            @if(count($addresses) > 0)
                                                @foreach($addresses as $address)
                                                    <div class="col-12 address py-2">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-10">
                                                                <div
                                                                    class="title">{{ $address->province->name  . ',' .  $address->city->name  }}</div>
                                                                <div class="sub-title">
                                                                    آدرس: {{ $address->address }}</div>
                                                                <div class="sub-title"> نام تحویل
                                                                    گیرنده: {{ $address->receiver }}</div>
                                                                <div class="sub-title"> شماره تحویل
                                                                    گیرنده: {{ $address->phone_number }}</div>
                                                                <div class="sub-title">
                                                                    کدپستی: {{ $address->postal_code }}</div>
                                                            </div>
                                                            <div class="col-12 col-sm-2 text-lg-end">
                                                                <a href="#"
                                                                   onclick="deleteItem(event , '{{  route('panel.users.address.destroy' , $address->id) }}'  ,'آدرس')"
                                                                   class="float-right float-sm-left pr-2 pl-sm-2"><i
                                                                        class="fa fa-trash-alt font-weight-normal"></i>
                                                                </a>


                                                                @if($address->is_active == \Modules\User\Models\UserAddress::STATUS_ACTIVE)
                                                                    <a href="#" class="float-right float-sm-left ml-2"
                                                                       title="آدرس پیش فرض"><i
                                                                            class="fa fa-check-circle"
                                                                            style="color: #fcb941"></i></a>
                                                                @elseif($address->is_active == \Modules\User\Models\UserAddress::STATUS_INACTIVE)
                                                                    <a href="{{  route('panel.users.address.changeStatus' , $address->id) }}"
                                                                       class="float-right float-sm-left ml-2"
                                                                       title="آدرس پیش فرض"><i class="fa fa-circle"
                                                                                               style="color: #fcb941"></i></a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="card mt-md-3 mb-md-3">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <h5 class="text-center mt-md-5 mb-md-4">
                                                                شما هنوز آدرسی وارد نکرده اید.
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
@section('script')
    <script>
        $(document).ready(function () {
            $('#province_id').change(function () {
                var province_id = $('#province_id :selected').val()
                var url = '{{ route('panel.users.findCityByProvince') }}'
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {province_id: province_id},
                    success: function (response) {
                        $('#city_id').empty()
                        response.data.map((city) => {
                            $('#city_id').append($('<option/>').val(city.id).text(city.name))
                        })
                    }
                })
            })
        })
    </script>

    <script>

        function updateItem(event, findUpdateUrl, updateUrl) {
            event.preventDefault();
            $.ajax({
                url: findUpdateUrl,
                type: 'get',
                success: function (response) {
                    $('#hidden_div').html('<input type="hidden" name="address_id" value="' + response.data.id + '" >')
                    $('#submit_btn').val('بروزرسانی آدرس')
                    $('input[name="address"]').val(response.data.address)
                    $('input[name="receiver"]').val(response.data.receiver)
                    $('input[name="postal_code"]').val(response.data.postal_code)
                    $('input[name="phone_number"]').val(response.data.phone_number)
                    $('#address-su-form').attr('action', updateUrl)
                },
                error: function () {

                }
            })
        }

    </script>
@endsection
