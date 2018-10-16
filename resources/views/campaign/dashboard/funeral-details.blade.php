@extends('layouts.app')

@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="campaign_dashboard__block">
                <div class="row">
                    @include('campaign.dashboard._header')
                    @include('campaign.dashboard._navigation')
                    <div class="col-lg-7">
                        <div class="dash-detail__section">
                            @if($funeralHome)
                                <div class="dash-detail__header">
                                    <h1>{{ $funeralHome->name }}</h1>
                                </div>
                                @if(!is_null($funeralHome->image))
                                    <img src="{{ asset('uploads/funeral-homes/' . $funeralHome->image->filename) }}"
                                         alt="">
                                @endif
                            @endif
                            <div class="dash-detail__text">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Phone number </p>
                                    </div>
                                    <div class="col-sm-8">
                                        <a href="tel:{{ $campaign->phone_number }}">{{ $campaign->phone_number }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Funeral Date </p>
                                    </div>
                                    <div class="col-sm-8">
                                        <span>{{ date('d F Y', strtotime($campaign->funeral_date)) }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Funeral Time </p>
                                    </div>
                                    <div class="col-sm-8">
                                        <span>{{ $campaign->funeral_time }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Description </p>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="description-detail">{{ $campaign->campaign_story }}</span>
                                    </div>
                                </div>
                                @if($funeralHome)
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p>Funeral Location </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="campaign-search">
                                    <div class="form-group">
                                        <input id="search-input" class="address" type="search" placeholder="enter a city name">
                                        <button id="search-button"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <div id="map" class="google-map" style="height: 500px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places&callback=initMap">
    </script>
    @if($funeralHome)
        <script>
            function initMap()
            {
                var myLatlng = new google.maps.LatLng('{!! $funeralHome->location->latitude !!}', '{!! $funeralHome->location->longitude !!}');
                
                var myOptions = {
                    zoom: 15, center: myLatlng, mapTypeId: google.maps.MapTypeId.ROADMAP,
                };
                
                map = new google.maps.Map(document.getElementById("map"), myOptions);
                
                var marker = new google.maps.Marker({
                    position: myLatlng,
                });
                marker.setMap(map);
            }
        </script>
    @else
        <script>
            var currentPopup = false;
            var funeralHomesInfo = [];
            
            function initMap()
            {
                var myLatlng = new google.maps.LatLng(40.779502, -73.967857);
                
                var myOptions = {
                    zoom: 10, center: myLatlng, mapTypeId: google.maps.MapTypeId.ROADMAP, styles: [
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
    
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': '{!! $campaign->address !!}'}, function (results, status){
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        map.setZoom(10);
                    }
                });
                
                google.maps.event.addListener(map, 'click', function (){
                    if (currentPopup) {
                        currentPopup.close();
                    }
                });
                
                var popup = new google.maps.InfoWindow();
    
                initAutocomplete(map, popup);
                
                addMarkersToMap(map, popup);
                
                google.maps.event.addListener(map, 'dragend', function (e){
                    addMarkersToMap(map, popup);
                });
                
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
                                lat: location.mp_latitude, lng: location.mp_longitude
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
                            var content = '<div id="content" class="affiliate-info" >' + img + '<form class="campaign-map__pin" method="post" action="{!! route('campaign.add-funeral-home', ['id' => $campaign->id]) !!}">{!! csrf_field() !!}<div class="map-marker__info">' + '<h4>' + funeralHomeName + '</h4>' + '<p>' + funeralHomePhone + '</p>' + '<input type="hidden" name="funeral_home_id" value="' + funeralHomeId + '"><button class="add-funeral-button" type="submit">Add Funeral Home</button></div>' + '</div></form>';
                            google.maps.event.addListener(marker, 'click', function (evt){
                                currentPopup = popup;
                                popup.setContent(content);
                                popup.open(map, marker);
                            });
                            return marker;
                        });
                        
                        new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                        
                    }
                });
            }

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
            function addFuneralHome(id, name)
            {
                if ($('.addedTag').css('display') === 'block') {
                    $('.addedTag').css('display', 'none');
                }
                
                $('.addedTag').fadeIn(1000);
                $('#funeral-home-input').val(id);
                $('#funeral-home-name').html(name);
            }
        </script>
    @endif
@endsection
