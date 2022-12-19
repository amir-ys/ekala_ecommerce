@extends('Front::master')
@section('content')

    <section class="inner-page" id="contact-page">
        <div class="container py-2 py-md-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1">
                    <div class="content">
                        <div class="row">
                            <div class="col-12 col-lg-5 text-center">
                                <img src="/assets/front/assets/images/login.png" alt="">
                            </div>
                            <div class="col-12 col-lg-7 pt-5 pt-md-0 align-self-center">
                                <div class="row">
                                    <div class="col-md-10">
                                        @if(session()->has('message'))
                                            <div class="alert alert-warning">
                                        <span style="font-size: 14px">
                                            {{ session()->get('message') }}
                                        </span>
                                            </div>
                                        @endif

                                        @if(session()->has('success'))
                                            <div class="alert alert-success">
                                        <span style="font-size: 14px">
                                            {{ session()->get('success') }}
                                        </span>
                                            </div>
                                        @endif

                                        <div class="card">
                                            <div class="card-body border border-secondary">
                                                <div class="title">تایید حساب کاربری</div>
                                                <p>
                                                    کد تایید به ایمیل شما ارسال شد
                                                </p>

                                                <a type="submit" class="text-black-50 hover-state" href="/"
                                                   onclick="event.preventDefault();document.getElementById('verification_send_form').submit()">
                                                    ارسال مجدد لینک تایید</a>

                                                <form action="{{ route('verification.resend') }}" method="post"
                                                      id="verification_send_form">
                                                    @csrf
                                                </form>

                                                <div class="row">
                                                    <form action="{{ route('verification.verify') }}" method="post">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="code">کد فعال
                                                                    سازی</label>
                                                                <input dir="rtl" type="number"
                                                                       class="activation-code-input"
                                                                       name="code"
                                                                       id="code">
                                                            </div>
                                                            <x-validation-error field="code"/>
                                                        </div>
                                                        <div class="col-md-6"></div>

                                                        <div class="col-md-12 mt-md-3">
                                                            <button type="submit" class="btn btn-primary">تایید</button>
                                                        </div>

                                                    </form>

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
@section('css')
    <style>
        .activation-code-input {
            width: 100%;
        }

        .activation-code-title {
            font-size: 13px;
            color: #6b7074;
            margin-bottom: 10px;
            text-align: center;
            margin-top: 15px;
            padding: 0 40px;
        }

        .activation-code-title span {
            color: #000000;
        }

        .activation-code-input {
            display: none;
        }

        .activation-code {
            direction: ltr;
            position: relative;
        }

        .activation-code::before {
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            border-bottom: 2px solid;
            border-color: #ccc;
            transition: opacity 0.3s ease;
        }

        .activation-code > span {
            position: absolute;
            display: block;
            font-size: 13px;
            color: #ccc;
            top: 0;
            right: 0;
            transition: all 0.3s ease;
        }

        .activation-code .activation-code-inputs {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
        }

        .activation-code .activation-code-inputs input {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-flow: column nowrap;
            flex-flow: column nowrap;
            padding: 0;
            border: 0;
            outline: 0;
            min-width: 0;
            line-height: 36px;
            text-align: center;
            align-items: center;
            transition: all 0.3s ease;
            border-bottom: 2px solid;
            border-color: #ccc;
            margin-right: 8px;
            background: white !important;
            opacity: 0;
        }

        .activation-code .activation-code-inputs input:last-child {
            margin-right: 0;
        }

        .activation-code.active::before {
            opacity: 0;
        }

        .activation-code.active .activation-code-inputs input {
            opacity: 1 !important;
        }

        .activation-code .activation-code-inputs input:focus {
            border-color: #46b2f0 !important;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.activation-code-input').activationCodeInput({
                number: 6
            })
        })

        function inputFilter(e) {
            var key = e.keyCode || e.which;

            if (!e.shiftKey && !e.altKey && !e.ctrlKey && key >= 48 && key <= 57 || key >= 96 && key <= 105 || key == 8 || key == 9 || key == 13 || key == 37 || key == 39) {
            } else {
                return false;
            }
        }

        jQuery.fn.activationCodeInput = function (options) {

            var defaults = {
                number: 4,
                length: 1
            }
            var settings = $.extend({}, defaults, options);
            // $('#log').append('options = ' + JSON.stringify(options));
            // $('#log1').append('defaults = ' + JSON.stringify(defaults));
            // $('#log2').append('settings = ' + JSON.stringify(settings));

            return this.each(function () {
                var self = $(this);
                var activationCode = $('<div />').addClass('activation-code');
                var placeHolder = self.attr('placeholder');
                // alert(placeHolder);
                activationCode.append($('<span />').text(placeHolder));
                self.replaceWith(activationCode);
                activationCode.append(self);

                var activationCodeInputs = $('<div />').addClass('activation-code-inputs');

                for (var i = 1; i <= settings.number; i++) {
                    activationCodeInputs.append($('<input />').attr({
                        maxLength: settings.length,
                        onkeydown: 'return inputFilter(event)',
                        oncopy: 'return false',
                        onpaste: 'return false',
                        oncut: 'return false',
                        ondrag: 'return false',
                        ondrop: 'return false',
                    }))
                }

                activationCode.prepend(activationCodeInputs);

                activationCode.on('click touchstart', function (event) {
                    // console.log(event);
                    // console.log(event.type);
                    if (!activationCode.hasClass('active')) {
                        activationCode.addClass('active');
                        setTimeout(function () {
                            activationCode.find('.activation-code-inputs input:first-child').focus();
                        }, 200)
                    }
                })

                activationCode.find('.activation-code-inputs').on('keyup input', 'input', function (event) {
                    // $(this).css('background','red');
                    if ($(this).val().toString().length == settings.length || event.keyCode == 39) {
                        $(this).next().focus();
                        if ($(this).val().toString().length) {
                            $(this).css('border-color', '#46b2f0');
                        }
                    }
                    if (event.keyCode == 8 || event.keyCode == 37) {
                        $(this).prev().focus();
                        if (!$(this).val().toString().length) {
                            $(this).css('border-color', '#ccc');
                        }
                    }
                    var value = '';
                    activationCode.find('.activation-code-inputs input').each(function () {
                        // value = value + $(this).val().toString();
                        value += $(this).val().toString();
                    })
                    self.attr({
                        value: value,
                    })
                })

                $(document).on('click touchstart', function (e) {
                    console.log(e.target);
                    console.log($(e.target).parent());
                    console.log($(e.target).parent().parent());
                    // false true = false
                    // true false = false
                    // false false = false
                    //true true = true
                    if (!$(e.target).parent().is(activationCode) && !$(e.target).is(activationCode) && !$(e.target).parent().parent().is(activationCode)) {
                        var hide = true;

                        activationCode.find('.activation-code-inputs input').each(function () {
                            if ($(this).val().toString().length) {
                                hide = false;
                            }
                        })
                        if (hide) {
                            activationCode.removeClass('active');
                        } else {
                            activationCode.addClass('active');
                        }
                    }
                })


            })

        }
    </script>
@endsection
