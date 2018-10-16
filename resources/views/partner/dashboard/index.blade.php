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
                            <div class="dash-update__image">
                                @if($user->funeralHome->image)
                                    <img id="campaign-image" width="100%"
                                         src="{{ asset('/uploads/funeral-homes/' . $user->funeralHome->image->filename) }}"
                                         alt="">
                                @else
                                    <img id="campaign-image" width="100%" src="{{asset('/img/bg_ourtime.png')}}" alt="">
                                @endif
                                <div class="image-update">
                                    {{--<input class="form-control" id="upload-image" name="image" type="file" value="">--}}
                                    <label id="upload-image-label" for="edit-image">edit</label>
                                </div>
                            </div>
                            <div id="progressbar" class="prog-bar__dash" style="display: none;">
                                <div id="progressbar-uploading" class="prog-bar__uploading"></div>
                                <div class="upload-text"></div>
                            </div>
                            <div class="funeral-home__text">
                                <h3>Funeral home information</h3>
                                <ul class="partner-info__section">
                                    <li>
                                        <h3>{{ $user->funeralHome->name }}</h3>
                                    </li>
                                    <li>
                                        <p>Address: <span>{{ $user->funeralHome->address }}</span></p>
                                    </li>
                                    <li>
                                        <p>Phone: <a
                                                    href="tel:{{ $user->funeralHome->phone_number }}">{{ $user->funeralHome->phone_number }}</a>
                                        </p>
                                    </li>
                                    <li>
                                        <p>Contact E-Mail: <a
                                                    href="mailto:pd@darte.ca">{{ $user->funeralHome->email }}</a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('stack-script')

    <script src="{{ asset('/js/dropzone.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        var funeralHomeId = '{!! $user->funeralHome->id !!}';
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var myDropzone = new Dropzone('label#upload-image-label', {
            url: '/partner/upload-image/' + funeralHomeId,
            paramName: 'upload_image',
            autoDiscover: false,
            maxFiles: 1,
            acceptedFiles: '.jpeg, .jpg',
            previewsContainer: false, //            previewsContainer: '#upload-image-div',
            sending: function (file, xhr, formData) {
                formData.append('_token', CSRF_TOKEN)
            },
            init: function () {
                this.on('addedfile', function () {
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0])
                    }
                })
                this.on('success', function (file) {
                    var reader = new FileReader()

                    reader.onload = function (e) {
                        $('#campaign-image').attr('src', e.target.result).css('display', 'block')
                        $('#no-image').remove()
                    }

                    reader.readAsDataURL(file)
                })
            }
        })
        myDropzone.on('totaluploadprogress', function (progress) {
            //            $('#progress-bar').css('width', progress); // progress bar
            $('#progressbar').css('display', 'block')
            $('#no-image').remove()
            $('#campaign-image').css('opacity', '0.5')
            $('#progressbar-uploading').css('width', Math.round(progress) + '%') // progress %
            if (progress === 100) {
                $('#progressbar').css('display', 'none')
                $('#campaign-image').css('opacity', '1')
            }
        })

    </script>
@endpush