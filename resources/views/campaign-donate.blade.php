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
                                <li><a href="#0" class="fb-share"><i class="fab fa-facebook-square"></i></a></li>
                                <li><a href="#0" class="tw-share"><i class="fab fa-twitter-square"></i></a></li>
                                <li><a href="#0" class="gg-share"><i class="fab fa-google-plus-square"></i></a></li>
                                <li><a href="#0" class="li-share"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="campaign-donate__block">
                            <div class="raised-donate__header"><p>Raised:</p> $11,111 <p>of</p> $12,000</div>
                            <a href="#0">donate now</a>
                        </div>
                        <div class="campaign-detail__stats">
                            <p><span>240</span> people have donated</p>
                            <p>Campaign has been live for <span>5 days</span></p>
                        </div>
                        <div class="campaign-brief__block">
                            <div class="brief-update__section">
                                <h3>Recent Updates – Click to Read</h3>
                                <ul class="brief_list">
                                    <li><a href="#0">Location has been posted for the Funeral ..</a></li>
                                    <li><a href="#0">Date and Time Have been posted</a></li>
                                </ul>
                                <a href="#0" class="update-signup">sign up for updates</a>
                            </div>
                            <div class="brief-details">
                                <h3>funeral details</h3>
                                <ul class="brief-details__list">
                                    <li>funeral location:<span>Dave’s Funeral Home – MAP</span></li>
                                    <li>funeral date:<span>August 20th, 2017</span></li>
                                    <li>funeral time:<span>9:00 pm EST</span></li>
                                </ul>
                                    <a href="#0" class="addto-calendar">add to calendar</a>
                            </div>
                            <div class="recent-donations__block">
                                <h3>recent donations</h3>
                                <div class="single-donation__block">
                                    <ul class="single-donation__list">
                                        <li>name-amount</li>
                                        <li>date</li>
                                    </ul>
                                </div>
                                <div class="single-donation__block">
                                    <ul class="single-donation__list">
                                        <li>name-amount</li>
                                        <li>date</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="campaign-detail__header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1>campaign title</h1>
                                    <ul class="campaign-title__details">
                                        <li><a href="#0">location</a></li>
                                        <li><a href="#0">created date</a></li>
                                        <li><a href="#0">created by</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2">
                                    <img src="{{asset('/img/slide_1.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="campaign-detail__content">
                            <img src="{{asset('/img/bg_ourtime.png')}}" alt="">
                            <div class="campaign-about__block">
                                <div class="campaign-detail__about">
                                    <h3>About Dave's Funeral</h3>
                                    <p>orem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada malesuada
                                        mi ut ultricies. Sed molestie dolor ut est bibendum placerat. Pellentesque sit amet mattis nisi. </p>
                                </div>
                                <img src="{{asset('/img/bg_ourtime.png')}}" alt="">
                                <div class="campaign-detail__update">
                                    <h3>Update 4th july 2016</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada
                                        malesuada mi ut ultricies.
                                    </p>
                                </div>
                                <ul class="campaign-donate__buttons">
                                    <li><a href="#0">get update</a></li>
                                    <li><a href="#0">donate</a></li>
                                </ul>
                                <div class="campaign-detail__text">
                                    <div class="offset-sm-1 col-sm-10">
                                        <textarea rows="4" placeholder="comments/show support"></textarea>
                                    </div>
                                    <div class="offset-sm-3 col-sm-6">
                                        <a href="#0">use social media</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

