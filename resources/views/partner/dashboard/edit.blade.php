@extends('layouts.app')
@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="campaign_dashboard__block">
                <div class="row">
                    @include('partner.dashboard._header')
                    @include('partner.dashboard._navigation')
                    <div class="col-lg-7">
                        <div class="funeral-home__info">
                            <form method="post" action="{{ route('partner.update') }}">
                                {{ method_field('PATCH') }} {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" value="{{ old('name', $funeralHome->name) }}"
                                                   class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_name">Contact Name</label>
                                            <input type="text"
                                                   value="{{ old('contact_name', $funeralHome->contact_name) }}"
                                                   class="form-control" name="contact_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="communities_served">Communities Served</label>
                                            <input type="text"
                                                   value="{{ old('communities_served', $funeralHome->communities_served) }}"
                                                   class="form-control" name="communities_served" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" value="{{ old('email', $funeralHome->email) }}"
                                                   class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="tel"
                                                   value="{{ old('phone_number', $funeralHome->phone_number) }}"
                                                   class="form-control" name="phone_number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" value="{{ old('address', $funeralHome->address) }}"
                                                   class="form-control" name="address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="zip_code">Zip</label>
                                            <input type="text" value="{{ old('zip_code', $funeralHome->zip_code) }}"
                                                   class="form-control" name="zip_code" required>
                                        </div>
                                    </div>
                                    <?php $social = json_decode($funeralHome->social_media, JSON_OBJECT_AS_ARRAY); ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="social[facebook]">Facebook</label>
                                            <input type="url" value="{{ old('social.facebook', $social['facebook']) }}"
                                                   class="form-control" name="social[facebook]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="social[twitter]">Twitter</label>
                                            <input type="url" value="{{ old('social.twitter', $social['twitter']) }}"
                                                   class="form-control" name="social[twitter]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="social[google_plus]">Google+</label>
                                            <input type="url"
                                                   value="{{ old('social.google_plus', $social['google_plus']) }}"
                                                   class="form-control" name="social[google_plus]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="social[other]">Other</label>
                                            <input type="url" value="{{ old('social.other', $social['other']) }}"
                                                   class="form-control" name="social[other]">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="next-button">
                                        <button type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
