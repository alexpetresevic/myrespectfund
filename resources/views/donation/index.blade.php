@extends('layouts.app')

@section('content')
    <div class="campaign-detail__donate">
        <div class="container">
            <div class="campaign-detail__section">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="donate-overview">
                            @if ($campaign->image()->exists())
                                <img src="{{asset('uploads/campaigns/' . $campaign->image->filename)}}" alt="">
                            @endif
                            <h2>${{ number_format($campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }}
                                <span>of ${{ number_format($campaign->goal, 2, '.', ',') }}</span></h2>
                            <p>amount raised to date</p>
                            <ul class="overview__list">
                                <li>
                                    <p><span>{{ $campaign->donations()->count() }}</span> people have donated</p>
                                </li>
                                {{--<li>--}}
                                    {{--<p>Campaign- live for--}}
                                        {{--<span>{{ $campaign->created_at->diffInDays() }} {{ str_plural('day', $campaign->created_at->diffInDays()) }}</span>--}}
                                    {{--</p>--}}
                                {{--</li>--}}
                            </ul>
                            <ul class="overview__list">
                                <li>
                                    <p>Funeral on <span>{{ date('F dS, Y', strtotime($campaign->funeral_date)) }}</span> at <span>{{ $campaign->funeral_time }}</span></p>
                                </li>
                                @if($campaign->funeralHome()->exists())
                                    <li><p>funeral location: <span>{{ $campaign->funeralHome->name }}</span></p></li>
                                    <div id="map" class="google-map" style="height: 300px"></div>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="donation-section">
                            <h2>your donation</h2>
                            <form action="{{ route('donate.store') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                <div class="donation-block">
                                    <div class="select-radio">
                                        <div class="row">
                                            <div class="col-md-3 radio-box">
                                                <div class="single-radio-box">
                                                    <input type="radio" id="switch_one" name="select_amount" value="200">
                                                    <label for="switch_one">$200</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 radio-box">
                                                <div class="single-radio-box">
                                                    <input type="radio" id="switch_two" name="select_amount" value="100" checked>
                                                    <label for="switch_two">$100</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 radio-box">
                                                <div class="single-radio-box">
                                                    <input type="radio" id="switch_tree" name="select_amount" value="50">
                                                    <label for="switch_tree">$50</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 radio-box">
                                                <div class="single-radio-box">
                                                    <input type="radio" id="switch_four" name="select_amount"
                                                           value="25">
                                                    <label for="switch_four">$25</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-donation">
                                        <input type="number" placeholder="your amount" name="amount" value="100" step="0.01">
                                        <div class="input-currency">$</div>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <p class="donation-headline">Unlike other sites, My Respects Fund is FREE for fundraisers. We rely 100% on donor tips to operate our site.</p>
                                        <h3 class="donation-tip">
                                            Thank you for including a tip of:&nbsp;
                                            <select name="tip_select" class="form-control" style="display: inline-block; width: auto; min-width: 120px">
                                                <option value="20">20% - $20.00</option>
                                                <option value="15" selected>15% - $15.00</option>
                                                <option value="10">10% - $10.00</option>
                                                <option value="other">Other</option>
                                            </select>
                                            
                                            <div class="input-group" id="custom_tip_amount" style="display: none; width: 120px; min-width: 120px">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" step="0.01" name="tip_amount" class="form-control" value="10">
                                            </div>
                                            
                                            <input type="hidden" name="tip" value="0">
                                        </h3>
                                    </div>
                                    
                                    {{--<div class="custom-page-donation">--}}
                                    {{--<input type="number" placeholder="your donation" value="10" name="tip" step="0.01">--}}
                                    {{--<div class="input-currency">$</div>--}}
                                    {{--</div>--}}
                                    <p>WePay Service Fee +2.9% + $0.30</p>
                                    <div class="donate-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="first name" name="first_name">
                                                    @if($errors->has('first_name'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('first_name') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="last name" name="last_name">
                                                    @if($errors->has('last_name'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('last_name') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="country" name="country">
                                                    @if($errors->has('country'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('country') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="zip / postal code" name="postal_code">
                                                    @if($errors->has('postal_code'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('postal_code') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" placeholder="email" name="email">
                                                    @if($errors->has('email'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('email') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea rows="3" placeholder="leave a comment"
                                                              name="comment"></textarea>
                                                    @if($errors->has('comment'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('comment') }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-check">
                                            <div class="checkbox-wrapper">
                                                <label class="control control--checkbox" for="check_one">
                                                    <input type="hidden" name="get_updates" value="0">
                                                    <input type="checkbox" class="remember-checkbox" name="get_updates" id="check_one" value="1">
                                                    Get Campaign Updates to your inbox
                                                    @if($errors->has('get_updates'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('get_updates') }}</p>
                                                        </div>
                                                    @endif
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <div class="checkbox-wrapper">
                                                <label class="control control--checkbox" for="check_two">
                                                    <input type="hidden" name="anonymous" value="0">
                                                    <input type="checkbox" class="remember-checkbox" name="anonymous" id="check_two" value="1">
                                                    Make My Donation Anonymous
                                                    @if($errors->has('anonymous'))
                                                        <div class="error">
                                                            <p>{{ $errors->first('anonymous') }}</p>
                                                        </div>
                                                    @endif
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        {{--<div class="form-check">--}}
                                        {{--<div class="checkbox-wrapper">--}}
                                        {{--<label class="control control--checkbox" for="check_tree">--}}
                                        {{--<input type="hidden" name="create_account" value="0">--}}
                                        {{--<input type="checkbox" class="remember-checkbox" name="create_account" id="check_tree" value="1">--}}
                                        {{--Save information for future donations--}}
                                        {{--@if($errors->has('create_account'))--}}
                                        {{--<div class="error">--}}
                                        {{--<p>{{ $errors->first('create_account') }}</p>--}}
                                        {{--</div>--}}
                                        {{--@endif--}}
                                        {{--<div class="control__indicator"></div>--}}
                                        {{--</label>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="donate-button">
                                            <button type="submit">continue</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('stack-script')
    @if ($campaign->funeralHome()->exists())
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places&callback=initMap">
        </script>
        <script>
            var latitude = {!! $campaign->funeralHome->location->latitude !!};
            var longitude = {!! $campaign->funeralHome->location->longitude !!};
            
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
    <script>
        var $selectDonationAmount = $('input[name="select_amount"]')
        var $tipSelect = $('select[name="tip_select"]')
        var $donationAmount = $('input[name="amount"]')
        
        $(document).ready(function (){
            var tipAmount = $tipSelect.find(':selected').val();
            $('input[name="tip"]').val(tipAmount);
        });
        
        
        $selectDonationAmount.on('click', function (){
            var amount = $(this).val()
            $donationAmount.val(parseInt(amount).toFixed(2))
            
            var tip10, tip15, tip20;
            
            tip10 = (
                (
                    10 / 100
                ) * $donationAmount.val()
            )
            tip15 = (
                (
                    15 / 100
                ) * $donationAmount.val()
            )
            tip20 = (
                (
                    20 / 100
                ) * $donationAmount.val()
            )
            
            $('select[name="tip_select"] option[value="20"]').text('20% - $' + tip20.toFixed(2));
            $('select[name="tip_select"] option[value="15"]').text('15% - $' + tip15.toFixed(2));
            $('select[name="tip_select"] option[value="10"]').text('10% - $' + tip10.toFixed(2));
            
            
            if (!$('#custom_tip_amount').is(":visible")) {
                $('input[name="tip"]').val();
                var oldTipValue = $tipSelect.find(':selected').val();
                $tipSelect.find(':selected').val(tip15);
                var tipAmount = $tipSelect.find(':selected').val();
                $('input[name="tip"]').val(tipAmount);
                $tipSelect.find(':selected').val(oldTipValue);
            }else{
                $('input[name="tip"]').val($('input[name="tip_amount"]').val());
            }
            $('input[name="tip_select"]').trigger('change');
        })
        
        $donationAmount.on('keyup', function (){
            var self = $(this);
            
            tip10 = (
                (
                    10 / 100
                ) * self.val()
            )
            tip15 = (
                (
                    15 / 100
                ) * self.val()
            )
            tip20 = (
                (
                    20 / 100
                ) * self.val()
            )
            
            $('select[name="tip_select"] option[value="20"]').text('20% - $' + tip20.toFixed(2));
            $('select[name="tip_select"] option[value="15"]').text('15% - $' + tip15.toFixed(2));
            $('select[name="tip_select"] option[value="10"]').text('10% - $' + tip10.toFixed(2));
            
            
            if (!$('#custom_tip_amount').is(":visible")) {
                $('input[name="tip"]').val(tip15.toFixed(2));
            }
        })
        
        $('select[name="tip_select"]').on('change', function (){
            var selected = $(this).find(':selected').val();
            
            if (selected === 'other') {
                $('#custom_tip_amount').show();
            }else {
                $('#custom_tip_amount').hide();
                
                var tip = (
                    (
                        selected / 100
                    ) * $donationAmount.val()
                )
                $('input[name="tip"]').val(tip.toFixed(2));
            }
        })
        
        $('input[name="tip_amount"]').on('keyup change', function (){
            $('input[name="tip"]').val($(this).val());
        })
        
        $donationAmount.on('change', function (){
            var self = $(this);
            self.val(parseInt(self.val()).toFixed(2))
        })
    </script>
@endpush
