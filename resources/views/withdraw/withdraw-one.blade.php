@extends('layouts.app')

@section('content')
    <div id="campaign-withdraw" class="campaign-detail__donate">
        <div class="container">
            <div class="campaign-detail__section">
                <div class="row">
                    <div class="col-lg-5">
                        @include('withdraw._navigation')
                    </div>
                    <div class="col-lg-7">
                        <div class="withdraw-section">
                            <h2>withdrawal verification</h2>
                            <h3>need help?<a href="#0">contact us</a></h3>
                            <div class="withdraw-block">
                                <div class="withdraw-block__header">
                                    <h3>withdraw funds</h3>
                                    <p>${{ number_format($campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }} raised</p>
                                </div>
                                <div id="withdrawal_div"></div>
                                <div class="withdraw-main__section">
                                    <div class="submit-button">
                                        <button id="next-step">next step</button>
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
    <script>
        $(document).ready(function (){
            $('#next-step').on('click', function (e){
                e.preventDefault();
                $.ajax({
                    type: 'GET', url: '{!! route('withdraw.funds') !!}', success: function (response){
                        if (response.donation[0].length === 0) {
                            siteMessage('You don\'t have any donations to withdraw', '#footer', 'error');
                        }else {
                            location.href = "{!! route('withdraw.two') !!}";
                        }
                    }, error: function (response){
                        if (response.responseJSON.error != null) {
                            siteMessage(response.responseJSON.error, '#footer', 'error');
                        }else {
                            siteMessage('There was an error while trying to withdraw. Please try later', '#footer', 'error');
                        }
                    }
                });
            });
        });
        
        $(document).ajaxStart(function (){
            $('#campaign-withdraw').css('display', 'none');
            $('#pending').css('display', 'block');
        });
        
        $(document).ajaxStop(function (){
            $('#campaign-withdraw').css('display', 'block');
            $('#pending').css('display', 'none');
        });
    </script>
@endsection
