@extends('layouts.admin')

@section('title')
    <i class="fas fa-th"></i> Category
@endsection

@section('subtitle', 'Edit')

@section('content')
    <form id="faq-create-form" action="{{ route('admin.blog.categories.update', ['category' => $category->id]) }}" method="post">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="form-group">
                    <label for="question">Name</label>
                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $category->name) }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('admin.blog.categories.index') }}"><i class="fas fa-times-circle"></i> Cancel</a>
                    <button type="submit" form="faq-create-form" class="btn btn-success"><i class="fas fa-save"></i>Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection()
