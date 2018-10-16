@extends('layouts.admin')

@section('title')
    <i class="fas fa-question-circle"></i> FAQ
@endsection

@section('subtitle', 'Create')

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-content">
            <form id="faq-create-form" action="{{ route('admin.faq.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" name="question" class="form-control input-lg{{ $errors->has('question') ? ' is-invalid' : '' }}" value="{{ old('question') }}">
                    @if ($errors->has('question'))
                        <div class="invalid-feedback">
                            {{ $errors->first('question') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="answer">Answer</label>
                    <textarea name="answer" id="editor">{{ old('answer') }}</textarea>
                </div>

                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.faq.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="faq-create-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script')
    @include('admin._summernote')
@endsection
