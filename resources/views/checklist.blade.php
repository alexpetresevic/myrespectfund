@extends('layouts.app')

@section('content')
<div class="news-section">
    <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 offset-md-0 col-md-12 offset-0 col-12">
        <div class="checklist__block">
            <div class="checklist-header">
                <h1>I am planing for:</h1>
                <form>
                    <div class="donation-block">
                        <div class="select-radio">
                            <div class="row">
                                <div class="col-sm-4 col-md-3 radio-box">
                                    <div class="single-radio-box">
                                        <input type="radio" id="switch_one" name="switch_2" value="yes" checked>
                                        <label for="switch_one">my self</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-3 radio-box">
                                    <div class="single-radio-box">
                                        <input type="radio" id="switch_two" name="switch_2" value="no">
                                        <label for="switch_two">a loved one</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p class="check-share">share on:</p>
                                </div>
                                <div class="col-3 col-sm-2 col-md-1">
                                    <div class="detail-share__links">
                                        <button class="fb-share"><i class="fab fa-facebook-square"></i></button>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-2 col-md-1">
                                    <div class="detail-share__links">
                                        <button class="tw-share"><i class="fab fa-twitter-square"></i></button>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-2 col-md-1">
                                    <div class="detail-share__links">
                                        <button class="gg-share"><i class="fab fa-google-plus-square"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <h3>Planning your funeral or memorial service</h3>
                <p>Planning your own funeral or memorial service can provide peace-of-mind to you and your family.By
                    planning your service in advance you can design and specify the exact type of service</p>
                <div class="share-button__section">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="share-mail">
                                <a data-toggle="modal" data-target="#checkModal">send me the list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="checklist-section">
                <div class="single-checklist">
                    <h3>Step 1: find a funeral home</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-checklist__img">
                                <img src="{{asset('/img/bg_ourtime.png')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="single-checklist__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut diam suscipit,
                                    pellentesque elit vel, pretium nisi. Cras sed augue orci. Ut hendrerit dictum
                                    finibus. Aenean ut pulvinar ligula. In hac habitasse platea dictumst. Suspendisse
                                    non convallis tellus. Maecenas elementum gravida ante, sed feugiat est faucibus id.
                                    Ut ullamcorper odio id pulvinar elementum. Etiam suscipit mollis imperdiet.
                                    Vestibulum iaculis posuere aliquam. Donec iaculis eleifend dui, ut malesuada dui
                                    porttitor sed. Nunc vel libero sed ex volutpat vehicula congue sit amet lacus.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-checklist">
                    <h3>Step 2: type of service or event</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-checklist__img">
                                <img src="{{asset('/img/bg_banner2.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="single-checklist__text">
                                <p>Vivamus scelerisque et velit ut finibus. Proin placerat ex augue, vitae venenatis
                                    massa ultricies sed. Praesent mollis enim vel velit posuere aliquam. Ut et efficitur
                                    enim, id sodales dui. Donec rhoncus, sapien in aliquam accumsan, sapien turpis
                                    egestas eros, congue scelerisque est risus a lectus. Proin pharetra mattis
                                    scelerisque. Phasellus hendrerit consequat neque, sit amet porta turpis rhoncus at.
                                    Maecenas elementum nec lectus sed porttitor.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<div id="checkModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="check-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Send PDF to:</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="check-mail">
                        <input type="mail" placeholder="Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button-close" id="modal-close"
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" id="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>