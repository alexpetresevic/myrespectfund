@extends('layouts.app')

@section('content')
    <div class="news-section">
        <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10">
            <div class="news__block">
                <h1>Find A Funeral Home</h1>
                <div class="campaign-section__block">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="campaign-search">
                                <div class="form-group">
                                    <input id="search-input" placeholder="City" type="text" name="city"
                                           class="form-control form-control-lg">
                                    <button id="search-button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div id="map" class="google-map" style="height: 500px;"></div>
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
            src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places&callback=initMap"></script>
    <script>
        var currentPopup = false
        var locations = []
        var funeralHomesInfo = []
        var markers = []
        var markerCluster
        var map
        
        function initMap()
        {
            var myLatlng = new google.maps.LatLng(39.8090718,-98.5642993)
            
            var myOptions = {
                zoom: 10.4, center: myLatlng, mapTypeId: google.maps.MapTypeId.ROADMAP, styles: [
                    {
                        featureType: 'poi.business', stylers: [
                            {visibility: 'off'}
                        ]
                    }, {
                        featureType: 'transit', elementType: 'all', stylers: [{visibility: 'off'}]
                    }, {
                        featureType: 'transit.station', elementType: 'all', stylers: [{visibility: 'off'}]
                    }, {
                        featureType: 'poi', elementType: 'all', stylers: [{visibility: 'off'}]
                    }, {
                        featureType: 'poi.park', elementType: 'all', stylers: [{visibility: 'off'}]
                    }, {
                        featureType: 'poi.park', elementType: 'all', stylers: [{visibility: 'off'}]
                    }
                ]
            }
            map = new google.maps.Map(document.getElementById('map'), myOptions)
            
            google.maps.event.addListener(map, 'click', function (){
                if (currentPopup) {
                    currentPopup.close()
                }
            })
            
            popup = new google.maps.InfoWindow()
            
            initAutocomplete(map, popup)
            
            google.maps.event.addListener(map, 'dragend', function (){
                clearMarkers(null)
                addMarkersToMap(map, popup)
            })
            
            function addMarkersToMap(map, popup)
            {
                var latitude = map.getCenter().lat()
                var longitude = map.getCenter().lng()
                
                var data = {
                    latitude: latitude, longitude: longitude
                }
                
                $.ajax({
                    type: 'GET', url: '{!! route('campaign.load-pins') !!}', data: data, success: function (response){
                        markers = response.map(function (location, i){
                            var funeralHomeEmail = validateEmail(location.fh_email) ? '<a class="send-email" href="mailto:' + location.fh_email + '?subject=MyRespects.com Funeral Home Inquiry">contact us</a>' : 'no email provided';
                            var funeralHomeName = location.fh_name
                            var funeralHomePhone = location.fh_phone
                            var funeralHomeId = location.fh_id
                            var funeralHomeImage = location.fil_filename
                            
                            var location = {
                                lat: parseFloat(location.mp_latitude), lng: parseFloat(location.mp_longitude)
                            }
                            
                            var marker = new google.maps.Marker({
                                position: location,
                            })
                            
                            if (funeralHomeImage !== null) {
                                var img = '<img src="{{asset('uploads/funeral-homes/')}}/' + funeralHomeImage + ' "/>'
                            }else {
                                var img = '<img src="{{asset('/img/noavatar.jpg')}}"/>'
                            }
                            
                            //                  var content = '<div id="content" class="affiliate-info" >' + img + '<div class="map-search__info">' + '<h4>' + funeralHomeName + '</h4>' + '<p>' + funeralHomePhone + '</p>';
                            var content = '<div id="content" class="affiliate-info" >' + img + '<div class="map-marker__info">' + '<h4>' + funeralHomeName + '</h4>' + '<p>' + funeralHomePhone + '</p>' + funeralHomeEmail + '</div>' + '</div>';
                            
                            google.maps.event.addListener(marker, 'click', function (evt){
                                currentPopup = popup;
                                popup.setContent(content);
                                popup.open(map, marker);
                            });
                            markers.push(marker);
                            return marker;
                        });
                        
                        markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'})
                    }
                })
            }
            
            function validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }
            
            function clearMarkers(map)
            {
                if (markerCluster) {
                    markerCluster.clearMarkers()
                }
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map)
                }
            }
            
            function initAutocomplete(initMap, popup)
            {
                var options = {
                    types: ['(cities)'], componentRestrictions: {country: ['us', 'ca']}
                }
                
                var auto = new google.maps.places.Autocomplete(document.getElementById('search-input'), {types: ['address']})
                auto.setComponentRestrictions({'country': ['ca', 'us']})
                
                auto.addListener('place_changed', function (){
                    var place = auto.getPlace()
                    for (i in place.address_components) {
                        if (place.address_components[i].types == 'postal_code') {
                            var zipCode = place.address_components[i].long_name
                            $('#zip_code').val(zipCode)
                        }
                    }
                    var geocoder = new google.maps.Geocoder()
                    geocoder.geocode({'address': $('#address').val()}, function (results, status){
                        if (status == google.maps.GeocoderStatus.OK) {
                            map.setCenter(results[0].geometry.location)
                            map.setZoom(10)
                            addMarkersToMap(initMap, popup)
                        }
                    })
                })
                
                $('#search-input').on('keydown blur', function (e){
                    if (e.keyCode == 13) {
                        e.preventDefault()
                        var geocoder = new google.maps.Geocoder()
                        geocoder.geocode({'address': $('#search-input').val()}, function (results, status){
                            if (status == google.maps.GeocoderStatus.OK) {
                                map.setCenter(results[0].geometry.location)
                                map.setZoom(10)
                                addMarkersToMap(initMap, popup)
                            }
                        })
                    }
                })
                
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
            }
        }
    </script>
@endsection