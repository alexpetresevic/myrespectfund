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
                    <div class="withdraw-overview">
                        <ul>
                            <li><a href="#0">1. withdrawal verification</a></li>
                            <li><a href="#0">2. personal information verification</a></li>
                            <li><a href="#0">3. funds transfer method</a></li>
                            <li class="withdraw-active"><a href="#0">4. thank donors</a></li>
                        </ul>
                    </div>
                    <div class="funeral-home__information">
                        <h3>funeral home selected</h3>
                        <ul class="withdraw-funeral__info">
                            <li>
                                <p>South Abbey Funeral home</p>
                            </li>
                            <li>
                                <p>West St. John Street 40</p>
                            </li>
                            <li>
                                <p>Toronto</p>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-7">
                    <div class="withdraw-section">
                        <h2>personal information verification</h2>
                        <h3>need help?<a href="#0">contact us</a></h3>
                        <p>Lets Thank the Donors</p>
                        <div class="withdraw-block">
                            <input type="text" placeholder="Thank you title">
                            <textarea rows="6" placeholder="Thank you text"></textarea>
                            <div class="checkbox-wrapper">
                                <label class="control control--checkbox" for="check_one">
                                    <input type="checkbox" class="remember-checkbox" name="become_partner"
                                           id="check_one">
                                    Send Donors Location, Date and Time of the Funeral
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <div class="submit-button">
                                <button>next step</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
</body>
</html>

