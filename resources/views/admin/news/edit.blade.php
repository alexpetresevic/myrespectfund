@extends('layouts.admin')

@section('title')
    <i class="fas fa-newspaper"></i> Press
@endsection

@section('subtitle', 'Edit')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form id="news-update-form" action="{{ route('admin.news.update', ['news' => $news]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="question">Title</label>
                    <input type="text" name="title" class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $news->title) }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="answer">body</label>
                    <textarea name="body" id="editor">{{ old('body', $news->body) }}</textarea>
                </div>

                <div class="form-group">
                    @if ($news->image()->exists())
                       <img src="{{asset('uploads/press/' . $news->image->filename)}}" height="100">
                    @endif
                    <label for="file">Image</label>
                    <input name="file" type="file" accept="image/*">
                </div>

                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.news.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="news-update-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
@endsection
