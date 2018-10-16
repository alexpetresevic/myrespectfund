@extends('layouts.app')

@section('content')
    <div class="verify-section">
        <div class="container">
            <div class="offset-lg-1 col-lg-10 offset-md-1 col-md-10 offset-0 col-12">
                <div class="fee-page__block">
                        <h1>{{ $page->title }}</h1>
                        <div class="text-term">{!! $page->body !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection


