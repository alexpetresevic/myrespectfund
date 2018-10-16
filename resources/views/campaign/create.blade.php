@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('campaign.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row" id="step-1">
                <h1 class="col-sm-12 text-center">Step 1 - Sign up</h1>
                <div class="col-sm-4">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text" value="">
                    @if($errors->has('name'))
                        {{ $errors->first('name') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="address">Address</label>
                    <input class="form-control" id="address" name="address" type="text" value="">
                    @if($errors->has('address'))
                        {{ $errors->first('address') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="text" value="">
                    @if($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="phone_number">Phone number</label>
                    <input class="form-control" id="phone_number" name="phone_number" type="text" value="">
                    @if($errors->has('phone_number'))
                        {{ $errors->first('phone_number') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="zip_code">Your Zip Code</label>
                    <input class="form-control" id="zip_code" name="zip_code" type="text" value="">
                    @if($errors->has('zip_code'))
                        {{ $errors->first('zip_code') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="social_security_number">Social Security Number</label>
                    <input class="form-control" id="social_security_number" name="social_security_number" type="text">
                    @if($errors->has('social_security_number'))
                        {{ $errors->first('social_security_number') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="date_of_birth">Birth date</label>
                    <input class="form-control" id="date_of_birth" name="date_of_birth" type="text">
                    @if($errors->has('date_of_birth'))
                        {{ $errors->first('date_of_birth') }}
                    @endif
                </div>
                <div class="w-100"></div>
                <a id="step-1-continue" class="btn btn-primary" href="javascript:void(0);">Continue</a>
            </div>
            <div class="row" id="step-2" style="display: none;">
                <h1 class="col-sm-12 text-center">Step 2 - Campaign Goals, Title & Photo</h1>
                <div class="col-sm-4">
                    <label for="campaign_end">Add your goal</label>
                    <input class="form-control" id="campaign_end" name="campaign_end" type="text" value="">
                    @if($errors->has('campaign_end'))
                        {{ $errors->first('campaign_end') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="title">Give your fundraiser a title</label>
                    <input class="form-control" id="title" name="title" type="text" value="">
                    @if($errors->has('title'))
                        {{ $errors->first('title') }}
                    @endif
                </div>
                <div class="col-sm-4">
                    <label for="image">Add an image</label>
                    <input class="form-control" id="image" name="image" type="file" value="">
                    <p>(you can change it at any time)</p>
                    @if($errors->has('image'))
                        {{ $errors->first('image') }}
                    @endif
                </div>
                <div class="w-100"></div>
                <a id="step-2-continue" class="btn btn-primary" href="javascript:void(0);">Continue</a>
            </div>
            <div class="row" id="step-3" style="display: none;">
                <h1 class="col-sm-12 text-center">Step 3 - Tell Us Your Story</h1>
                <textarea class="col-sm-12" name="campaign_story" id="campaign_story" cols="30" rows="10"></textarea>
                <a id="step-3-continue" class="btn btn-primary" href="javascript:void(0);">Continue</a>
            </div>
            <div class="row" id="step-4" style="display: none;">
                <h1 class="col-sm-12 text-center">Step 4 - Find a Funeral Home</h1>
                <div class="col-sm-4">
                    <input class="form-control" id="search" name="search" type="text" value="">
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-primary" id="search_button" href="javascript:void(0)">Search</a>
                </div>
                <div class="w-100"></div>
                <a id="step-4-continue" class="btn btn-primary" href="javascript:void(0);">Continue</a>
            </div>
            <div class="row" id="step-5" style="display: none;">
                <h1 class="col-sm-12 text-center">Step 5 - Share and complete</h1>
                <div class="col-sm-12">
                    <a class="btn btn-primary text-center">Facebook</a>
                    <a class="btn btn-primary text-center">Twitter</a>
                    <a class="btn btn-primary text-center">Google</a>
                </div>
                <button id="campaign-submit" class="btn btn-primary">Button</button>
            </div>
        </form>
    </div>
@endsection
