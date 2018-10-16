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
<div class="pending-block">
    <div class="col">
        <div class="pending-payment">
            <div class="offset-1 col-10">
                <div class="pending">
                    <div class="loading">
                        <div class="loading__square"></div>
                        <div class="loading__square"></div>
                        <div class="loading__square"></div>
                        <div class="loading__square"></div>
                        <div class="loading__square"></div>
                        <div class="loading__square"></div>
                        <div class="loading__square"></div>
                    </div>
                </div>
                <div>
                    <div class="pending-text">
                        <h2 class="saving">payment pending<span>.</span><span>.</span><span>.</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
