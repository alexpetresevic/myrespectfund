@extends('layouts.app')

@section('content')
    <div class="signin-section">
        <div class="container">
            <div class="offset-lg-3 col-lg-6 offset-md-2 col-md-8 offset-0 col-12">
                <div class="signin-section__block">
                    <h1>confirm your password</h1>
                    <i class="fas fa-exclamation-triangle" style="color:#d6be69; font-size: 35px; margin-bottom: 20px;"></i>
                    <p>Are you sure you want to unpublish your fundraiser? This action cannot be undone.</p>
                    <form method="POST" action="{{ route('campaign.dashboard.campaign-destroy') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="password">password<sup>*</sup></label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password">
                        </div>
                        <div class="signin-button">
                            <button type="submit">confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
