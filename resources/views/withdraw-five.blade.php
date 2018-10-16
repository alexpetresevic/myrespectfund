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
                            <li class="withdraw-unavailable">1. withdrawal verification</li>
                            <li class="withdraw-unavailable">2. personal information verification</li>
                            <li class="withdraw-unavailable">3. funds transfer method</li>
                            <li class="withdraw-unavailable">4. thank donors</li>
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
                        <h2>Thank You - I Hope We helped</h2>
                        <h3>need help?<a href="#0">contact us</a></h3>
                        <p>Lets Verify Your Information</p>
                        <div class="withdraw-block">
                            <div class="withdraw-name__confirm">
                                <ul>
                                    <li><p>name</p></li>
                                    <li><p>address info</p></li>
                                </ul>
                                <div class="edit-button">
                                    <button>update</button>
                                </div>
                            </div>
                            <div class="withdraw-name__confirm">
                                <ul>
                                    <li>
                                        <p>Bank Info</p>
                                    </li>
                                </ul>
                                <div class="edit-button">
                                    <button>update</button>
                                </div>
                            </div>
                            <div class="withdraw-name__confirm">
                                <ul>
                                    <li>
                                        <p>Funeral home Info</p>
                                    </li>
                                </ul>
                                <div class="edit-button">
                                    <button>update</button>
                                </div>
                            </div>
                            <div class="checkbox-wrapper">
                                <label class="control control--checkbox" for="check_one">
                                    <input type="checkbox" class="remember-checkbox" name="become_partner"
                                           id="check_one">
                                    Send me a reminder to rate my experience
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <div class="checkbox-wrapper">
                                <label class="control control--checkbox" for="check_two">
                                    <input type="checkbox" class="remember-checkbox" name="become_partner"
                                           id="check_two">
                                    Send me post funeral reminders (Thank you notes, traditions, updates etc)
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <div class="withdraw-info">
                                <p>You campaign may be finished but your account will remain active if you wish to help
                                    others with a donation.</p>
                            </div>
                            <div class="submit-button">
                                <button>submit</button>
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

