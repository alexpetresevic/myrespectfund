@extends('layouts.app')

@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="campaign_dashboard__block">
                <div class="row">

                    @include('campaign.dashboard._header')
                    @include('campaign.dashboard._navigation')

                    <div class="col-lg-7">
                        <div class="dash-tool__section">
                            <h5>Who Donated</h5>
                            <div class="single-donor">
                                @foreach($campaign->allApprovedDonations as $donation)
                                    <ul class="donor-list">
                                        <li><p>{{ $donation->anonymous ? 'Anonymous' : $donation->first_name . ' ' . $donation->last_name }}</p></li>
                                        <li>$ <p> {{ number_format($donation->amount, 2, '.', ',') }}</p></li>
                                        <li><p>{{ $donation->created_at->diffForHumans() }}</p></li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
