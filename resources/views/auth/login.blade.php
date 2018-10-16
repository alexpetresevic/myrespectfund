@extends('layouts.app')

@section('content')
    <div class="signin-section">
        <div class="container">
            <div class="offset-lg-3 col-lg-6 offset-md-2 col-md-8 offset-0 col-12">
                <div class="signin-section__block">
                    <h1>sign in</h1>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">email address<sup>*</sup></label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="email address">
                        </div>
                        <div class="form-group">
                            <label for="password">password<sup>*</sup></label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password">
                        </div>
                        <div class="signin-button">
                            <button type="submit">sign in</button>
                        </div>
                        <p>or</p>
                        <div class="signin-fb__button">
                            <a href="{{ route('facebook.signin') }}">sign in via facebook</a>
                        </div>
                        <div class="forgot-pass">
                            <a href="{{ route('password.request') }}">forgot your password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
