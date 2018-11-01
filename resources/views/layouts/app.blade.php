<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="fb:app_id" content="618863721596085"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@myrespects">
    <meta property="og:site_name" content="MyRespects"/>
    @yield('facebook-meta')
    <meta property="og:type" content="website"/>

    <meta property="og:image" content="https://myrespects.com/img/logo_social_invert.png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon.png') }}">
    <title>{{ $settings->get('site_title') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.11.0/css/bootstrap-tour-standalone.min.css">

    @yield('css')
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    {!! $settings->get('custom_script') !!}

    @if (App()->environment() === 'production')
        <script> (
                function (h, o, t, j, a, r) {
                    h.hj = h.hj || function () {
                        (
                            h.hj.q = h.hj.q || []
                        ).push(arguments)
                    };
                    h._hjSettings = {hjid: 835174, hjsv: 6};
                    a = o.getElementsByTagName('head')[0];
                    r = o.createElement('script');
                    r.async = 1;
                    r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
                    a.appendChild(r);
                }
            )(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv='); </script>
    @endif
</head>
<body>
<div id="fb-root"></div>
<script>(
        function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=406758929736301&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk')
    );</script>
<header id="header" style="background-image: url('{{asset('/img/purple-header.png')}}')">
    <nav class="navbar">
        <div class="navbar-main">
            <div class="navbar-brand">
                <a href="{{ route('home') }}"><img src="{{asset('/img/logo.png')}}" alt="logo"></a>
            </div>
            <div class="navbar-main__section">
                <ul>
                    <li>
                        @if (!auth()->guest() && $campaign = auth()->user()->campaigns()->first())
                            <a class="fundraiser-start" href="{{ route('campaign.dashboard') }}"><span>My
                                                    fundraiser </span></a>
                        @elseif(!auth()->guest() && auth()->user()->is('affiliate'))
                            <a href="{{ route('partner.index') }}">Partner Dashboard</a>
                        @else
                            {{--<a class="fundraiser-start" href="{{ route('campaign.create') }}"><span>start your fundraiser here</span></a>--}}
                            <a class="fundraiser-start" data-toggle="modal" data-target="#signUpModal"><span>start your fundraiser here</span></a>
                        @endif
                    </li>
                    {{--<li>--}}
                    {{--<a href="#search">Find a fundraiser</a>--}}
                    {{--</li>--}}
                </ul>
            </div>


            <div class="navbar-main__right">
                <nav class="navbar">
                    <div class="form-wrap">
                        <form class="search-form" method="get" action="{{route('campaign.search')}}"
                              class="search-form">

                            <label for="search-form">search</label>
                            <input id="search-form" type="text" name="search"
                                   placeholder="for a fundraiser to support">
                            <button type="submit"><i class="fas fa-arrow-right"></i></button>
                        </form>
                    </div>
                    <ul class="navbar-signin">
                        @if(auth()->guest())
                            <li class="sign-in__button">
                                <button type="button" data-toggle="modal" data-target="#signInModal">sign in</button>
                            </li>
                            {{--<li class="sign-in__button"><a href="{{ route('login') }}">sign in</a></li>--}}
                            {{--<li class="sign-up__button"><a href="{{ route('register') }}">sign up</a></li>--}}
                        @else
                            <li class="nav-item account-dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if (auth()->user()->image()->exists())
                                        <img class="img-avatar48 rounded-circle"
                                             src="{{ asset('uploads/users/' . auth()->user()->image->filename) }}">
                                    @else
                                        <img class="img-avatar48 rounded-circle"
                                             src="{{asset('/img/noavatar.jpg')}}">
                                    @endif
                                    <p>Hello {{ auth()->user()->first_name }}</p><i
                                            class="fas fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu account-logout dropdown"
                                     aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->is('affiliate'))
                                        <a class="dropdown-item" href="{{ route('partner.index') }}">Partner
                                            Dashboard</a>
                                    @endif
                                    @if(auth()->user()->is('admin'))
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin
                                            Dashboard</a>
                                    @endif
                                    @if(!is_null(auth()->user()->campaign))
                                        <a class="dropdown-item"
                                           href="{{ route('campaign.dashboard') }}">My
                                            Fundraiser</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">Edit
                                        Profile</a>
                                    <a class="dropdown-item" id="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <div class="navbar-menu__button">
                        <div class="dropdown">
                            <button class="dropdown-toggle__mobile" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                menu <i
                                        class="fas fa-angle-down"></i>
                            </button>
                            <button class="dropdown-toggle__desk" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                menu <i
                                        class="fas fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <ul class="dropdown-menu__section">
                                    @if(auth()->guest())
                                        <li class="signin__mobile"><a class="dropdown-item"
                                                                      href="{{ route('login') }}">sign
                                                in</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                               href="{{ route('campaign.create') }}">create your
                                                fundraiser</a>
                                        </li>
                                        <li class="menu-header">Funeral Service Provider<a
                                                    class="dropdown-item link-bottom"
                                                    href="{{ route('funeral-home.create') }}">submit my
                                                business</a></li>

                                        {{--<li class="signin__mobile"><a class="dropdown-item"--}}
                                        {{--href="{{ route('login') }}">sign up</a>--}}
                                        {{--</li>--}}
                                    @else
                                        <li class="signin__mobile">
                                            <a class="dropdown-item" href="{{ route('user.profile') }}">Edit
                                                Profile</a>
                                            @if(auth()->user()->is('affiliate'))
                                                <a class="dropdown-item"
                                                   href="{{ route('partner.index') }}">Partner
                                                    Dashboard</a>
                                            @endif
                                            @if(auth()->user()->is('admin'))
                                                <a class="dropdown-item"
                                                   href="{{ route('admin.dashboard') }}">Admin
                                                    Dashboard</a>
                                            @endif
                                            @if(!is_null(auth()->user()->campaign))
                                                <a class="dropdown-item"
                                                   href="{{ route('campaign.dashboard') }}">My
                                                    Fundraiser</a>
                                            @endif
                                        </li>
                                        <li><a class="dropdown-item"
                                               href="{{ route('page.how-we-help') }}">how
                                                we
                                                help</a></li>
                                        <li><a class="dropdown-item"
                                               href="{{ route('funeral-home.create') }}">become
                                                a partner</a></li>
                                        <li class="signin__mobile">
                                            <a class="dropdown-item" id="" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>
                                        </li>
                                    @endif
                                    <li><a class="dropdown-item"
                                           href="{{ route('page.how-we-help') }}">how we help</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{ route('blog.index') }}">blog</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{ route('news.index') }}">press/news</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{ route('page.faq') }}">FAQ</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="#search">search</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{ route('page.contact') }}">contact us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div id="search" class="search-box__section">
            <form role="search" id="searchform" action="{{ route('campaign.search') }}"
                  method="get">
                <span class="close">&times;</span>
                <div class="offset-md-2 col-md-8">
                    <input value="" id="campaign-search-input" name="search" type="text"
                           placeholder="search for a fundraiser"/>
                </div>
            </form>

        </div>
    </nav>
</header>
<div class="body-wrapper">
    @yield('content')
</div>
<footer id="footer">
    <div class="footer-upper" style="background-image: url('{{asset('/img/blue-bg.png')}}')">
        <div class="container">
            <div class="footer-link__list">
                <div class="row">
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="footer-single__list">
                            <h1>let us help</h1>
                            <ul>
                                <li><a href="{{ route('blog.index') }}">blog</a></li>
                                <li><a href="{{ route('page.faq') }}">FAQ</a></li>
                                <li><a href="{{ route('page.how-we-help') }}">how we help</a></li>
                                <li><a data-toggle="modal" data-target="#signUpModal">start a fundraiser</a></li>
                                <li><a href="#search">find a fundraiser</a></li>

                                <!-- <li><a href="/find-funeral-home">find a funeral home</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer-single__list">
                            <h1>contact us</h1>
                            <ul>
                                <li><a href="{{ route('page.contact') }}">Contact us</a></li>
                                <li><a href="{{ route('news.index') }}">press/news</a></li>
                                <!-- <li><a href="">media information</a></li> -->
                                <li>
                                    <div class="campaign-detail__share">
                                        <ul class="detail-share__links">
                                            {{--@if(!is_null($settings->get('facebook')))--}}
                                            <li><a target="_blank" href="{{ $settings->get('facebook') }}"
                                                   class="fb-share"><i class="fab fa-facebook-square"></i></a></li>
                                            {{--@endif--}}
                                            {{--@if(!is_null($settings->get('twitter')))--}}
                                            <li><a target="_blank" href="{{ $settings->get('twitter') }}"
                                                   class="tw-share"><i class="fab fa-twitter-square"></i></a></li>
                                            {{--@endif--}}
                                            {{--@if(!is_null($settings->get('google_plus')))--}}
                                        <!-- <li><a target="_blank" href="{{ $settings->get('google_plus') }}"
                                                       class="gg-share"><i class="fab fa-google-plus-square"></i></a>
                                                </li> -->
                                            {{--@endif--}}
                                            {{--@if(!is_null($settings->get('linkedin')))--}}
                                            <li><a target="_blank" href="{{ $settings->get('linkedin') }}"
                                                   class="li-share"><i class="fab fa-linkedin"></i></a></li>
                                            {{--@endif--}}
                                        </ul>
                                    </div>
                                </li>
                                {{--@if (!auth()->guest() && auth()->user()->campaign()->exists())--}}
                                {{--<li><a href="{{ route('campaign.dashboard') }}">Manage Fundraiser</a></li>--}}
                                {{--@else--}}
                                {{--<li><a href="{{ route('campaign.create') }}">start a fundraiser</a></li>--}}
                                {{--@endif--}}
                                {{--<li><a href="#search">find a fundraiser</a></li>--}}

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="footer-list__img">
                            <img src="/img/heart.png" alt="">
                            <img src="/img/my-res_footer.png" alt="">
                            <table width="135" border="0" cellpadding="2" cellspacing="0"
                                   title="Click to Verify - This site chose GeoTrust SSL for secure e-commerce and confidential communications.">
                                <tr>
                                    <td width="135" align="center" valign="top">
                                        <script type="text/javascript"
                                                src="https://seal.geotrust.com/getgeotrustsslseal?host_name=www.myrespects.com&amp;size=M&amp;lang=en"></script>
                                        <br/>
                                        <a href="https://www.geotrust.com/ssl/" target="_blank"
                                           style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;"></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="col-lg-5 col-md-8 col-sm-10 col-12">
                        <div class="footer-single__list">
                            <div class="newsletter-img">
                                <img src="/img/newsletter-img.png" alt="">
                            </div>

                            <!-- Begin MailChimp Signup Form -->

                            <div id="mc_embed_signup" class="newsletter-email">
                                <h2>The MyRespects</h2>
                                <h1>E-Newsletter Sign-Up</h1>
                                <form action="https://myrespects.us12.list-manage.com/subscribe/post?u=ed796f6b36d3cfcbb99ed171e&amp;id=ad11ea204f"
                                      method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                      class="validate"
                                      target="_blank" novalidate>
                                    <div id="mc_embed_signup_scroll">
                                        <div class="mc-field-group">
                                            <input type="email" value="" name="EMAIL" class="required email"
                                                   id="mce-EMAIL"
                                                   required>
                                        </div>
                                        <div id="mce-responses" class="clear">
                                            <div class="response" id="mce-error-response" style="display:none"></div>
                                            <div class="response" id="mce-success-response" style="display:none"></div>
                                        </div>
                                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input
                                                    type="text" name="b_ed796f6b36d3cfcbb99ed171e_ad11ea204f"
                                                    tabindex="-1"
                                                    value=""></div>
                                        <div class="clear"><input type="submit" value="SIGN UP TODAY!" name="subscribe"
                                                                  id="mc-embedded-subscribe" class="button"></div>
                                    </div>
                                </form>
                            </div>
                            <!--End mc_embed_signup-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <ul class="footer-bottom__list">
            <li><a href="{{ route('page.privacy') }}">privacy policy</a></li>
            <li><a href="{{ route('page.terms') }}">terms of use</a></li>
            <li><i class="far fa-copyright"></i>2017 My Respects</li>
        </ul>
    </div>
    <div class="footer-shadow">
        <img src="/img/shadow.png">
    </div>
    @include('_organisations')

</footer>

<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="sign-in__modal">
                <div class="modal-header">
                    <div class="modal-header__image">
                        <img src="{{asset('/img/logo-modal.png')}}" alt="">
                    </div>
                    <p>sign in</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="far fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">username
                                            <span>(your primary email)</span></label>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">password</label>
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <div class="signin-button">
                                <button type="submit"><span><img src="{{asset('/img/signin.svg')}}" alt=""></span>manage
                                    my fundraiser
                                </button>
                            </div>
                            <p>If you are only looking to contribute to a fundraiser, you do not need to login or sign
                                up to find a fundraiser,a
                                <a href="#search">click here</a> to search for a fundraiser to support.</p>
                            {{--<div class="signin-fb__button">--}}
                            {{--<a href="{{ route('facebook.signin') }}">sign in via facebook</a>--}}
                            {{--</div>--}}
                            <div class="forgot-pass">
                                <a href="{{ route('password.request') }}">forgot your password?</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="signup-button">
                        <p>Need To Start a Fundraiser?
                            <a id="signUpButton" data-toggle="modal">Click Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="sign-up__modal">
                <div class="modal-header">
                    <div class="modal-header__image">
                        <img src="{{asset('/img/logo-modal.png')}}" alt="">
                    </div>
                    <p>account sign up</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="far fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $action = request()->has('start-campaign') ? url('/register?start-campaign=1') : url('/register');
                    @endphp
                    <form role="form" id="create-fundraiser" method="POST" action="{{ $action }}">
                        <div class="form-top">
                            {!! csrf_field() !!}
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="signin-fb__button">
                                        @if(app('request')->input('start-campaign'))
                                            <a href="{{ route('facebook.signin', ['start_campaign' => true]) }}"><span><i
                                                            class="fab fa-facebook-f"></i></span>sign in via
                                                facebook</a>
                                        @else
                                            <a href="{{ route('facebook.signin') }}"><span><i
                                                            class="fab fa-facebook-f"></i></span>use my facebook account</a>
                                        @endif
                                        <p>We will never post without your permission</p>
                                    </div>
                                </div>
                                <div class="signup-divider">
                                    <p>or</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">first name</label>
                                        <input type="text"
                                               class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                               name="first_name" value="{{ old('first_name') }}" required>
                                        @if ($errors->has('first_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">last name</label>
                                        <input type="text"
                                               class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                               name="last_name" value="{{ old('last_name') }}" required>
                                        @if ($errors->has('last_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">email<span>(your primary email)</span></label>
                                        <input type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}"
                                               placeholder="this is your username" required>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">password</label>
                                        <input type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password">
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">confirm password</label>
                                        <input type="password"
                                               class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                               name="password_confirmation" required>
                                    </div>
                                    <div class="form-agree">
                                        <p>"By signing up, you agree to our <a href="{{ route('page.terms') }}" target="_blank">Terms of
                                                Use</a> and <a
                                                    href="{{ route('page.privacy') }}" target="_blank">Privacy Policy".</a></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <div class="form-group captcha-wrapp">
                                {{-- {!! NoCaptcha::display() !!} --}}
                                {!! app('captcha')->render(); !!}

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="signin-button">
                                <button type="submit"><span><i class="fas fa-plus"></i></span>create your fundraiser
                                </button>
                            </div>

                            <p>If you are only looking to contribute to a fundraiser, you do not need to login or sign
                                up to find a fundraiser,a
                                <a href="#search">click here</a> to search for a fundraiser to support.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Alert Message--}}

@if (Session::has('message'))
    <div class="funeral-alert">
        <div><p>{{ Session::get('message') }}<span class="tagRemove" id="alert-remove">&times;</span></p></div>
        {{ Session::forget('message') }}
    </div>
@endif

@if (Session::has('message-error'))
    <div class="funeral-alert__error">
        <div><p>{{ Session::get('message-error') }}<span class="tagRemove" id="alert-remove">x</span></p></div>
        {{ Session::forget('message-error') }}
    </div>
@endif

<div class="message-alert" style="display: none">
    <div><p>You have new message<span class="tagRemove" id="alert-remove">&times;</span></p></div>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.11.0/js/bootstrap-tour-standalone.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    (
        function removeFacebookAppendedHash() {
            if (!window.location.hash || window.location.hash !== '#_=_') {
                return;
            }
            if (window.history && window.history.replaceState) {
                return window.history.replaceState('', document.title, window.location.pathname + window.location.search);
            }
            // Prevent scrolling by storing the page's current scroll offset
            var scroll = {
                top: document.body.scrollTop, left: document.body.scrollLeft
            };
            window.location.hash = "";
            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scroll.top;
            document.body.scrollLeft = scroll.left;
        }()
    );
</script>

@if (!auth()->guest())
    <script>
        function checkMessages() {
            axios.get('/message/check-messages')
                .then(function (response) {
                    if (response.data.status) {
                        $('.message-alert').slideDown();

                        setTimeout(function () {
                            $('.message-alert').slideUp();
                        }, 3000)
                    }
                }).catch(function (error) {
                console.log(error)
            })
        }

        checkMessages()
        setInterval(checkMessages, 60000 * 5);
    </script>
@endif

@yield('script')
@stack('stack-script')
</body>
</html>

