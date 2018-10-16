@extends('layouts.admin')

@section('title')
    <i class="fas fa-quote-right"></i> Testimonial
@endsection
@section('subtitle', 'Create')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form id="create-organization-form" action="{{ route('admin.testimonial.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Fundraiser</label>
                        <input type="text" name="campaign_name" class="form-control{{ $errors->has('campaign_name') ? ' is-invalid' : '' }}" value="{{ old('campaign_name') }}">
                        @if ($errors->has('campaign_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('campaign_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" >{{ old('body') }}</textarea>
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
@endsection()

@section('script')
    @include('admin._summernote')
    @include('admin._post-image.post-image-js')
@endsection