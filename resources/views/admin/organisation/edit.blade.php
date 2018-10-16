@extends('layouts.admin')

@section('title')
    <i class="fas fa-id-card"></i> Organization
@endsection
@section('subtitle', 'Edit')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form id="create-organization-form" action="{{ route('admin.organization.update', ['organisation' => $organisation->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @if ($organisation->image()->exists())
                        <img src="{{asset('uploads/organisations/' . $organisation->image->filename)}}" width="auto">
                    @endif
                    <hr>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $organisation->name) }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="url">Website URL</label>
                        <input type="url" name="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" value="{{ old('url', $organisation->url) }}">
                        @if ($errors->has('url'))
                            <div class="invalid-feedback">
                                {{ $errors->first('url') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input name="image" type="file" accept="image/*">
                    </div>

                    <div class="form-check">
                        <input type="hidden" name="url_new_window" value="0">
                        <input type="checkbox" class="form-check-input" name="url_new_window" id="url_new_window" value="1" checked>
                        <label class="form-check-label" for="url_new_window">Open link in new window/tab</label>
                    </div>
                    <br>
                    <div class="form-group">
                        <a class="btn btn-danger" href="{{ route('admin.organization.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                        <button type="submit" form="create-organization-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()
