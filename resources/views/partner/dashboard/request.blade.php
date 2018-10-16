@extends('layouts.app')

@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="campaign_dashboard__block">
                <div class="row">
                    @include('partner.dashboard._header')
                    @include('partner.dashboard._navigation')
                    <div class="col-lg-7">
                        <form action="{{ route('partner.send-request') }}" method="GET">
                            <h1>Request {{ $req }}</h1>
                            <div class="dash-call__block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="call-date">Call date</label>
                                        <input id="call-date" class="fundraiser-date" name="call_date" type="text">
                                        @if($errors->has('call_date'))
                                            <div class="error">
                                                <p>{{ $errors->first('call_date') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="call-time">Call time</label>
                                        <input id="call-time" class="timepicker" name="call_time" type="text"/>
                                        @if($errors->has('call_time'))
                                            <div class="error">
                                                <p>{{ $errors->first('call_time') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $req }}" name="req">
                            <div class="next-button">
                                <button type="submit">Send request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stack-script')
    <script>
        $("#call-date").datepicker();
        $("#call-time").timepicker();
    </script>
@endpush
