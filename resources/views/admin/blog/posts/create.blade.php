@extends('layouts.admin')

@section('title')
    <i class="fas fa-thumbtack"></i> Posts
@endsection

@section('subtitle', 'Create')

@section('content')
    <form id="faq-create-form" action="{{ route('admin.blog.posts.store') }}" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
            <div class="block block-rounded block-bordered">
                <div class="block-content">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="question">Title</label>
                        <input type="text" name="title"
                               class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') }}">
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
    
                    @include('admin._post-image.post-image-html')

                    <div class="form-group">
                        <a class="btn btn-danger" href="{{ route('admin.blog.posts.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                        <button type="submit" form="faq-create-form" class="btn btn-success"><i class="fas fa-save"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="block block-rounded block-bordered">
                <div class="block-header">
                    <h3 class="block-title" style="display: inline-block">Publish</h3>
                    <div class="block-options-simple">
                        <input type="hidden" name="published" value="0">
                        <label class="css-input switch switch-sm switch-primary" style="margin: 0">
                            <input type="checkbox" name="published" value="1"><span></span>
                        </label>
                    </div>
                </div>

                <div class="block-header">
                    <h3 class="block-title">Categories</h3>
                </div>

                <div class="block-content">
                    @foreach($categories as $category)
                        <div class="checkbox">
                            <label class="css-input css-checkbox css-checkbox-primary">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"><span></span>
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="block-header">
                    <h3 class="block-title">Tags</h3>
                </div>

                <div class="block-content">
                    @foreach($tags as $tag)
                        <div class="checkbox">
                            <label class="css-input css-checkbox css-checkbox-primary">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"><span></span>
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection()

@section('script')
    @include('admin._summernote')
    @include('admin._post-image.post-image-js')
@endsection
