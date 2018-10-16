@extends('layouts.admin')

@push('stack-css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush

@section('title')
    <i class="fas fa-building"></i> Fundraiser
@endsection
@section('subtitle', 'Edit')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        @if ($campaign->user_id)
            <p>
                <a class="btn btn-default" href="{{ route('admin.users.edit', ['user' => $campaign->user_id]) }}">Edit Associated User Account</a>
            </p>
        @endif
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form id="news-update-form" action="{{ route('admin.campaigns.update', ['funeral_home' => $campaign]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="title">In Loving Memory Of</label>
                        <input type="text" id="title" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $campaign->title) }}">
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name', $campaign->first_name) }}">
                        @if ($errors->has('first_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('first_name') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name', $campaign->last_name) }}">
                        @if ($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $campaign->email) }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number', $campaign->phone_number) }}">
                        @if ($errors->has('phone_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone_number') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address', $campaign->address) }}">
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" id="zip_code" name="zip_code" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ old('zip_code', $campaign->zip_code) }}">
                        @if ($errors->has('zip_code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('zip_code') }}
                            </div>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="campaign_story">Campaign Story</label>
                        <textarea rows="4" id="campaign_story" name="campaign_story" class="form-control{{ $errors->has('campaign_story') ? ' is-invalid' : '' }}">{{ old('campaign_story', $campaign->campaign_story) }}</textarea>
                        @if ($errors->has('campaign_story'))
                            <div class="invalid-feedback">
                                {{ $errors->first('campaign_story') }}
                            </div>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="goal">Goal</label>
                        <input type="number" name="goal" id="goal" class="form-control{{ $errors->has('goal') ? ' is-invalid' : '' }}" value="{{ old('goal', $campaign->goal) }}">
                        @if ($errors->has('goal'))
                            <div class="invalid-feedback">
                                {{ $errors->first('goal') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="funeral_date">Funeral Date</label>
                        <input type="text" name="funeral_date" id="funeral_date" class="form-control{{ $errors->has('funeral_date') ? ' is-invalid' : '' }}" value="{{ old('funeral_date', $campaign->funeral_date) }}">
                        @if ($errors->has('funeral_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('funeral_date') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="funeral_time">Funeral Time</label>
                        <input type="text" name="funeral_time" id="funeral_time" class="form-control{{ $errors->has('funeral_time') ? ' is-invalid' : '' }}" value="{{ old('funeral_time', $campaign->funeral_time) }}">
                        @if ($errors->has('funeral_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('funeral_time') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="campaign_end">Campaign End</label>
                        <input type="text" name="campaign_end" id="campaign_end" class="form-control{{ $errors->has('campaign_end') ? ' is-invalid' : '' }}" value="{{ old('campaign_end', $campaign->campaign_end) }}">
                        @if ($errors->has('campaign_end'))
                            <div class="invalid-feedback">
                                {{ $errors->first('campaign_end') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-check">
                        <input type="hidden" name="private" value="0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="private" value="1" {{ $campaign->private ? 'checked' : '' }}>
                            Private fundraiser
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input type="hidden" name="featured" value="0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="featured" value="1" {{ $campaign->featured ? 'checked' : '' }}>
                            Featured fundraiser
                        </label>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-danger" href="{{ route('admin.campaigns.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                        <button type="submit" form="news-update-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        @if ($campaign->user_id)
                            @if (DB::table('password_resets')->where('email', $campaign->user->email)->exists())
                                <a disabled="" href="#" onclick="return false;" class="btn btn-info pull-right"><i class="fas fa-envelope-open"></i> Password Reset Email Sent</a>
                            @else
                                <a href="{{ route('admin.send-password-reset-link', ['user' => $campaign->user_id]) }}" class="btn btn-info pull-right"><i class="fas fa-envelope"></i> Send Password Reset Email</a>
                            @endif
                        @endif
                    </div>
                    <input id="latitude" name="latitude" data-street="" type="hidden" value="">
                    <input id="longitude" name="longitude" data-street="" type="hidden" value="">
                </form>
            </div>
        </div>
    </div>
@endsection()
@push('stack-script')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $('#funeral_time').timepicker({scrollbar: true});
    </script>
    <script>
        $('#funeral_date').datepicker({
            changeMonth: true, changeYear: true, yearRange: "-100:+0"
        });
        $('#campaign_end').datepicker({
            changeMonth: true, changeYear: true, yearRange: "-100:+0"
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);
        
        var zipCode = '';
        
        function initialize()
        {
            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'), {types: ['address']});
            autocomplete.setComponentRestrictions({'country': ['ca', 'us']});
            autocomplete.addListener('place_changed', function (){
                var place = autocomplete.getPlace();
                for(i in place.address_components){
                    if (place.address_components[i].types == 'postal_code') {
                        zipCode = place.address_components[i].long_name;
                    }
                }
                $('#zip_code').val(zipCode);
            });
        }

        $('#address').on('keydown', function (e){
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
    </script>
@endpush
