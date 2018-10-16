@extends('layouts.app')

@section('content')
    <div class="campaign-detail__donate">
        <div class="container">
            <div class="campaign-detail__section">
                <div class="row">
                    <div class="col-lg-5">
                        @include('withdraw._navigation')
                    </div>
                    <div class="col-lg-7">
                        <div class="withdraw-section">
                            <h2>Say thanks to donors</h2>
                            <h3>need help?<a href="#0">contact us</a></h3>
                            <p>Let's Say Thanks to the Donors</p>
                            @php
                                if ($campaign->testimonial()->exists()){
                                    $route = route('withdraw.leave-tip');
                                }else{
                                    $route = route('withdraw.testimonial');
                                }
                            @endphp
                            <form action="{{ $route }}" method="GET">
                                <div class="withdraw-block">
                                    <input type="text" name="thank_you_title" placeholder="Thank you title">
                                    <textarea rows="6" name="thank_you_text" placeholder="Thank you text"></textarea>
                                    <div class="checkbox-wrapper">
                                        <label class="control control--checkbox" for="check_one">
                                            <input type="checkbox" class="remember-checkbox" name="send_info"
                                                   id="check_one">
                                            Send Donors Location, Date and Time of the Funeral
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                    <div class="thank-button">
                                        @if($campaign->testimonial()->exists())
                                            <button type="submit">Leave a tip</button>
                                        @else
                                            <button type="submit">Next step</button>
                                        @endif
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