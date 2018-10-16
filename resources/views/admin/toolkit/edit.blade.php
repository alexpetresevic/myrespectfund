@extends('layouts.admin')

@section('title')
    <i class="fas fa-archive"></i> Toolkit
@endsection

@section('subtitle', 'Edit')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form id="faq-update-form" action="{{ route('admin.toolkit.update', ['toolkit' => $toolkit->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $toolkit->title) }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id="editor">{{ old('body', $toolkit->body) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="body">Upload PDF</label>
                    <input type="file" name="file" class="form-control-file">
                </div>

                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.faq.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="faq-update-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
@endsection
