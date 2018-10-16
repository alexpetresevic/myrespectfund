<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
<div class="campaign-detail__donate">
    <div class="container">
        <div class="campaign-detail__section">
            <h1>thank you - you donated $100</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="donate-img">
                        <img src="{{asset('/img/bg_hero.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="donate-share">
                        <h1>campaign title</h1>
                        <p><span>new</span> amount raised to date</p>
                        <h2>$12,100 <span>of $13,000</span></h2>
                        <p>share on:</p>
                        <ul class="detail-share__links">
                            <li><a href="#0" class="fb-share"><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href="#0" class="tw-share"><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href="#0" class="gg-share"><i class="fab fa-google-plus-square"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="donate-back-button">
                        <button>back to campaign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
</body>
</html>