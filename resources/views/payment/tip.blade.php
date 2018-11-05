@extends('layouts.app')

@section('content')
    <div id="myrepects-tips" class="campaign-detail__donate">
        <div class="container">
            <div class="campaign-detail__section">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="donate-confirm">
                            <h2>Tip to MyRespects: <span>${{ $donation->amount }}</span></h2>
                            <h2>WePay Services:
                                <span>${{ number_format(($donation->amount) * 0.029 + 0.30, 2, '.', ',') }}</span></h2>
                            <h2 class="payment-total">Total:
                                <span>${{  number_format(($donation->amount) * 1.029 + 0.30 , 2, '.', ',') }}</span>
                            </h2>
                            <p>+2.9% + $0.30 WePay Service Fee</p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="donation-section">
                            <h2>Credit Card Information</h2>
                            <div class="donation-block">
                                <div class="donate-form">
                                    <form action="{{ route('payment.store', ['donation' => $donation->id]) }}"
                                          method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" id="name" name="name" placeholder="name"
                                                           value="{{ old('name') }}">
                                                    @if($errors->has('name'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('name') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" id="email" name="email" placeholder="email"
                                                           value="{{ old('email') }}">
                                                    @if($errors->has('email'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('email') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="number" id="cc-number" name="card_number"
                                                           placeholder="card number" value="{{ old('card_number') }}">
                                                    @if($errors->has('card_number'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('card_number') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="cc-month" name="cc_month" placeholder="mm"
                                                           value="{{ old('cc_month') }}">
                                                    @if($errors->has('cc_month'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('cc_month') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="cc-year" name="cc_year" placeholder="yyyy"
                                                           value="{{ old('cc_year') }}">
                                                    @if($errors->has('cc_year'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('cc_year') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="cc-cvv" name="cvv" placeholder="CVV"
                                                           value="{{ old('cvv') }}">
                                                    @if($errors->has('cvv'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('cvv') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="country" placeholder="country"
                                                           value="{{ old('country') }}">
                                                    @if($errors->has('country'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('country') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="postal_code" id="postal_code"
                                                           placeholder="zip/postal code"
                                                           value="{{ old('postal_code') }}">
                                                    @if($errors->has('postal_code'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('postal_code') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="donate-button">
                                            <button id="cc-submit" type="button">continue</button>
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
    <div id="pending" class="pending-wrapper" style="display: none">
        <div class="container">
            <div class="pending__section">
                <div class="pending-block">
                    <div class="col">
                        <div class="pending-payment">
                            <div class="pending">
                                <div class="loading">
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                </div>
                            </div>
                            <div>
                                <div class="pending-text">
                                    <h2 class="saving">payment pending<span>.</span><span>.</span><span>.</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://static.wepay.com/min/js/tokenization.3.latest.js"></script>
    <script>
        (
            function () {
                WePay.set_endpoint("stage"); // change to "production" when live
                // Shortcuts
                var d = document;
                d.id = d.getElementById, valueById = function (id) {
                    return d.id(id).value;
                };
                // For those not using DOM libraries
                var addEvent = function (e, v, f) {
                    if (!!window.attachEvent) {
                        e.attachEvent('on' + v, f);
                    } else {
                        e.addEventListener(v, f, false);
                    }
                };
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // Attach the event to the DOM
                addEvent(d.id('cc-submit'), 'click', function () {
                    var userName = [valueById('name')].join(' ');
                    response = WePay.credit_card.create({
                        "client_id": '{!! env('WEPAY_CLIENT_ID') !!}',
                        "user_name": $('#name').val(),
                        "email": $('#email').val(),
                        "cc_number": $('#cc-number').val(),
                        "cvv": $('#cc-cvv').val(),
                        "expiration_month": $('#cc-month').val(),
                        "expiration_year": $('#cc-year').val(),
                        "address": {
                            "postal_code": $('#postal_code').val()
                        }
                    }, function (data) {
                        if (data.error) {
                            siteMessage(data.error_description, '#footer', 'error');
                            $('#cc-submit').attr('disabled', false);
                            // handle error response
                        } else {
                            $.ajax({
                                type: 'POST', url: '{!! route('payment.store-tip', ['donation' => $donation->id]) !!}',
                                data: {
                                    _token: CSRF_TOKEN,
                                    creditCardId: data.credit_card_id
                                }, success: function (response) {
                                    if (response.error) {
                                        siteMessage(response.error, '#footer', 'error');
                                    } else {
                                        location.href = "{!! route('payment.success-tip', ['donation' => encrypt($donation->id)]) !!}"
                                    }
                                }, error: function (response) {
                                    console.log(response);
                                }
                            });
                        }
                    });
                });
            }
        )();

        $(document).ajaxStart(function () {
            $('#myrepects-tips').css('display', 'none');
            $('#pending').css('display', 'block');
        });

        $(document).ajaxStop(function () {
            $('#myrepects-tips').css('display', 'block');
            $('#pending').css('display', 'none');
        });
    </script>
@endsection
