<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<body>
<header id="header">
    <div class="container">
        <nav class="navbar">
            <div class="row">
                <div class="offset-lg-0 col-lg-3 col-6 offset-3">
                    <div class="navbar-brand">
                        <a href="#0"><img src="{{asset('/img/logo.png')}}" alt=""/></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="navbar-main">
                        <div class="navbar-main__section">
                            <ul>
                                <li>
                                    <a href="#0">Start a campaign </a>
                                </li>
                                <li>
                                    <a href="#0"> Find a campaign</a>
                                </li>
                            </ul>
                            <ul class="navbar-signin">
                                <li>
                                    <a href="#0">sign in</a>
                                </li>
                                <li>
                                    <a href="#0">sign up</a>
                                </li>
                            </ul>
                        </div>
                        <div class="navbar-main__right">
                            <div class="navbar-menu__button">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="menu-trigger"></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <ul class="dropdown-menu__section">
                                            <li><a class="dropdown-item" href="#">create a fundraiser</a></li>
                                            <li><a class="dropdown-item" href="#">how we help</a></li>
                                            <li><a class="dropdown-item" href="#">help</a></li>
                                            <li><a class="dropdown-item" href="#">become an affiliate</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<div class="hero-section">
    <img src="{{asset('/img/bg_hero.jpg')}}" alt="">
    <div class="container">
        <div class="hero-section__text">
            <img src="{{asset('/img/quality_icon.png')}}" alt="">
            <h1>get help finding a funeral</h1>
            <p>Very easy to set up. Obituary & funeral tools. No deadlines. 24 hour support.</p>
            <a href="#0">start a fundraiser today</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="latest-campaigns">
        <h1>latest funding campaigns</h1>
        <div id="funding-slider" class="owl-carousel">
            <div>
                <img src="{{asset('/img/slide_1.png')}}" alt="">
                <h2>Mark Tompson's Funeral</h2>
                <p>$3.000 raised of $2.500</p>
            </div>
            <div>
                <img src="{{asset('/img/slide_2.png')}}" alt="">
                <h2>Gil Jemison’s Funeral</h2>
                <p>$1000 raised of $900</p>
            </div>
            <div>
                <img src="{{asset('/img/slide_3.png')}}" alt="">
                <h2>Jerald Bachmann's Funeral</h2>
                <p>$3.000 raised of $2.500</p>
            </div>
            <div>
                <img src="{{asset('/img/slide_1.png')}}" alt="">
                <h2>Mark Tompson's Funeral</h2>
                <p>$3.000 raised of $2.500</p>
            </div>
            <div>
                <img src="{{asset('/img/slide_3.png')}}" alt="">
                <h2>Jerald Bachmann's Funeral</h2>
                <p>$3.000 raised of $2.500</p>
            </div>
            <div>
                <img src="{{asset('/img/slide_2.png')}}" alt="">
                <h2>Gil Jemison’s Funeral</h2>
                <p>$1000 raised of $900</p>
            </div>
        </div>
    </div>
</div>
<div class="funeral-home">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="funeral-home__section">
                    <h1>funeral home sign up</h1>
                    <h2>list your funeral home with MyRespects</h2>
                    <p>MyRespects helps families in need of a funeral home to easily find the
                        best local option. Enter your details below to have your funeral home
                        featured in our searchable, national database.</p>
                    <ul class="funeral-home__buttons">
                        <li><a href="#0">learn more</a></li>
                        <li><a href="#0">see how we help</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="funeral-home__logo">
                    <img src="{{asset('/img/logo-gold.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="family-msg__section">
    <div class="container">
        <h1>what our users say</h1>
        <p>tools that helped, in our time of need</p>
        <div class="message-section">
            <div id="message-slider" class="owl-carousel">
                <div>
                    <p>"Their tools helped me contact friends and family, and made
                        this sad time in my life much easier to manage, thank you."</p>
                    <h2>Avery Family, California</h2>
                    <img src="{{asset('/img/noavatar.jpg')}}" alt="">
                </div>
                <div>
                    <p>"Their tools helped me contact friends and family, and made
                        this sad time in my life much easier to manage, thank you."</p>
                    <h2>Avery Family, California</h2>
                    <img src="{{asset('/img/noavatar.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="footer-link__list">
            <div class="row">
                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="footer-single__list">
                        <h1>let us help</h1>
                        <ul>
                            <li><a href="#0">how we help</a></li>
                            <li><a href="#0">checklist</a></li>
                            <li><a href="#0">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="footer-single__list">
                        <h1>campaigns</h1>
                        <ul>
                            <li><a href="#0">start a campaign</a></li>
                            <li><a href="#0">find a campaign</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="footer-single__list">
                        <h1>security</h1>
                        <ul>
                            <li><a href="#0">privacy policy</a></li>
                            <li><a href="#0">terms of use</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="footer-single__list">
                        <h1>links</h1>
                        <ul>
                            <li><a href="#0">sign in</a></li>
                            <li><a href="#0">sign up</a></li>
                            <li><a href="#0">press/newa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="footer-single__list">
                        <h1>E-Newsletter Sign-Up</h1>
                        <ul>
                            <li class="newsletter-email"><input type="email" placeholder="your email">
                                <button>sign up</button>
                            </li>
                            <li><p><i class="far fa-copyright"></i> 2018</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-partners">
        <div class="container">
            <div class="row">
                <div class="col-md col-sm-6  col-12">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/cnn_money-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md col-sm-6  col-12">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/boston_globe-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md col-sm-6  col-12">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/time-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md col-sm-6  col-12">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/pbs-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md col-sm-6  col-12">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/bloomberg-icon.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<script src="js/app.js"></script>
</body>


</html>
