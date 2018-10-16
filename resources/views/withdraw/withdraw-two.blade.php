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
                            <h2>Withdraw </h2>
                            <h3>need help?<a href="#0">contact us</a></h3>
                            <div class="withdraw-thank-block">
                                <p>Fund have been withdrawn to your account</p>
                                <div class="thank-button">
                                    <a href="{{ route('withdraw.three') }}">Say thanks to donors</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection