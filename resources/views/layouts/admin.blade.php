<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/oneui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/admin-dash.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/themes/myrespects.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/js/plugins/summernote/summernote.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,700" rel="stylesheet">
    @stack('stack-css')
    <script defer src="//use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
</head>
<body>
<body>

<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">

    @include('admin._navigation')

    <main id="main-container">
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        @yield('title', 'Dashboard')
                        <small>@yield('subtitle', '')</small>
                    </h1>
                </div>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>

    </main>
</div>
</body>

<script src="{{ asset('backend/assets/js/oneui.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/summernote/summernote.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@include('admin._alert')

@yield('script')
@stack('stack-script')
@yield('alert')

</body>
</html>
