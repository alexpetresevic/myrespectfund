@extends('layouts.app') @section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="campaign_dashboard__block">
                <div class="row">
                    @include('campaign.dashboard._header') @include('campaign.dashboard._navigation')

                    <div class="col-lg-7">

                        <div class="dash-update__section">
                            <div>
                                <div id="dash-img-update" class="dash-update__image">
                                    @if ($campaign->image)
                                        <img id="campaign-image" width="100%"
                                             src="{{ asset('uploads/campaigns/' . $campaign->image->filename) }}">
                                    @else
                                        <img id="campaign-image" width="100%" src="{{ asset('/img/bg_ourtime.png') }}">
                                    @endif
                                    <div class="image-update">
                                        {{--<input class="form-control" id="upload-image" name="image" type="file" value="">--}}
                                        <label id="upload-image-label" for="edit-image">edit</label>
                                    </div>
                                    <div id="progressbar" class="prog-bar__dash" style="display: none;">
                                        <div id="progressbar-uploading" class="prog-bar__uploading"></div>
                                        <div class="upload-text"></div>
                                    </div>
                                </div>
                            </div>

                            <div id="dash-update-details" class="update-form__section">
                                <h3>Post An Update</h3>
                                <form method="post" action="{{ route('campaign.dashboard.post-update') }}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="campaign-id" name="campaign_id"
                                           value="{{ $campaign->id }}">
                                    <div class="dash-text__block">
                                        <textarea rows="3" class="form-control" name="body" rows="5"></textarea>
                                    </div>
                                    <div class="dash-update__buttons">
                                        <div class="col-md-6">
                                            <img id="update-image-preview" width="300px" src="#" alt=""
                                                 style="display: none">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="upload-photo">
                                                    <div class="upload-photo__button">
                                                        <input class="form-control" id="upload_image" name="image"
                                                               type="file" value="" style="display: none">
                                                        <label id="upload-image-label" for="upload_image">add
                                                            photo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="dash-date__block">

                                                    @php /*

                                <div class="dash-share__section">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h2>share:</h2>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dash-share">
                                                <div class="form-group">
                                                    <label class="control control--checkbox">

                                                            <input class="remember-checkbox" type="checkbox"
                                                                   name="remember">
                                                            facebook
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dash-share">
                                                <div class="form-group">
                                                    <label class="control control--checkbox">
                                                            <input class="remember-checkbox" type="checkbox"
                                                                   name="remember">
                                                            twitter
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dash-share">
                                                <div class="form-group">
                                                    <label class="control control--checkbox">
                                                            <input class="remember-checkbox" type="checkbox"
                                                                   name="remember">
                                                            google +
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    */ @endphp
                                                    <div class="next-button">
                                                        <button type="submit">update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('stack-script')


    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $('#timepicker').timepicker({scrollbar: true})

    </script>
    <script>
        $('#update_date').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });

    </script>
    <script>
        $('#upload_image').on('change', function () {
            var reader = new FileReader()
            reader.onload = function (ev) {
                $('#update-image-preview').attr('src', ev.target.result).css('display', 'block')
            }
            reader.readAsDataURL(this.files[0])
        })

    </script>
    <script src="{{ asset('/js/dropzone.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false
        var campaignId = $('#campaign-id').val()
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        var myDropzone = new Dropzone('label#upload-image-label', {
            url: '/campaign/upload-image/' + campaignId,
            paramName: 'image',
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
