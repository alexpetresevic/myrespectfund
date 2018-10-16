@extends('layouts.app')

@section('content')
    <div class="signup-section">
        <div class="container">
            <div class="offset-md-3 col-md-6 offset-sm-2 col-sm-8 offset-1 col-10">
                <div class="signup-section__block">
                    <h1>Reset Password</h1>
                    <form role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">
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
                            <button type="submit">reset password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
