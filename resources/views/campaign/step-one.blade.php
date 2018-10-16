@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="offset-lg-2 col-lg-8  offset-0 col-12">
                <div class="campaign-section__block">
                    <div class="campaign-section__header">
                        <h1>start a fundraiser</h1>
                        {{--<a href="#0">need help?</a>--}}
                    </div>
                    
                    <div class="step-part__section">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="active-step">
                                    <p><span>1</span>Personal Details</p>
                                </div>
                            </div>
                            <div class="col-md-7">
                                @if($campaign->active)
                                    <div class="done-step">
                                        <p>
                                            <a href="{{ route('campaign.create', ['step' => 'step-2', 'campaign' => encrypt($campaign->id)]) }}"><span>2</span>
                                                Add Campaign Details</a></p>
                                    </div>
                                @else
                                    <div class="inactive-step">
                                        <p><span>2</span> Add Fundraiser Details</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <form id="step-one-form"
                          action="{{ route('campaign.update', ['step' => 'step-1', 'campaign' => encrypt($campaign->id)]) }}"
                          method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{--<div class="row">--}}
                        {{--<div class="col-lg-6">--}}
                        {{--<div class="signin-fb__button">--}}
                        {{--<button>sign in via facebook</button>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-6">--}}
                        {{--<div class="signin-google__button">--}}
                        {{--<button>sign in via google</button>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<p>or</p>--}}
                        <div class="row">
                            {{--git commit -m "campaign create basic js field validation, fundraiser image--}}
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name">First Name<sup>*</sup></label>
                                    <input id="first_name" placeholder="First Name" name="first_name" type="text"
                                           value="{{ old('first_name', auth()->user()->first_name) }}">
                                    @if($errors->has('first_name'))
                                        <div class="error">
                                            <p>{{ $errors->first('first_name') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name<sup>*</sup></label>
                                    <input id="last_name" placeholder="Last Name" name="last_name" type="text"
                                           value="{{ old('last_name', auth()->user()->last_name) }}">
                                    @if($errors->has('last_name'))
                                        <div class="error">
                                            <p>{{ $errors->first('last_name') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date_of_birth">Birth date<sup>*</sup></label>
                                    @php
                                        $dateOfBirth = is_null($campaign->date_of_birth) ? 'today' : $campaign->date_of_birth;
                                    @endphp
                                    <input id="date_of_birth" name="date_of_birth" type="text"
                                           value="{{ old('funeral_date', date('m/d/Y', strtotime($dateOfBirth))) }}">
                                    @if($errors->has('date_of_birth'))
                                        <div class="error">
                                            <p>{{ $errors->first('date_of_birth') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email<sup>*</sup></label>
                                    <input id="email" placeholder="email" name="email" type="email"
                                           value="{{ old('email', auth()->user()->email) }}">
                                    @if($errors->has('email'))
                                        <div class="error">
                                            <p>{{ $errors->first('email') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone_number">Phone number<sup>*</sup></label>
                                    <input id="phone_number" placeholder="Phone Number" name="phone_number" type="tel"
                                           value="{{ old('phone_number', $campaign->phone_number) }}">
                                    @if($errors->has('phone_number'))
                                        <div class="error">
                                            <p>{{ $errors->first('phone_number') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{--<div class="col-lg-6">--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="exampleInputZip1">password<sup>*</sup></label>--}}
                            {{--<input type="text" id="exampleInputzip1" placeholder="zip code">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="social_security_number">Social Security Number<sup>*</sup></label>
                                    <input id="social_security_number" name="social_security_number" type="text"
                                           value="{{ old('social_security_number', $campaign->social_security_number) }}">
                                    @if($errors->has('social_security_number'))
                                        <div class="error">
                                            <p>{{ $errors->first('social_security_number') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="next-button">
                            <button type="submit">next step</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('#date_of_birth').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });
    </script>
    <script>
        $(document).ready(function (){
            if ($('#social_security_number').val().length >= 10){
                var patt = new RegExp("\d{3}[\-]\d{2}[\-]\d{4}");
                var x = document.getElementById("social_security_number");
                var res = patt.test(x.value);
                if(!res){
                    x.value = x.value
                               .match(/\d*/g).join('')
                               .match(/(\d{0,3})(\d{0,2})(\d{0,4})/).slice(1).join('-')
                               .replace(/-*$/g, '');
                }
            }
            
            $('#social_security_number').on('keydown', function (e){
                if($(this).val().length >= 11 && e.keyCode !== 8){
                    e.preventDefault();
                }
                
                var patt = new RegExp("\d{3}[\-]\d{2}[\-]\d{4}");
                var x = document.getElementById("social_security_number");
                var res = patt.test(x.value);
                if(!res){
                    x.value = x.value
                               .match(/\d*/g).join('')
                               .match(/(\d{0,3})(\d{0,2})(\d{0,4})/).slice(1).join('-')
                               .replace(/-*$/g, '');
                }
            });
    
            $("#phone_number").keydown(function (e){
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
            $("#social_security_number").keydown(function (e){
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
    </script>
@endsection
