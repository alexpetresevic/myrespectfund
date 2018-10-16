@extends('layouts.app')

@section('content')
    <div class="start-campaign__section">
        <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
            <div class="block block-rounded block-bordered">
                <div class="block-content">
                    <div class="campaign-section__block">
                        <h1>Edit Profile</h1>
                        <div class="profile-overview">
                            <div class="row">
                                <div class="col-sm-4">
                                    @if($user->image)
                                        <img id="profile-image"
                                             src="{{ asset('uploads/users/' . $user->image->filename) }}" alt="">
                                        <span id="remove-uploaded-image" class="img-remove" style="display: block;">&times;</span>
                                    @else
                                        <img id="profile-image" src="{{ asset('/img/noavatar.jpg') }}" alt="">
                                        <span id="remove-uploaded-image" class="img-remove" style="display: none;">&times;</span>
                                    @endif
                                    <div id="progressbar" class="prog-bar" style="display: none;">
                                        <div id="progressbar-uploading" class="prog-bar__uploading"></div>
                                        <div class="upload-text"><p>Uploading...</p></div>
                                    </div>
                                    <button type="button" id="user-image">upload</button>
                                </div>
                                <div class="col-sm-8">
                                    <ul class="profile-info__list">
                                        <li class="profile-name"><p>{{ $user->first_name }}</p></li>
                                        <li><p>{{ $user->email }}</p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <form id="news-update-form" action="{{ route('user.update') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name"
                                       class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                       value="{{ old('first_name', $user->first_name) }}">
                                @if ($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name"
                                       class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                       value="{{ old('last_name', $user->last_name) }}">
                                @if ($errors->has('last_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       value="{{ old('email', $user->email) }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" name="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                       class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="account-back">
                                        <button type="button" onclick="goBack()">go back</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="next-button">
                                        <button type="submit" form="news-update-form">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('/js/dropzone.js') }}"></script>
    <script>
        $('#remove-uploaded-image').on('click', function (e) {
            e.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST', url: '{!! route('user.delete-picture', ['user' => $user->id]) !!}',
                data: {
                    _token: CSRF_TOKEN,
                }, success: function (response) {
                    $('#profile-image').attr('src', '{!! asset('/img/noavatar.jpg') !!}');
                    $('#remove-uploaded-image').css('display', 'none');
                },

            });
        })

        Dropzone.autoDiscover = false;
        var userId = '{!! $user->id !!}';
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var myDropzone = new Dropzone("button#user-image", {
            url: "/my-profile/upload-picture/" + userId,
            paramName: 'image',
            autoDiscover: false,
            maxFiles: 1,
            acceptedFiles: '.jpeg, .jpg',
            previewsContainer: false, //            previewsContainer: '#upload-image-div',
            sending: function (file, xhr, formData) {
                formData.append("_token", CSRF_TOKEN);
            },
            init: function () {
                this.on("addedfile", function () {
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                });
                this.on('success', function (file) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profile-image').attr('src', e.target.result).css('display', 'block');
                        $('#remove-uploaded-image').css('display', 'block');
                    };

                    reader.readAsDataURL(file);
                });
            }
        });
        myDropzone.on("totaluploadprogress", function (progress) {
            //            $('#progress-bar').css('width', progress); // progress bar
            $('#progressbar').css('display', 'block');
            $('#no-image').remove();
            $('#progressbar-uploading').css('width', Math.round(progress) + '%'); // progress %
            if (progress === 100) {
                $('#progressbar').css('display', 'none');
            }
        });

        function goBack() {
            window.history.back();
        }


    </script>

@endsection