@extends('layouts.admin')

@section('title')
    <i class="fas fa-file-alt"></i> Page
@endsection
@section('subtitle', 'Edit')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form name="edit-page-form" action="{{ route('admin.pages.update', ['page' => $page->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" class="form-control input-lg{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $page->title) }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="is-invalid" id="editor">{{ old('body', $page->body) }}</textarea>
                </div>
                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.pages.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
    <script>
        $(document).ready(function (){
            $('.note-icon-code').on('click', function (){
                if(!$(this).parent('button').hasClass('active'))
                {
                    alert('Do NOT use this section! After clicking ok click on the icon again to exit!');
                }
            });
        });
    </script>
@endsection
