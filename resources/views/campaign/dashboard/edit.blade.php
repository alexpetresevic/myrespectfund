@extends('layouts.app')

@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="campaign_dashboard__block">
                <div class="row">
                    @include('campaign.dashboard._header')

                    @include('campaign.dashboard._navigation')

                    <div class="col-lg-7">
                        <form method="post" action="{{ route('campaign.dashboard.campaign-update') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">In Loving Memory Of</label>
                                <input class="form-control" type="text" name="title"
                                       value="{{ old('title', $campaign->title) }}">
                                @if($errors->has('title'))
                                    <div class="error">
                                        <p>{{ $errors->first('title') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input class="form-control" type="text" name="first_name"
                                               value="{{ old('first_name', $campaign->first_name) }}">
                                        @if($errors->has('first_name'))
                                            <div class="error">
                                                <p>{{ $errors->first('first_name') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control" type="text" name="last_name"
                                               value="{{ old('last_name', $campaign->last_name) }}">
                                        @if($errors->has('last_name'))
                                            <div class="error">
                                                <p>{{ $errors->first('last_name') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input class="form-control" type="text" name="phone_number"
                                       value="{{ old('phone_number', $campaign->phone_number) }}">
                                @if($errors->has('phone_number'))
                                    <div class="error">
                                        <p>{{ $errors->first('phone_number') }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="campaign_story">Campaign Story</label>
                                <textarea class="form-control" rows="4"
                                          name="campaign_story">{{ old('campaign_story', $campaign->campaign_story) }}</textarea>
                                @if($errors->has('campaign_story'))
                                    <div class="error">
                                        <p>{{ $errors->first('campaign_story') }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="goal">Campaign Goal</label>
                                        <input class="form-control" type="number"
                                               name="goal"
                                               value="{{ old('goal', $campaign->goal) }}">
                                        @if($errors->has('goal'))
                                            <div class="error">
                                                <p>{{ $errors->first('goal') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="funeral_date">Funeral Date</label>
                                        <input id="date-select" class="form-control timepicker date-select" type="text"
                                               name="funeral_date"
                                               value="{{ old('funeral_date', $campaign->funeral_date) }}">
                                        @if($errors->has('funeral_date'))
                                            <div class="error">
                                                <p>{{ $errors->first('funeral_date') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="funeral_time">Funeral Time</label>
                                        <input id="time-select" class="form-control" type="text" name="funeral_time"
                                               value="{{ old('funeral_time', $campaign->funeral_time) }}">
                                        @if($errors->has('funeral_time'))
                                            <div class="error">
                                                <p>{{ $errors->first('funeral_time') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="hidden" name="private" value="0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="private" value="1" {{ $campaign->private ? 'checked' : '' }}>
                                        Private fundraiser
                                    </label>
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
@endsection
@push('stack-script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $('#time-select').timepicker({scrollbar: true});
    </script>
    <script>
        $('.date-select').datepicker({
            changeMonth: true, changeYear: true, yearRange: "-100:+0"
        });
    </script>
@endpush
