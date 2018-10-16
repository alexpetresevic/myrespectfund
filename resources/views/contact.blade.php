@extends('layouts.app')

@section('content')
    <div class="signin-section">
        <div class="container">
            <div class="offset-lg-2 col-lg-8 offset-sm-1 col-sm-10">
                <div class="signin-section__block">
                    <h1>contact us</h1>
                    <form id="contact-form" name="theForm" method="post" action="{{ route('contact.submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">name<sup>*</sup></label>
                            <input type="text" placeholder="name" id="name" name="name">
                            @if($errors->has('name'))
                                <div class="error">
                                    <p>{{ $errors->first('name') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">email<sup>*</sup></label>
                            <input type="email" id="email" placeholder="email" name="email">
                            @if($errors->has('email'))
                                <div class="error">
                                    <p>{{ $errors->first('email') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="subject">subject<sup>*</sup></label>
                            <input type="text" id="subject" placeholder="subject" name="subject">
                            @if($errors->has('subject'))
                                <div class="error">
                                    <p>{{ $errors->first('subject') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="message">message<sup>*</sup></label>
                            <textarea id="message" placeholder="message" rows="4" name="message"></textarea>
                            @if($errors->has('message'))
                                <div class="error">
                                    <p>{{ $errors->first('message') }}</p>
                                </div>
                            @endif
                        </div>
                        <div id='recaptcha' class="g-recaptcha"
                             data-sitekey="6LcNNGsUAAAAAMElY2A9HyyCS24rxyCf4ml6yHwQ"
                             data-callback="onSubmit"
                             data-size="invisible"></div>
                        <div class="contact-button">
                            <button type="submit" id="contact-submit">send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
    <script>
        
        var onloadCallback = function (){
            grecaptcha.render('contact-submit', {
                'sitekey': '{!! env('GOOGLE_CAPCHA_SITE_KEY') !!}',
                'callback': onSubmit
            });
        };
        
        function onSubmit()
        {
            var data = $('form').serialize();
            
            var url = '{!! route('page.verify-capcha') !!}';

            $.ajax({
                type: 'post',
                url: url,
                data: data,
                success: function (response){
                    document.theForm.submit();
                },
                error: function (response){
                
                }
            });
        }
        $(document).ready(function (){
            
            $('#contact-submit').on('click', function (){
                $(this).attr('disabled', true);
                $(this).css('opacity', 0.7);
                $(this).html('Sending...');
            });
        });
    </script>
@endsection
