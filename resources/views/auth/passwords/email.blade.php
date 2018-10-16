@extends('layouts.app')

@section('content')
    <div class="signin-section">
        <div class="container">
            <div class="offset-md-3 col-md-6 offset-sm-2 col-sm-8 offset-1 col-10">
                <div class="signin-section__block">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>reset password</h1>
                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">email address<sup>*</sup></label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email address">

                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="signin-button">
                            <button type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
