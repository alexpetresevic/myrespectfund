@extends('layouts.app')

@section('content')
    
    <div class="signup-section">
        <div class="container">
            <div class="offset-lg-3 col-lg-6 offset-md-1 col-md-10 offset-0 col-12">
                <div class="signup-section__block">
                    {{--<p>Please fill out the information below and we will add you to our database. </p>--}}
                    @php
                        $action = request()->has('start-campaign') ? url('/register?start-campaign=1') : url('/register');
                    @endphp
                    @if(request()->has('start-campaign'))
                        <h1>Create Your Fundraiser</h1>
                    @else
                        <h1>Sign Up</h1>
                    @endif
                    <form role="form" method="POST" action="{{ $action }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="first_name">first name<sup>*</sup></label>
                            <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="first name" required>
                            @if ($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="last_name">last name<sup>*</sup></label>
                            <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="last name" required>
                            @if ($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">email<sup>*</sup></label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">password<sup>*</sup></label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">confirm password<sup>*</sup></label>
                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required placeholder="confirm password">
                        </div>
                        <div class="signin-button">
                            <button type="submit">continue</button>
                        </div>
                        <div class="signin-fb__button">
                            @if(app('request')->input('start-campaign'))
                                <a href="{{ route('facebook.signin', ['start_campaign' => true]) }}">sign in via facebook</a>
                            @else
                                <a href="{{ route('facebook.signin') }}">sign in via facebook</a>
                            @endif
                        </div>
                        <div class="signup-member">
                            <p>already a member? <a href="{{ route('login') }}" class="forgot-password">sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
