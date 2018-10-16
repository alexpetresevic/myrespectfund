@section('facebook-meta')
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:title" content="{{ $campaign->title }}"/>
    <meta property="og:description" content="{{ $campaign->campaign_story }}"/>
    @if ($campaign->image()->exists())
        <meta property="og:image" content="{{asset('uploads/campaigns/' . $campaign->image->filename)}}"/>
        <meta name="twitter:image" content="{{asset('uploads/campaigns/' . $campaign->image->filename)}}">
    @endif
@endsection

@extends('layouts.app')

@section('content')
    <div class="campaign-detail">
        <div class="container">
            <div class="campaign-detail__section">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="campaign-detail__share">
                            <h3>Share with Friends & Family</h3>
                            <ul class="detail-share__links">
                                <li><a target="_blank"
                                       href="https://www.facebook.com/sharer/sharer.php?u={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                       class="fb-share"><i class="fab fa-facebook-square"></i></a></li>
                                <li><a target="_blank"
                                       href="https://twitter.com/home?status={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                       class="tw-share"><i class="fab fa-twitter-square"></i></a></li>
                                <li><a target="_blank"
                                       href="https://plus.google.com/share?url={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                       class="gg-share"><i class="fab fa-google-plus-square"></i></a></li>
                                <li><a target="_blank"
                                       href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                       class="li-share"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="campaign-donate__block">
                            <div class="raised-donate__header"><p>Raised:</p>
                                ${{ number_format($campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }} <p>
                                    of</p>
                                ${{ number_format($campaign->goal, 2, '.', ',') }}</div>
                            @if($campaign->active)
                                <a href="{{ route('donate.index', ['campaign' => $campaign->slug]) }}">donate now</a>
                            @endif
                        </div>
                        <div class="campaign-detail__stats">
                            <p><span>{{ $campaign->allApprovedDonations()->count() }}</span> people have donated</p>
                            {{--<p>Fundraiser has been live for--}}
                            {{--<span>{{ $campaign->created_at->diffInDays() }} {{ str_plural('day', $campaign->created_at->diffInDays()) }}</span>--}}
                            {{--</p>--}}
                        </div>
                        <div class="campaign-brief__block">
                            @if ($campaign->updates()->exists())
                                <div class="brief-update__section">
                                    <h3>Recent Updates – Click to Read</h3>
                                    <ul class="brief_list">
                                        @foreach($campaign->updates as $update)
                                            <li><a class="scroll-to"
                                                   href="#update__{{md5($update->id)}}">{{ str_limit($update->body, 45) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="#0" class="update-signup" data-toggle="modal" data-target="#updates-modal">sign
                                        up for updates</a>
                                </div>
                            @endif
                            <div class="brief-details">
                                <h3>funeral details</h3>
                                <ul class="brief-details__list">
                                    @if ($campaign->funeralHome()->exists())
                                        <li>funeral location:<span>{{ $campaign->funeralHome->name }}</span></li>
                                        <div id="map" class="google-map" style="height: 300px"></div>
                                    @endif
                                    <li>funeral
                                        date:<span>{{ date('F dS, Y', strtotime($campaign->funeral_date)) }}</span></li>
                                    <li>funeral time:<span>{{ $campaign->funeral_time }}</span></li>
                                </ul>
                                @php
                                    $timestamp = strtotime($campaign->funeral_date . $campaign->funeral_time);
                                    $date = date('Ymd\THis', $timestamp) . 'Z';

                                    $paramsArray = [
                                        'action'   => 'TEMPLATE',
                                        'text'     => $campaign->title,
                                        'dates'    => $date . '/' . $date,
                                        'details'  => $campaign->campaign_story,
                                        'location' => $campaign->funeralHome()->exists() ? $campaign->funeralHome->address : '',
                                        'sf'       => 'true',
                                        'output'   =>'xml'
                                    ];
                                    $queryParams = http_build_query($paramsArray);
                                @endphp
                                <a href="https://www.google.com/calendar/render?{{ $queryParams }}"
                                   onclick="window.open('https://www.google.com/calendar/render?{{ $queryParams }}', 'newwindow', 'width=1000,height=850'); return false;"
                                   class="addto-calendar">add to calendar
                                </a>
                            </div>
                            <div class="recent-donations__block">
                                <h3>recent donations</h3>
                                @if($campaign->donations()->exists())
                                    @foreach($campaign->allApprovedDonations as $donation)
                                        <div class="single-donation__block">
                                            <ul class="single-donation__list">
                                                <li>{{ $donation->anonymous ? 'Anonymous' : $donation->first_name . ' ' . $donation->last_name }}
                                                    - ${{number_format($donation->amount, 2, '.', ',')}}</li>
                                                <li>{{ $donation->created_at->diffForHumans() }}</li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="campaign-detail__header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1>{{ $campaign->title }}</h1>
                                    <h3>Share with Friends & Family</h3>
                                    <ul class="detail-share__links">
                                        <li><a target="_blank"
                                               href="https://www.facebook.com/sharer/sharer.php?u={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                               class="fb-share"><i class="fab fa-facebook-square"></i></a></li>
                                        <li><a target="_blank"
                                               href="https://twitter.com/home?status={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                               class="tw-share"><i class="fab fa-twitter-square"></i></a></li>
                                        <li><a target="_blank"
                                               href="https://plus.google.com/share?url={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                               class="gg-share"><i class="fab fa-google-plus-square"></i></a></li>
                                        <li><a target="_blank"
                                               href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('campaign.show', ['slug' => $campaign->slug]) }}"
                                               class="li-share"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                    <ul class="campaign-title__details">
                                        <li>
                                            @if ($campaign->funeralHome()->exists())
                                                {{ $campaign->funeralHome->name }}
                                            @endif
                                        </li>
                                        <li>{{ $campaign->created_at->diffForHumans() }}</li>
                                        <li>
                                            {{ $campaign->user->first_name . ' ' . $campaign->user->last_name }}
                                        </li>
                                    </ul>
                                </div>
                                @if ($campaign->image()->exists())
                                    <div class="col-md-2">
                                        <img src="{{asset('uploads/campaigns/' . $campaign->image->filename)}}" alt="">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="campaign-detail__content">
                            @if ($campaign->image()->exists())
                                <img src="{{asset('uploads/campaigns/' . $campaign->image->filename)}}" alt="">
                            @endif
                                <div class="campaign-donate__block-mobile">
                                    <div class="raised-donate__header"><p>Raised:</p>
                                        ${{ number_format($campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }} <p>
                                            of</p>
                                        ${{ number_format($campaign->goal, 2, '.', ',') }}</div>
                                    @if($campaign->active)
                                        <a href="{{ route('donate.index', ['campaign' => $campaign->slug]) }}">donate now</a>
                                    @endif
                                </div>
                            <div class="campaign-about__block">
                                <div class="campaign-detail__about">
                                    <h3>About {{ $campaign->title }}</h3>
                                    <p>{{ $campaign->campaign_story }}</p>
                                </div>
                                <ul class="campaign-donate__buttons">
                                    <li><a href="#0" data-toggle="modal" data-target="#updates-modal">get update</a>
                                    </li>
                                    @if($campaign->active)
                                        <li><a href="{{ route('donate.index', ['campaign' => $campaign->slug]) }}">donate
                                                Now</a></li>
                                    @endif
                                </ul>

                                <div class="fb-comments" data-href="{{ request()->url() }}" data-width="100%"
                                     data-numposts="10"></div>

                                @foreach($campaign->updates as $update)
                                    <div class="campaign-detail__update" id="update__{{md5($update->id)}}">
                                        <h3>{{ date('F dS, Y', strtotime($update->created_at)) }}</h3>
                                        @if($update->image)
                                            <img class="text-wrap"
                                                 src="{{ asset('/uploads/updates/' . $update->image->filename) }}"
                                                 alt="">
                                        @endif
                                        {{--<img src="{{ asset('uploads/funeral-homes/' . $update->image->filename) }}" alt="">--}}
                                        <div class="campaign-detail__updbody" hspace="250">
                                            <p>{{ $update->body }}</p>
                                            <p> Time: {{ date('h:i A', strtotime($update->created_at)) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="updates-modal" class="modal" role="dialog">
        <div class="modal-dialog">
            <form id="updates-form" action="#" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Sign Up For Updates</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update_email">Email address to send updates to</label>
                            <input required id="update_email" type="email" name="update_email" class="form-control"
                                   placeholder="Email">
                            <span id="updates_error" style="display: none" class="help-block text-danger">Please enter valid email address.</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-close" id="modal-close" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit_update">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    @if ($campaign->funeralHome()->exists())
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places&callback=initMap">
        </script>
        <script>
            var latitude = {!! $campaign->funeralHome->location->latitude !!};
            var longitude = {!! $campaign->funeralHome->location->longitude !!};

            function initMap() {
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
        var campaignId = {{ $campaign->id }}
        $(function () {

            $('input[name="update_email"]').on('keydown', function (e) {
                $('#updates_error').hide();
            })

            $('#submit_update').on('click', function (e) {
                e.preventDefault();

                var email = $('input[name="update_email"]').val();

                axios.post('/sign-up-for-updates', {
                    email: email, campaign_id: campaignId
                }).then(function (response) {
                    $('#updates-modal').modal('hide');
                    $('input[name="update_email"]').val('');
                    siteMessage('You have successfully subscribed to fundraiser updates', '#footer');
                }).catch(function (error) {
                    $('#updates_error').show();
                });
            })
        });

        $('.scroll-to').on('click', function (e) {
            e.preventDefault();

            var target = $(this).attr("href");


            console.log($(target).offset().top);

            $('html, body').animate({
                scrollTop: (
                    $(target).offset().top - 80
                )
            }, 750);

        });
    </script>
@endsection
