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
<header id="header">
    <div class="container">
        <nav class="navbar">
            <div class="row">
                <div class="col-md-3">
                    <div class="navbar-brand">
                        <a href="#0"><img src="{{asset('/img/logo.png')}}" alt=""/></a>
                    </div>
                </div>
                <div class="col-md-9">
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
<div class="start-campaign__section">
    <div class="container">
        <div class="offset-lg-2 col-lg-8  offset-0 col-12">
            <div class="campaign-section__block">
                <div class="campaign-section__header">
                    <h1>start a campaign</h1>
                    <a href="#0">need help?</a>
                </div>

                <div class="step-part__section">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="active-step">
                                <p><span>1</span>Register</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="inactive-step">
                                <p><span>2</span> Add Campaign Details</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="signin-fb__button">
                                <button>sign in via facebook</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="signin-google__button">
                                <button>sign in via google</button>
                            </div>
                        </div>
                    </div>
                    <p>or</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputName1">name<sup>*</sup></label>
                                <input type="text" placeholder="name" id="exampleInputName1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">birthdate<sup>*</sup></label>
                                <input type="date" id="exampleInputPassword1" placeholder="birthdate">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">email<sup>*</sup></label>
                                <input type="email" id="exampleInputEmail1" placeholder="email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputPhone1">phone<sup>*</sup></label>
                                <input type="tel" id="exampleInputPhone1" placeholder="phone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputAddress1">adress<sup>*</sup></label>
                                <input type="text" id="exampleInputAddress1" placeholder="address">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputZip1">password<sup>*</sup></label>
                                <input type="text" id="exampleInputzip1" placeholder="zip code">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputSocSecurity1">social security number<sup>*</sup></label>
                                <input type="text" id="exampleInputSocSecurity1" placeholder="social security number">
                            </div>
                        </div>
                    </div>
                    <div class="next-button">
                        <button type="submit">next step</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="footer-link__list">
            <div class="row">
                <div class="col-md-2">
                    <div class="footer-single__list">
                        <h1>let us help</h1>
                        <ul>
                            <li><a href="#0">how we help</a></li>
                            <li><a href="#0">checklist</a></li>
                            <li><a href="#0">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-single__list">
                        <h1>campaigns</h1>
                        <ul>
                            <li><a href="#0">start a campaign</a></li>
                            <li><a href="#0">find a campaign</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-single__list">
                        <h1>security</h1>
                        <ul>
                            <li><a href="#0">privacy policy</a></li>
                            <li><a href="#0">terms of use</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-single__list">
                        <h1>links</h1>
                        <ul>
                            <li><a href="#0">sign in</a></li>
                            <li><a href="#0">sign up</a></li>
                            <li><a href="#0">press/newa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
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
                <div class="col-md">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/cnn_money-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/boston_globe-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/time-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/pbs-icon.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-md">
                    <div class="single-partner">
                        <a href="#0"><img src="{{asset('/img/bloomberg-icon.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="{{ asset('/js/app.js') }}"></script>
</body>


</html>
