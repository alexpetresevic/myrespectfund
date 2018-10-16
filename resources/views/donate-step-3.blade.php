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
<header id="header">
    <div class="container">
        <nav class="navbar">
            <div class="row">
                <div class="offset-lg-0 col-lg-3 col-6 offset-3">
                    <div class="navbar-brand__donate">
                        <a href="#0"><img src="{{asset('/img/logo.png')}}" alt=""/></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="navbar-main__donate">
                        <div class="navbar-main__section">
                            <h1>Campaign name</h1>
                        </div>
                        <div class="navbar-donate__right">
                            <ul class="donate-nav">
                                <li><a href="#0">help</a></li>
                                <li><a href="#0">back to campaign</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<body>
<div class="campaign-detail__donate">
    <div class="container">
        <div class="campaign-detail__section">
            <div class="row">
                <div class="col-lg-5">
                    <div class="donate-overview">
                        <img src="{{asset('/img/bg_hero.png')}}" alt="">
                        <h2>$12,000 <span>of $13,000</span></h2>
                        <p>amount raised to date</p>
                        <ul class="overview__list">
                            <li>
                                <p>Funeral on <span>Aug 20th 2017</span></p>
                            </li>
                            <li>
                                <p>Dave’s Funeral Home - MAP</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="donate-confirm">
                        <h2>Your Donation: $100</h2>
                        <ul class="confirm-list">
                            <li>
                                <p>payment type</p>
                            </li>
                            <li>
                                <p>name</p>
                            </li>
                            <li>
                                <p>type of card</p>
                            </li>
                        </ul>
                        <div class="update-donate__info">
                            <a href="#0">update information</a>
                        </div>
                    </div>
                    <div class="donate-button">
                        <button>send donation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
</body>
</html>

