@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection

@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="offset-lg-1 col-lg-10  offset-0 col-12">
                <div class="campaign-section__block">
                    <div class="campaign-section__header">
                        <h1>start a fundraiser</h1>
                        {{--<a href="#0">need help?</a>--}}
                    </div>
                    <div class="step-part__section">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="done-step">
                                    <p><a id="campaign-submit"
                                          href="{{ route('campaign.create', ['step' => 'step-1', 'campaign' => encrypt($campaign->id)]) }}"><span>1</span>Personal Details</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="active-step">
                                    <p><span>2</span> Add Fundraiser Details</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('campaign.update', ['step' => 'step-2', 'campaign' => encrypt($campaign->id)]) }}"
                          method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $campaign->id }}" id="dropzone-campaign-id">
                        <p>Your loved ones photo<sup>*</sup></p>
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="upload-photo">
                                    <div class="upload-photo__button">
                                        {{--<input class="form-control" id="upload-image" name="image" type="file" value="">--}}
                                        <label id="upload-image-label" for="upload-image">Upload Here</label>
                                    </div>
                                </div>
                                @if(!$campaign->image)
                                    <p id="no-image">No image chosen.</p>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-8">
                                <div class="upload-fb__button ">
                                    {{--<button id="upload-facebook" type="submit">upload via facebook</button>--}}
                                </div>
                            </div>
                        </div>
                        <div id="progressbar" class="prog-bar" style="display: none;">
                            <div id="progressbar-uploading" class="prog-bar__uploading"></div>
                            <div class="upload-text"><p>Uploading...</p></div>
                        </div>
                        <div class="uploaded-photo">
                            @if($campaign->image)
                                <img id="campaign-image" data-dz-thumbnail="" src="{{url('/uploads/campaigns/' . $campaign->image->filename)}}" alt="">
                                <span id="remove-uploaded-image" class="img-remove">&times;</span>
                            @else
                                <img id="campaign-image" src="#" alt="" style="display: none;">
                                <span id="remove-uploaded-image" class="img-remove">&times;</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="campaign_goal">Add your goal<sup>*</sup></label>
                                    <div class="dollar-sign">
                                        <p>&#36;</p>
                                        <input placeholder="amount" id="campaign_goal" name="goal" type="text" value="{{ old('goal', $campaign->goal) }}">
                                    </div>
                                    @if($errors->has('goal'))
                                        <div class="error">
                                            <p>{{ $errors->first('goal') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="title">In Loving Memory of<sup>*</sup></label>
                                    <input id="title" name="title" placeholder="in loving memory of" type="text"
                                           value="{{ old('title', $campaign->title) }}">
                                    @if($errors->has('title'))
                                        <div class="error">
                                            <p>{{ $errors->first('title') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="address">Address<sup>*</sup></label>
                                    <input id="address" class="address" placeholder="address" name="address" type="text"
                                           value="{{ old('address', $campaign->address) }}">
                                    @if($errors->has('address'))
                                        <div class="error">
                                            <p>{{ $errors->first('address') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="zip_code">Your Zip Code<sup>*</sup></label>
                                    <input id="zip_code" placeholder="zip code" name="zip_code" type="text"
                                           value="{{ old('zip_code', $campaign->zip_code) }}">
                                    @if($errors->has('zip_code'))
                                        <div class="error">
                                            <p>{{ $errors->first('zip_code') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    @php
                                        $funeralDate = is_null($campaign->funeral_date) ? 'today' : $campaign->funeral_date;
                                    @endphp
                                    <label for="datepicker">Funeral Date<sup>*</sup></label>
                                    <input id="datepicker" class="fundraiser-date datepicker" placeholder="funeral date"
                                           name="funeral_date" type="text"
                                           value="{{ old('funeral_date', date('m/d/Y', strtotime($funeralDate))) }}">
                                    @if($errors->has('funeral_date'))
                                        <div class="error">
                                            <p>{{ $errors->first('funeral_date') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="funeral_time">Funeral Time<sup>*</sup></label>
                                    <input placeholder="funeral time" class="timepicker" name="funeral_time" id="funeral_time" type="text"
                                           value="{{ old('funeral_time', $campaign->funeral_time) }}">
                                    @if($errors->has('funeral_time'))
                                        <div class="error">
                                            <p>{{ $errors->first('funeral_time') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="campaign_end">Fundraiser end date<sup>*</sup></label>
                                    <input placeholder="fundraiser end" class="datepicker" name="campaign_end" type="text"
                                           value="{{ old('campaign_end', $campaign->campaign_end) }}">
                                    @if($errors->has('campaign_end'))
                                        <div class="error">
                                            <p>{{ $errors->first('campaign_end') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="campaign-text__section">
                            <div class="form-group">
                                <label for="campaign_story">Your Memorial Message Here<sup>*</sup></label>
                                <textarea name="campaign_story" placeholder="campaign story" id="campaign_story"
                                          cols="30"
                                          rows="10">{{ old('campaign_story', $campaign->campaign_story) }}</textarea>
                                @if($errors->has('campaign_story'))
                                    <div class="error">
                                        <p>{{ $errors->first('campaign_story') }}</p>
                                    </div>
                                @endif
                            </div>

                            {{--<div class="form-check">--}}
                                {{--<input type="hidden" name="private" value="0">--}}
                                {{--<label class="form-check-label">--}}
                                    {{--<input type="checkbox" class="form-check-input" name="private" value="1">--}}
                            {{--Private fundraiser--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            <div class="form-check">
                                <div class="checkbox-wrapper">
                                    <label class="control control--checkbox" for="check_one">
                                        <input type="hidden" name="private" value="0">
                                        <input type="checkbox" class="remember-checkbox" name="private" id="check_one" value="1">
                                        Private Fundraiser

                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <h3>find a funeral home to connect your account to (optional)</h3>
                        <div class="campaign-search">
                            <div class="form-group">
                                <input id="search-input" class="address" type="search" placeholder="enter a city name">
                                <button id="search-button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <input id="funeral-home-input" type="hidden" name="funeral_home_id"
                               value="{{ old('funeral_home_id', $campaign->funeral_home_id) }}">
                        @if(!is_null($campaign->funeralHome))
                            <div class="addedTag" style="display: inline;">
                                <p>
                                    <span id="funeral-home-name">{{ $campaign->funeralHome->name }}</span>
                                    <span class="tagRemove">&times;</span>
                                </p>
                            </div>
                        @else
                            <div class="addedTag" style="display: none;">
                                <p>
                                    <span id="funeral-home-name">Funeral Home added</span>
                                    <span class="tagRemove">&times;</span>
                                </p>
                            </div>
                        @endif

                        <div id="map" class="google-map" style="height: 500px"></div>
                        
                        <div class="next-button">
                            <button type="submit">create your fundraiser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $('.timepicker').timepicker({scrollbar: true});
    </script>
    <script>
        $('.datepicker').datepicker({
            changeMonth: true, changeYear: true, yearRange: "-100:+0"
        });
    </script>
    <script src="{{ asset('/js/dropzone.js') }}"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places&callback=initMap">
    </script>
    <script>
        var currentPopup = false;
        var locations = [];
        var funeralHomesInfo = [];
        var markers = [];
        var markerCluster;
        var map;
        
        $('#address').on('keydown', function (e){
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
        
        function initMap()
        {
            var myLatlng = new google.maps.LatLng(39.8090718,-98.5642993);
            
            var myOptions = {
                zoom: 10.4, center: myLatlng, mapTypeId: google.maps.MapTypeId.ROADMAP, styles: [
                    {
                        featureType: "poi.business", stylers: [
                            {visibility: "off"}
                        ]
                    }, {
                        featureType: 'transit', elementType: 'all', stylers: [{visibility: "off"}]
                    }, {
                        featureType: 'transit.station', elementType: 'all', stylers: [{visibility: "off"}]
                    }, {
                        featureType: 'poi', elementType: 'all', stylers: [{visibility: "off"}]
                    }, {
                        featureType: 'poi.park', elementType: 'all', stylers: [{visibility: "off"}]
                    }, {
                        featureType: 'poi.park', elementType: 'all', stylers: [{visibility: "off"}]
                    }
                ]
            };
            map = new google.maps.Map(document.getElementById("map"), myOptions);
            
            google.maps.event.addListener(map, 'click', function (){
                if (currentPopup) {
                    currentPopup.close();
                }
            });
            
            popup = new google.maps.InfoWindow();
            
            initAutocomplete(map, popup);
            
            google.maps.event.addListener(map, 'dragend', function (){
                clearMarkers(null);
                addMarkersToMap(map, popup);
            });
        }
        
        function clearMarkers(map)
        {
            if (markerCluster) {
                markerCluster.clearMarkers();
            }
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }
        
        function addMarkersToMap(map, popup)
        {
            var latitude = map.getCenter().lat();
            var longitude = map.getCenter().lng();
            
            var data = {
                latitude: latitude, longitude: longitude
            };
            
            $.ajax({
                type: 'GET', url: '{!! route('campaign.load-pins') !!}', data: data, success: function (response){
                    markers = response.map(function (location, i){
                        var funeralHomeName = location.fh_name;
                        var funeralHomePhone = location.fh_phone;
                        var funeralHomeId = location.fh_id;
                        var funeralHomeImage = location.fil_filename;
                        
                        var location = {
                            lat: parseFloat(location.mp_latitude), lng: parseFloat(location.mp_longitude)
                        }
                        
                        var marker = new google.maps.Marker({
                            position: location,
                        });
                        
                        if (funeralHomeImage !== null) {
                            var img = '<img src="{{asset('uploads/funeral-homes/')}}/' + funeralHomeImage + ' "/>';
                        }else {
                            var img = '<img src="{{asset('/img/noavatar.jpg')}}"/>';
                        }
                        
                        google.maps.event.addListener(map, 'tilt_changed', function (evt){
                            if ($('#funeral-home-input').val() == location.fh_id) {
                                addFuneralHome(funeralHomeId, funeralHomeName);
                            }
                        });
                        
                        var content = '<div id="content" class="affiliate-info" >' + img + '<div class="map-marker__info">' + '<h4>' + funeralHomeName + '</h4>' + '<p>' + funeralHomePhone + '</p>' + '<a class="add-funeral-button" href="javascript:void(0)" onclick="addFuneralHome(' + funeralHomeId + ',\'' + funeralHomeName + '\')">add funeral home</a>' + '</div>' + '</div>';
                        google.maps.event.addListener(marker, 'click', function (evt){
                            currentPopup = popup;
                            popup.setContent(content);
                            popup.open(map, marker);
                        });
                        markers.push(marker);
                        return marker;
                    });
                    
                    markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                    
                }
            });
        }
        
        $('.tagRemove').on('click', function (){
            $('.addedTag').fadeOut(1000);
            
            setTimeout(function (){
                $('#funeral-home-input').val('');
                $('#funeral-home-name').html('');
            }, 1000);
        });
        
        
        function addFuneralHome(id, name)
        {
            if ($('.addedTag').css('display') === 'block') {
                $('.addedTag').css('display', 'none');
            }
            
            $('.addedTag').fadeIn(1000);
            $('#funeral-home-input').val(id);
            $('#funeral-home-name').html(name);
        }
        
        $('#zip_code').on('blur', function (){
            findByZipcode($('#zip_code').val());
        });
        
        function initAutocomplete(initMap, popup)
        {
            var options = {
                types: ['(cities)'], componentRestrictions: {country: ['us', 'ca']}
            };
            
            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('search-input'), options);
            var auto = new google.maps.places.Autocomplete(document.getElementById('address'), {types: ['address']});
            auto.setComponentRestrictions({'country': ['ca', 'us']});
            
            auto.addListener('place_changed', function (){
                var place = auto.getPlace();
                for (i in place.address_components) {
                    if (place.address_components[i].types == 'postal_code') {
                        var zipCode = place.address_components[i].long_name;
                        $('#zip_code').val(zipCode);
                    }
                }
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': $('#address').val()}, function (results, status){
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        map.setZoom(10);
                        addMarkersToMap(initMap, popup);
                    }
                });
            });
            
            //            $('#address').on('blur', function (){
            //                var place = auto.getPlace();
            //
            //                for (i in place.address_components) {
            //                    if (place.address_components[i].types == 'postal_code') {
            //                        var zipCode = place.address_components[i].long_name;
            //                        $('#zip_code').val(zipCode);
            //                    }
            //                }
            //                var geocoder = new google.maps.Geocoder();
            //                geocoder.geocode({'address': $('#address').val()}, function (results, status){
            //                    if (status == google.maps.GeocoderStatus.OK) {
            //                        map.setCenter(results[0].geometry.location);
            //                        map.setZoom(10);
            //                        addMarkersToMap(initMap, popup);
            //                    }
            //                });
            //            });
            
            $('#search-input').on('keydown blur', function (e){
                if (e.keyCode == 13) {
                    e.preventDefault();
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'address': $('#search-input').val()}, function (results, status){
                        if (status == google.maps.GeocoderStatus.OK) {
                            map.setCenter(results[0].geometry.location);
                            map.setZoom(10);
                            addMarkersToMap(initMap, popup);
                        }
                    });
                }
            });
        }
        
        function findByZipcode(zipCode)
        {
            var request = {
                'address': zipCode
            }
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode(request, function (results, status){
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(7);
                    addMarkersToMap(map, popup);
                }
            });
        }
        
        $('#search-input').on('blur', function (e){
            $('#search-button').css('color', 'rgba(0, 0, 0, 0.7)');
            //            $('#search-button').click();
            //            var geocoder = new google.maps.Geocoder();
            //            geocoder.geocode({'address': $('#search-input').val()}, function (results, status){
            //                if (status == google.maps.GeocoderStatus.OK) {
            //                    map.setCenter(results[0].geometry.location);
            //                    map.setZoom(10);
            //                }
            //            });
        });
        
        $('#search-input').on('blur', function (e){
            //            $('#search-button').click();
            //            var geocoder = new google.maps.Geocoder();
            //            geocoder.geocode({'address': $('#search-input').val()}, function (results, status){
            //                if (status == google.maps.GeocoderStatus.OK) {
            //                    map.setCenter(results[0].geometry.location);
            //                    map.setZoom(10);
            //                }
            //            });
        });
        
        function makeInfoWindowEvent(map, infowindow, contentString, marker)
        {
            google.maps.event.addListener(marker, 'click', function (){
                if (currentPopup) {
                    currentPopup.close();
                }
                currentPopup = infowindow;
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
            });
        }
        
        $('#search-button').on('click', function (e){
            e.preventDefault();
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': $('#search-input').val()}, function (results, status){
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(10);
                    addMarkersToMap(map, popup);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function (){
            $("#campaign_goal").keydown(function (e){
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || // Allow: Ctrl+A, Command+A
                    (
                        e.keyCode === 65 && (
                            e.ctrlKey === true || e.metaKey === true
                        )
                    ) || // Allow: home, end, left, right, down, up
                    (
                        e.keyCode >= 35 && e.keyCode <= 40
                    )) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((
                        e.shiftKey || (
                        e.keyCode < 48 || e.keyCode > 57
                        )
                    ) && (
                        e.keyCode < 96 || e.keyCode > 105
                    )) {
                    e.preventDefault();
                }
            });
            $("#zip_code").keydown(function (e){
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || // Allow: Ctrl+A, Command+A
                    (
                        e.keyCode === 65 && (
                            e.ctrlKey === true || e.metaKey === true
                        )
                    ) || // Allow: home, end, left, right, down, up
                    (
                        e.keyCode >= 35 && e.keyCode <= 40
                    )) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((
                        e.shiftKey || (
                        e.keyCode < 48 || e.keyCode > 57
                        )
                    ) && (
                        e.keyCode < 96 || e.keyCode > 105
                    )) {
                    e.preventDefault();
                }
            });
            $("#campaign_goal").keydown(function (e){
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || // Allow: Ctrl+A, Command+A
                    (
                        e.keyCode === 65 && (
                            e.ctrlKey === true || e.metaKey === true
                        )
                    ) || // Allow: home, end, left, right, down, up
                    (
                        e.keyCode >= 35 && e.keyCode <= 40
                    )) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((
                        e.shiftKey || (
                        e.keyCode < 48 || e.keyCode > 57
                        )
                    ) && (
                        e.keyCode < 96 || e.keyCode > 105
                    )) {
                    e.preventDefault();
                }
            });
        });
        
        $('#remove-uploaded-image').on('click', function (e){
            e.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST', url: '{!! route('campaign.upload-image', ['campaign' => $campaign->id]) !!}', data: {
                    _token: CSRF_TOKEN,
                }, success: function (response){
                    $('#campaign-image').attr('src', '').css('display', 'none');
                    $('#remove-uploaded-image').css('display', 'none');
                    $('#no-image').css('display', 'inline-block');
                },
                
            });
        });
        
        Dropzone.autoDiscover = false;
        var campaignId = $('#dropzone-campaign-id').val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var myDropzone = new Dropzone("label#upload-image-label", {
            url: "/campaign/upload-image/" + campaignId, paramName: 'image', autoDiscover: false, maxFiles: 1, acceptedFiles: '.jpeg, .jpg', previewsContainer: false, //            addRemoveLinks: true,
            //            previewsContainer: '#upload-image-div',
            sending: function (file, xhr, formData){
                formData.append("_token", CSRF_TOKEN);
            }, removedfile: function (file){
            }, init: function (){
                this.on("addedfile", function (file){
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                });
                this.on('success', function (file){
                    var reader = new FileReader();
                    
                    reader.onload = function (e){
                        $('#campaign-image').attr('src', e.target.result).css('display', 'block');
                        $('#remove-uploaded-image').css('display', 'block');
                        $('#no-image').css('display', 'none');
                    }
                    
                    reader.readAsDataURL(file);
                });
                this.on('error', function (file, response){
                    $('.error').remove();
                    $('#upload-image-label').after('<div class="error"><p>' + response.errors.image[0] + '</p></div>');
                })
            }
        });
        myDropzone.on("totaluploadprogress", function (progress){
            //            $('#progress-bar').css('width', progress); // progress bar
            $('#progressbar').css('display', 'block');
            $('#no-image').css('display', 'none');
            $('#progressbar-uploading').css('width', Math.round(progress) + '%'); // progress %
            if (progress === 100) {
                $('#progressbar').css('display', 'none');
            }
        });
        window.fbAsyncInit = function (){
            FB.init({
                appId: '{!! config('services.facebook')['client_id'] !!}', autoLogAppEvents: true, xfbml: true, version: 'v2.12'
            });
            FB.api("{!! auth()->user()->facebook_id !!}/photos", function (response){
                if (response && !response.error) {
                    //                        console.log(response);
                }
            }, {access_token: '{!! auth()->user()->facebook_token !!}', scope: 'user_photos'});
        };
        $('#upload-facebook').on('click', function (e){
            e.preventDefault();
            window.fbAsyncInit();
        });
    </script>
@endsection
