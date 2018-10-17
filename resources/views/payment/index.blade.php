@extends('layouts.app')

@section('content')
    <div  id="myrepects-donate"  class="campaign-detail__donate">
        <div class="container">
            <div class="campaign-detail__section">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="donate-overview">
                            @if($donation->campaign->image)
                                <img src="{{asset('/uploads/campaigns/' . $donation->campaign->image->filename)}}" alt="">
                            @else
                                <img src="{{asset('/img/bg_hero.png')}}" alt="">
                            @endif
                            <h2>${{ number_format($donation->campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }} <span>of ${{ number_format($donation->campaign->goal, 2, ',', '.') }}</span></h2>
                            <p>amount raised to date</p>
                            <ul class="overview__list">
                                <li>
                                    <p>Funeral on <span>{{ date('F dS, Y', strtotime($donation->campaign->funeral_date)) }}</span> at <span>{{ $donation->campaign->funeral_time }}</span></p>
                                </li>
                                @if($donation->campaign->funeralHome()->exists())
                                    <li>funeral location:<span>{{ $donation->campaign->funeralHome->name }}</span></li>
                                    <div id="map" class="google-map" style="height: 300px"></div>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @php
                        if (empty($tip)){
                            $tipAmount = empty($tip) ? 0 : number_format($tip->amount, 2, '.', ',');
                            $tipId = '';
                        }else{
                            $tipAmount = $tip->amount;
                            $tipId = $tip->id;
                        }
                    @endphp
                    <div class="col-lg-7">
                        <div class="donate-confirm">
                            <h2>Your Donation: <span>${{ number_format($donation->amount, 2, '.', ',') }}</span></h2>
                            <h2>Tip to MyRespects: <span>${{ $tipAmount }}</span></h2>
                            <h2>WePay Services: <span>${{ number_format(($donation->amount + $tipAmount) * 0.029 + 0.30, 2, '.', ',') }}</span></h2>
                            <h2 class="payment-total">Total: <span>${{  number_format(($donation->amount + $tipAmount) * 1.029 + 0.30 , 2, '.', ',') }}</span></h2>
                            <p>+2.9% + $0.30 WePay Service Fee</p>
                        </div>
                        <div class="donation-section">
                            <h2>Credit Card Information</h2>
                            <div class="donation-block">
                                <div class="donate-form">
                                    <form action="{{ route('payment.store', ['donation' => $donation->id, 'tip' => $tipId]) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" id="name" name="name" placeholder="name" value="{{ old('name') }}">
                                                    @if($errors->has('name'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('name') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                                                    @if($errors->has('email'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('email') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="number" id="cc_number" name="card_number" placeholder="card number" value="{{ old('card_number') }}">
                                                    @if($errors->has('card_number'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('card_number') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="cc_month" name="cc_month" placeholder="mm" value="{{ old('cc_month') }}">
                                                    @if($errors->has('cc_month'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('cc_month') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="cc_year" name="cc_year" placeholder="yyyy" value="{{ old('cc_year') }}">
                                                    @if($errors->has('cc_year'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('cc_year') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" id="cc_cvv" name="cvv" placeholder="CVV" value="{{ old('cvv') }}">
                                                    @if($errors->has('cvv'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('cvv') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" type="text" id="country" name="country" placeholder="country">
                                                        <option value="US">United States</option>
                                                        <option value="CA">Canada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="postal_code" id="postal_code" placeholder="zip/postal code" value="{{ old('postal_code') }}">
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
                            <div class="pending-text__wrap">
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
    @if ($donation->campaign->funeralHome()->exists())
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places&callback=initMap">
        </script>
        <script>
            var latitude = {!! $donation->campaign->funeralHome->location->latitude !!};
            var longitude = {!! $donation->campaign->funeralHome->location->longitude !!};
            
            function initMap()
            {
                var myLatlng = new google.maps.LatLng(latitude, longitude);
                
                var myOptions = {
                    zoom: 15, center: myLatlng, mapTypeId: google.maps.MapTypeId.ROADMAP,
                };
                
                map = new google.maps.Map(document.getElementById("map"), myOptions);
                
                var marker = new google.maps.Marker({
                    position: myLatlng,
                });
                marker.setMap(map);
            }
        </script>
    @endif
    <script type="text/javascript" src="https://static.wepay.com/min/js/tokenization.3.latest.js"></script>
    <script type="text/javascript">
        (
            function (){
                WePay.set_endpoint("stage"); // change to "production" when live
                // Shortcuts
                var d = document;
                d.id = d.getElementById, valueById = function (id){
                    return d.id(id).value;
                };
                // For those not using DOM libraries
                var addEvent = function (e, v, f){
                    if (!!window.attachEvent) {
                        e.attachEvent('on' + v, f);
                    }else {
                        e.addEventListener(v, f, false);
                    }
                };
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // Attach the event to the DOM
                addEvent(d.id('cc-submit'), 'click', function (){
                    //show animation
                    var error = false;

                    $('#myrepects-donate').css('display', 'none');
                    $('#pending').css('display', 'block');

                   
                    $('.error').remove();
                    var inputIdlist = {
                        name: 'Name is required', email: 'Email is required', cc_number: 'Credit Card number is required', cc_cvv: 'CVV is required', cc_month: 'Month is required', cc_year: 'Year is required', postal_code: 'Postal Code is required'
                    };
                    
                    $.each(inputIdlist, function (i, val){
                        if ($('#' + i).val() == '') {
                            error  = true;
                            $('#' + i).after('<div class="error"><p>' + val + '</p></div>');
                        }
                    });

                    if(error){
                        $('#myrepects-donate').css('display', 'block');
                        $('#pending').css('display', 'none');
                    }
                    //front end errors


                    var userName = [valueById('name')].join(' ');
                    response = WePay.credit_card.create({
                        "client_id": "{!! env('WEPAY_CLIENT_ID') !!}",
                        "user_name": $('#name').val(),
                        "email": $('#email').val(),
                        "cc_number": $('#cc_number').val(),
                        "cvv": $('#cc_cvv').val(),
                        "expiration_month": $('#cc_month').val(),
                        "expiration_year": $('#cc_year').val(),
                        "address": {
                            "postal_code": $('#postal_code').val(),
                            "country": $('#country').find(':selected').val()
                        }

                    }, 

                    function (data){
                        if (data.error) {
                            
                            $('#myrepects-donate').css('display', 'block');
                        $('#pending').css('display', 'none');
                            siteMessage(data.error_description, '#footer', 'error');
                            //                            $('#cc-submit').attr('disabled', false);
                            // handle error response
                        }else {
                            $.ajax({
                                type: 'POST', url: '{!! route('payment.store', ['donation' => $donation->id, 'tip' => $tipId]) !!}', data: {
                                    _token: CSRF_TOKEN, creditCardId: data.credit_card_id
                                }, success: function (response){
                                    if (response.error) {
                                        $('#myrepects-donate').css('display', 'block');
                                        $('#pending').css('display', 'none');
                                        siteMessage(response.error, '#footer', 'error');
                                    }else {
                                        $('#myrepects-donate').css('display', 'block');
                                        $('#pending').css('display', 'none');
                                        location.href = "{!! route('payment.success', ['donation' => encrypt($donation->id)]) !!}"
                                    }
                                },
                                error: function (error) {
                                        $('#myrepects-donate').css('display', 'block');
                                        $('#pending').css('display', 'none');                                    
                                        siteMessage(error.responseJSON.message, '#footer', 'error');
                                }                                
                            });
                        }
                    });
                });
            }
        )();
    </script>
@endsection
