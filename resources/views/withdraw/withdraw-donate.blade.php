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
                        <div class="donation-section">
                            <h2>your tip</h2>
                            <form action="{{ route('donate.leave-tip') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                <div class="donation-block">
                                    <p class="donation-headline">Unlike other sites, MyRespects is FREE for fundraisers.
                                        We rely 100% on donor tips to operate our site.</p>
                                    <h3 class="donation-tip">Thank you for including a tip of:</h3>
                                    <div class="custom-page-tip">
                                        <input type="number" placeholder="your donation" value="10" name="tip"
                                               step="0.01">
                                        <div class="input-currency">$</div>
                                        @if($errors->has('tip'))
                                            <div class="error">
                                                <p>{{ $errors->first('tip') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tip-info">
                                        <p>WePay Service Fee +2.9% + $0.30</p>
                                    </div>
                                    <div class="donate-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="first name" name="first_name"
                                                           value="{{ $campaign->user->first_name }}">
                                                </div>
                                                @if($errors->has('first'))
                                                    <div class="error">
                                                        <p>{{ $errors->first('first') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="last name" name="last_name"
                                                           value="{{ $campaign->user->last_name }}">
                                                </div>
                                                @if($errors->has('last'))
                                                    <div class="error">
                                                        <p>{{ $errors->first('last') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="country" name="country">
                                                </div>
                                                @if($errors->has('country'))
                                                    <div class="error">
                                                        <p>{{ $errors->first('country') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="zip / postal code"
                                                           name="postal_code">
                                                </div>
                                                @if($errors->has('postal_code'))
                                                    <div class="error">
                                                        <p>{{ $errors->first('postal_code') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" placeholder="email" name="email"
                                                           value="{{ $campaign->user->email }}">
                                                </div>
                                                @if($errors->has('name'))
                                                    <div class="error">
                                                        <p>{{ $errors->first('email') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea rows="3" placeholder="leave a comment"
                                                              name="comment"></textarea>
                                                </div>
                                                @if($errors->has('comment'))
                                                    <div class="error">
                                                        <p>{{ $errors->first('comment') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="donate-button">
                                            <a href="{{ route('campaign.dashboard') }}">no</a>
                                            <button type="submit">leave a tip</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
