@extends('layouts.admin')

@section('title')
    <i class="fas fa-newspaper"></i> Toolkit
@endsection

@section('subtitle', 'Create')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form id="faq-create-form" action="{{ route('admin.toolkit.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea name="body" id="editor">{{ old('body') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="body">Upload PDF</label>
                    <input type="file" name="file" accept="application/pdf" class="form-control-file{{ $errors->has('file') ? ' is-invalid' : '' }}">
                    @if ($errors->has('file'))
                        <div class="invalid-feedback">
                            {{ $errors->first('file') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.toolkit.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="faq-create-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
@endsection
