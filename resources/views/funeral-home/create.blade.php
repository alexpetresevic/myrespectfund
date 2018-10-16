@extends('layouts.app')

@section('content')
    <div class="signup-section">
        <div class="container">
            <div class="offset-lg-1 col-lg-10 offset-sm-0 col-sm-12 offset-0 col-12">
                <div class="signup-section__block">
                    <h1>{{ $page->title }}</h1>
                    <div class="d-sm-none d-md-block d-none d-sm-block">
                        {!! $page->body !!}
                    </div>
                    <form id="funeral-home-form" action="{{ route('funeral-home.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Fill In The Form Below</h3>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="name">Your Funeral Home<sup>*</sup></label>
                                    <input id="name" value="{{ old('name') }}" name="name" class="form-control"
                                           type="text" placeholder="home name">
                                    @if($errors->has('name'))
                                        <div class="error">
                                            <p>{{ $errors->first('name') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="contact_name">Contact Name<sup>*</sup></label>
                                    <input id="contact_name"
                                           value="{{ old('contact_name') }}"
                                           name="contact_name" class="form-control" type="text"
                                           placeholder="first name">
                                    @if($errors->has('contact_name'))
                                        <div class="error">
                                            <p>{{ $errors->first('contact_name') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="communities_served">Communities Served<sup>*</sup></label>
                                    <input id="communities_served" value="{{ old('communities_served') }}"
                                           name="communities_served" class="form-control" type="text"
                                           placeholder="Communities Served">
                                    @if($errors->has('communities_served'))
                                        <div class="error">
                                            <p>{{ $errors->first('communities_served') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="email">Email<sup>*</sup></label>
                                    <input id="email" value="{{ old('email') }}" name="email"
                                           class="form-control" type="email" placeholder="email">
                                    @if($errors->has('email'))
                                        <div class="error">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number<sup>*</sup></label>
                                    <input id="phone_number" value="{{ old('phone_number') }}" name="phone_number"
                                           class="form-control" type="tel" placeholder="phone number">
                                    @if($errors->has('phone_number'))
                                        <div class="error">
                                            <p>{{ $errors->first('phone_number') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="address">Address<sup>*</sup></label>
                                    <input id="address" value="{{ old('address') }}" name="address" class="form-control"
                                           type="text" placeholder="address">
                                    <input id="latitude" name="latitude" data-street="" type="hidden" value="">
                                    <input id="longitude" name="longitude" data-street="" type="hidden" value="">
                                    @if($errors->has('address'))
                                        <div class="error">
                                            <p>{{ $errors->first('address') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="zip_code">Zip Code<sup>*</sup></label>
                                    <input id="zip_code" value="{{ old('zip_code') }}" name="zip_code"
                                           class="form-control" type="text" placeholder="zip code">
                                    @if($errors->has('zip_code'))
                                        <div class="error">
                                            <p>{{ $errors->first('zip_code') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="website_url">Website URL</label>
                                    <input id="website_url" value="{{ old('website_url') }}" name="website_url"
                                           class="form-control" type="text" placeholder="url">
                                    @if($errors->has('website_url'))
                                        <div class="error">
                                            <p>{{ $errors->first('website_url') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h3>social media</h3>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input id="facebook" value="{{ old('social.facebook') }}" name="social[facebook]"
                                           class="form-control" type="url" placeholder="facebook">
                                    @if($errors->has('social.facebook'))
                                        <div class="error">
                                            <p>{{ $errors->first('social.facebook') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input id="twitter" value="{{ old('social.twitter') }}" name="social[twitter]"
                                           class="form-control" type="url" placeholder="twitter">
                                    @if($errors->has('social.twitter'))
                                        <div class="error">
                                            <p>{{ $errors->first('social.twitter') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input id="google_plus" value="{{ old('social.google_plus') }}"
                                           name="social[google_plus]" class="form-control" type="url"
                                           placeholder="Google+">
                                    @if($errors->has('social.google_plus'))
                                        <div class="error">
                                            <p>{{ $errors->first('social.google_plus') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input id="other" value="{{ old('social.other') }}" name="social[other]"
                                           class="form-control" type="url" placeholder="other">
                                    @if($errors->has('social.other'))
                                        <div class="error">
                                            <p>{{ $errors->first('social.other') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h3>upload image (recommended)</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="upload-photo">
                                    <div class="upload-photo__button">
                                        <input id="upload_image" accept="image/jpeg,image/jpg" value="{{ old('upload_image') }}" name="upload_image" style="margin-bottom: 15px" class="form-control" type="file">
                                        <label id="upload-image-label" for="upload-image">upload photo</label>
                                        @if($errors->has('upload_image'))
                                            <div class="error">
                                                <p>{{ $errors->first('upload_image') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    {{--@if(isset($campaign->image))--}}
                                    {{--<p>No image chosen.</p>--}}
                                    {{--@endif--}}
                                </div>
                            </div>
                            {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                            {{--<input type="url" placeholder="url">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4">--}}
                            {{--<div class="upload-fb__button ">--}}
                            {{--<button type="submit">upload via facebook</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="uploaded-photo">
                            <img id="funeral-home-image-preview" src="#" alt="" style="display: none">
                        </div>
                        {{--<div>--}}
                            {{--<div class="form-check">--}}
                                {{--<div class="checkbox-wrapper">--}}
                                    {{--<label class="control control--checkbox" for="become_partner">--}}
                                        {{--<input type="checkbox" class="remember-checkbox" name="become_partner"--}}
                                               {{--id="become_partner">--}}
                                        {{--Add me as partner--}}
                                        {{--<div class="control__indicator"></div>--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-4 offset-md-4">
                            <div class="signup-button">
                                <button form="funeral-home-form" id="submit-funeral-home">submit</button>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 offset-lg-3">
                            <div class="about-partners">
                                <a target="_blank" data-toggle="modal" data-target="#exampleModal"
                                   href="{{route('page.partnership')}}">Learn about My Respects partners</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $partnership->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! $partnership->body !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api') }}&libraries=places"></script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);
        var latitudeInput = $('#latitude');
        var longitudeInput = $('#longitude');
        var zipCode = '';
        
        $('#address').on('blur', function (){
            if ($('#address').val() !== latitudeInput.attr('data-street')) {
                latitudeInput.val('');
                latitudeInput.attr('data-street', '');
                longitudeInput.val('');
                longitudeInput.attr('data-street', '');
                $('#zip_code').val(zipCode);
            }
        });
        
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
//                var address = $('#address').val();
//                $('#address').val(address.substring(0, address.indexOf(',')));
                $('#zip_code').val(zipCode);
                
                latitudeInput.val(place.geometry.location.lat());
                latitudeInput.attr('data-street', place.name);
                longitudeInput.val(place.geometry.location.lng());
                longitudeInput.attr('data-street', place.name);
                
            });
        }
        
        $('#address').on('keydown', function (e){
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
        
        $('#submit-funeral-home').on('click', function (e){
            e.preventDefault();
            if ($('#address').val() !== latitudeInput.attr('data-street')) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': $('#address').val() + ',' + $('#zip_code').val()}, function (results, status){
                    latitudeInput.val(results[0].geometry.location.lat());
                    longitudeInput.val(results[0].geometry.location.lng());
                    $('#funeral-home-form').submit();
                });
            }else {
                $('#funeral-home-form').submit();
            }
        });
    </script>
    <script>
        $('#upload_image').on('change', function (){
            var reader = new FileReader();
            reader.onload = function (ev){
                $('#funeral-home-image-preview').attr('src', ev.target.result).css('display', 'block');
                $('#funeral-home-image-preview').after('<span id="img-remove">&times;</span>');
            };
            reader.readAsDataURL(this.files[0]);
        });
        
        $(document).on("click", "#img-remove", function (){
            $('#funeral-home-image-preview').hide();
            $('#funeral-home-image-preview').attr('src', '');
            $('#upload_image').val('');
            $('#img-remove').remove();
        });
    
    </script>
@endsection
