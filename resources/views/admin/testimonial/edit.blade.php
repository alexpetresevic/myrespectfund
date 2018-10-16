@extends('layouts.admin')

@section('title')
    <i class="fas fa-quote-right"></i> Testimonial
@endsection
@section('subtitle', 'Edit')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form id="create-organization-form" action="{{ route('admin.testimonial.update', ['testimonial' => $testimonial->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="name">Fundraiser</label>
                        @if(isset($testimonial->campaign->title))
                            <input type="text" disabled name="campaign_name" class="form-control{{ $errors->has('campaign_name') ? ' is-invalid' : '' }}" value="{{ old('campaign_name', $testimonial->campaign->title) }}">
                        @else
                            <input type="text" name="campaign_name" class="form-control{{ $errors->has('campaign_name') ? ' is-invalid' : '' }}" value="{{ old('campaign_name', $testimonial->campaign_name) }}">
                        @endif
                        @if ($errors->has('campaign_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('campaign_name') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}">{{ old('body', $testimonial->body) }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>

                    @include('admin._post-image.post-image-html')

                    <br>
                    <div class="form-group">
                        <a class="btn btn-danger" href="{{ route('admin.testimonial.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                        <button type="submit" form="create-organization-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin._summernote')
    @include('admin._post-image.post-image-js')
    <script>
        $('#remove-uploaded-image').on('click', function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure?", text: "Image will be deleted.", icon: "warning", buttons: [true, 'Delete']
            }).then(function (value){
                if (value) {
//                    $('#' + form).submit();
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'DELETE',
                        url: '{!! route('testimonial.delete-picture', ['testimonial' => $testimonial->id]) !!}',
                        data: {
                            _token: CSRF_TOKEN,
                        }, success: function (response) {
                            console.log(response);
                            $('#post-image').attr('src', '');
                            $('#remove-uploaded-image').css('display', 'none');
                            $('#post-image-div').show();
                            $('#image-message').hide();
                        },
                    });
                }
            });
        });
    </script>
@endsection