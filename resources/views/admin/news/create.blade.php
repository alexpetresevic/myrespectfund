@extends('layouts.admin')

@section('title')
    <i class="fas fa-newspaper"></i> Press
@endsection

@section('subtitle', 'Create')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form id="news-create-form" action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="question">Title</label>
                    <input type="text" name="title" class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="answer">Body</label>
                    <textarea name="body" id="editor">{{ old('body') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="file">Image</label>
                    <input name="file" type="file" accept="image/*">
                </div>

                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.news.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="news-create-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
@endsection
