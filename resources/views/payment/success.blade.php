@extends('layouts.app')

@section('content')
    <div class="campaign-detail__donate">
        <div class="container">
            <div class="campaign-detail__section">
                <h1>thank you - you donated ${{ number_format($donation->amount, 2, '.', ',') }}</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="donate-img">
                            @if($donation->campaign->image)
                                <img src="{{asset('/uploads/campaigns/' . $donation->campaign->image->filename)}}" alt="">
                            @else
                                <img src="{{asset('/img/bg_hero.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="donate-share">
                            <h1>{{ $donation->campaign->title }}</h1>
                            <p><span>new</span> amount raised to date</p>
                            <h2>${{ number_format($donation->campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }} <span>of ${{ number_format($donation->campaign->goal, 2, ',', '.') }}</span></h2>
                            {{--<p>share on:</p>--}}
                            {{--<ul class="detail-share__links">--}}
                                {{--<ul class="detail-share__links">--}}
                                    {{--<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('campaign.show', ['slug' => $donation->campaign->slug]) }}" class="fb-share"><i class="fab fa-facebook-square"></i></a></li>--}}
                                    {{--<li><a target="_blank" href="https://twitter.com/home?status={{ route('campaign.show', ['slug' => $donation->campaign->slug]) }}" class="tw-share"><i class="fab fa-twitter-square"></i></a></li>--}}
                                    {{--<li><a target="_blank" href="https://plus.google.com/share?url={{ route('campaign.show', ['slug' => $donation->campaign->slug]) }}" class="gg-share"><i class="fab fa-google-plus-square"></i></a></li>--}}
                                {{--</ul>--}}
                            {{--</ul>--}}
                        </div>
                    </div>
                    <div class="col">
                        <div class="donate-back-button">
                            <a href="{{ route('campaign.show', ['slug' => $donation->campaign->slug]) }}">back to campaign</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="share-modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-share" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thank You For Your Donation</h4>
                        <h5 class="modal-title">Support {{ $donation->campaign->user->first_name }} {{ $donation->campaign->user->last_name }} <br> by sharing this fundraiser.</h5>
                        <div class="modal-brand"><img src="{{ asset('img/logo-modal.png') }}" alt=""></div>
                    </div>
                    <div class="modal-body">
                        <ul class="modal-list">
                            @php
                                $emailContent = 'mailto:?subject=Support ' . $donation->campaign->user->first_name . ' ' .  $donation->campaign->user->last_name . ' by sharing this fundraiser.&body=' . route('campaign.show', ['campaign' => $donation->campaign->slug]);
                            @endphp
                            <li><a class="modal-float" href="https://www.facebook.com/sharer/sharer.php?u={{ route('campaign.show', ['campaign' => $donation->campaign->slug]) }}"> <span class="modal-float fb-share"><i class="fab fa-facebook"></i></span><p>share on Facebook</p></a> </li>
                            <li><a class="modal-float" href="https://twitter.com/home?status={{ route('campaign.show', ['campaign' => $donation->campaign->slug]) }}"><span class="modal-float tw-share"><i class="fab fa-twitter"></i></span><p>share on Twitter</p></a></li>
                            <li><a class="modal-float" id="share-on-email" href="{{ $emailContent }}"><span class="modal-float g-share"><i class="far fa-envelope"></i></span><p>Share by mail</p></a> </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#share-modal').modal('show');

        $('#copy-to-clipboard').on('click', function (e) {
          e.preventDefault();

          var textToCopy = document.getElementById('campaign-link');

          textToCopy.removeAttribute('disabled');
          textToCopy.select();
          document.execCommand('copy');
          textToCopy.setAttribute('disabled', '1');
        });
        
//        $('#share-on-email').on('click', function (){
//            $('#share-email-div').remove();
//            var html = '<div class="share-email__wrapper" id="share-email-div"><label class="share-mail__label">' + '<input class="share-mail__input" id="share-email-input" type="text">' + '</label><a class="share-email__send" id="share-email-send">send</a></div>';
//            $(this).after($(html).hide().fadeIn(1000));
//        });
        
        {{--$(document).on('click', '#share-email-send', function (){--}}
            {{--$('#share-email-error').remove();--}}
            {{--var sendToEmail = $('#share-email-input').val();--}}
            {{--if (validateEmail(sendToEmail)) {--}}
                {{--$('#send-email-share').remove();--}}
                {{--var route = '{!! route('campaign.show', ['campaign' => $donation->campaign->slug]) !!}';--}}
                {{--var emailContent = 'mailto:' + sendToEmail + '?subject=Help ' + '{!!  $donation->campaign->user->first_name . ' ' .  $donation->campaign->user->last_name !!}' + ' reach their goal by sharing below.&body=' + route;--}}
                {{--var html = '<a id="send-email-share" href="' + emailContent + '">asd</a>';--}}
                {{--$('#share-email-send').attr('href', emailContent);--}}
                {{--$('#share-email-div').fadeOut(1000);--}}
            {{--}else{--}}
                {{--$(this).before('<p class="error" id="share-email-error">Please enter valid email</p>')--}}
            {{--}--}}
        {{--});--}}

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    </script>
@endsection
