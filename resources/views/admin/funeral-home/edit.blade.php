@extends('layouts.admin')

@section('title')
    <i class="fas fa-building"></i> Funeral Home
@endsection
@section('subtitle', 'Edit')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        @if ($funeralHome->user_id)
            <p>
                <a class="btn btn-default" href="{{ route('admin.users.edit', ['user' => $funeralHome->user_id]) }}">Edit Associated User Account</a>
            </p>
        @endif
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form id="fh-update-form" action="{{ route('admin.funeral-homes.update', ['funeral_home' => $funeralHome]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $funeralHome->name) }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_name">Contact Name</label>
                        <input type="text" name="contact_name" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" value="{{ old('contact_name', $funeralHome->contact_name) }}">
                        @if ($errors->has('contact_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contact_name') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="communities_served">Communities Served</label>
                        <input type="text" name="communities_served" class="form-control{{ $errors->has('communities_served') ? ' is-invalid' : '' }}" value="{{ old('communities_served', $funeralHome->communities_served) }}">
                        @if ($errors->has('communities_served'))
                            <div class="invalid-feedback">
                                {{ $errors->first('communities_served') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $funeralHome->email) }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number', $funeralHome->phone_number) }}">
                        @if ($errors->has('phone_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone_number') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address', $funeralHome->address) }}">
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" id="zip_code" name="zip_code" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" value="{{ old('zip_code', $funeralHome->zip_code) }}">
                        @if ($errors->has('zip_code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('zip_code') }}
                            </div>
                        @endif
                    </div>
                    
                    @php $social = json_decode($funeralHome->social_media, JSON_OBJECT_AS_ARRAY) @endphp
                    
                    <div class="form-group">
                        <label for="social[facebook]">Facebook</label>
                        <input type="text" name="social[facebook]" class="form-control{{ $errors->has('social.facebook') ? ' is-invalid' : '' }}" value="{{ old('social.facebook', $social['facebook']) }}">
                        @if ($errors->has('social.facebook'))
                            <div class="invalid-feedback">
                                {{ $errors->first('social.facebook') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="social[twitter]">Twitter</label>
                        <input type="text" name="social[twitter]" class="form-control{{ $errors->has('social.twitter') ? ' is-invalid' : '' }}" value="{{ old('social.twitter', $social['twitter']) }}">
                        @if ($errors->has('social.twitter'))
                            <div class="invalid-feedback">
                                {{ $errors->first('social.twitter') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="social[google_plus]">Google+</label>
                        <input type="text" name="social[google_plus]" class="form-control{{ $errors->has('social.google_plus') ? ' is-invalid' : '' }}" value="{{ old('social.google_plus', $social['google_plus']) }}">
                        @if ($errors->has('social.google_plus'))
                            <div class="invalid-feedback">
                                {{ $errors->first('social.google_plus') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="social[other]">Other</label>
                        <input type="text" name="social[other]" class="form-control{{ $errors->has('social.other') ? ' is-invalid' : '' }}" value="{{ old('social.other', $social['other']) }}">
                        @if ($errors->has('social.other'))
                            <div class="invalid-feedback">
                                {{ $errors->first('social.other') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <a class="btn btn-danger" href="{{ route('admin.funeral-homes.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                        <button type="submit" id="fh-update-button" form="fh-update-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        @if ($funeralHome->user_id)
                            @if (DB::table('password_resets')->where('email', $funeralHome->user->email)->exists())
                                <a disabled="" href="#" onclick="return false;" class="btn btn-info pull-right"><i class="fas fa-envelope-open"></i> Password Reset Email Sent</a>
                            @else
                                <a href="{{ route('admin.send-password-reset-link', ['user' => $funeralHome->user_id]) }}" class="btn btn-info pull-right"><i class="fas fa-envelope"></i> Send Password Reset Email</a>
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
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);
        
        var latitudeInput = $('#latitude');
        var longitudeInput = $('#longitude');
        
        $('#address').on('blur', function (){
            if ($('#address').val() !== latitudeInput.attr('data-street')) {
                latitudeInput.val('');
                latitudeInput.attr('data-street', '');
                longitudeInput.val('');
                longitudeInput.attr('data-street', '');
            }
        });
        
        @if(!$funeralHome->location)
        $('#fh-update-button').on('click', function (e){
            e.preventDefault();
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': $('#address').val() + ',' + $('#zip_code')}, function (results, status){
                if (status === 'OVER_QUERY_LIMIT') {
                    $('#fh-update-form').append('<input type="text" value="You have exceeded your daily request quota for this API!" name="limit_exceeded">')
                    $('#fh-update-form').submit();
                }
                
                if (status == google.maps.GeocoderStatus.OK) {
                    lat = results[0].geometry.location.lat();
                    lng = results[0].geometry.location.lng();
                    latitudeInput.val(lat);
                    longitudeInput.val(lng);
                    $('#fh-update-form').submit();
                }
            });
        });
        
        @endif
        
        function initialize()
        {
            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'), {types: ['address']});
            autocomplete.setComponentRestrictions({'country': ['ca', 'us']});
            autocomplete.addListener('place_changed', function (){
                var place = autocomplete.getPlace();
                $('#zip_code').val('');
                
                latitudeInput.val(place.geometry.location.lat());
                latitudeInput.attr('data-street', place.name);
                longitudeInput.val(place.geometry.location.lng());
                longitudeInput.attr('data-street', place.name);
                
            });
        }
    </script>
@endpush
