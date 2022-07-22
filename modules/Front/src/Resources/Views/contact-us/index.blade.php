@extends('Front::master')
@section('content')
    <section class="inner-page" id="contact-page">
        <div class="container-fluid" id="page-hero">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <h1>تماس با ما</h1>
                                <p>با ما در ارتباط باشید.</p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="./index.html">صفحه نخست</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">تماس با ما</li>
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
                    <div class="content p-0 p-sm-3">
                        <div class="row">
                            <div class="col-12 col-lg-5 text-center" id="contact-page-info">
                                <div class="info">
                                    @if($contact ? $contact->json['shop_address'] : null)
                                        <i class="fa fa-map-marked"></i>
                                        <div class="title">آدرس فروشگاه:</div>
                                    @endif
                                    <div> {{ $contact ? $contact->json['shop_address'] : null }} </div>
                                </div>
                                <div class="info">
                                    @if($contact ? $contact->json['phone_number_1'] : null)
                                        <i class="fa fa-phone"></i>
                                        <div class="title">تلفن تماس:</div>
                                    @endif
                                    <div>{{ $contact ? $contact->json['phone_number_1'] : null }}</div>
                                    <div>{{ $contact ? $contact->json['phone_number_2'] : null }}</div>
                                </div>
                                <div class="info">
                                    @if($contact ? $contact->json['email'] : null)
                                        <i class="fa fa-envelope"></i>
                                        <div class="title">پست الکترونیک:</div>
                                    @endif

                                    <div>{{ $contact ? $contact->json['email'] : null }}</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-7 p-4">
                                <form method="post" action="{{ route('panel.settings.contact.saveContactMessage') }}">
                                    @csrf
                                    <div class="title">ارسال پیام</div>
                                    <p>نظرات، پیشنهادات و انتقادات سازنده خود را از طریق فرم زیر با ما در میان بگذارید.
                                        ما در این فروشگاه اینترنتی همواره برای بهبود خدمات خود در تلاش هستیم.</p>
                                    <div class="form-group">
                                        <label for="name">نام شما :</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                                        <x-validation-error field="name"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">تلفن تماس :</label>
                                        <input type="number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="tel"  value="{{ old('phone_number') }}">
                                        <x-validation-error field="phone_number"/>

                                    </div>
                                    <div class="form-group">
                                        <label for="email">پست الکترونیک :</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"  value="{{ old('email') }}">
                                        <x-validation-error field="email"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">موضوع پیام :</label>
                                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject"  value="{{ old('subject') }}">
                                        <x-validation-error field="subject"/>

                                    </div>
                                    <div class="form-group">
                                        <label for="message">متن پیام :</label>
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" rows="3">{{ old('message') }}</textarea>
                                        <x-validation-error field="message"/>

                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="ارسال پیام" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
{{--                            <div class="col-12 mt-4 px-0">--}}
{{--                                <iframe--}}
{{--                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13877.455761926274!2d52.5714962!3d29.5931048!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcc3a67871fb07f53!2z2YjYqCDYsdmI2KjbjNqpIC0gV2ViUnViaWs!5e0!3m2!1sen!2sca!4v1600581121318!5m2!1sen!2sca"--}}
{{--                                    width="100%" height="400" class="rounded"></iframe>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
