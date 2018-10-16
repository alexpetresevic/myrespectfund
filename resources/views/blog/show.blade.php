@section('facebook-meta')
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:description" content="{{ $post->body }}"/>
    @if ($post->image()->exists())
        <meta property="og:image" content="{{asset('uploads/posts/' . $post->image->filename)}}"/>
        <meta name="twitter:image" content="{{asset('uploads/posts/' . $post->image->filename)}}">
    @endif
@endsection

@extends('layouts.app')

@section('content')
    <div class="blog-page">
        <div class="container">
            <div class="blog-page__section">
                <div class="back-blog">
                    <a href="{{ route('blog.index') }}"><i class="fas fa-arrow-left"></i> back</a>
                </div>
                <h1>{{ $post->title }}</h1>
                <div class="cat-tags">
                    @if($post->categories()->exists())
                        
                        @foreach($post->categories as $key => $category)
                            <span><a href="{{ route('blog.filter', ['category' => $category->id]) }}">{{ $category->name }}</a></span>
                        @endforeach
                    @endif
                </div>
                
                @if(isset($post) && $post->image)
                    <div class="col-md-10 offset-md-1">
                        <div class="admin-image__block">
                            <img id="post-image" src="{{ asset('uploads/posts/' . $post->image->filename) }}" alt="">
                        </div>
                    </div>
                @endif
                <div class="blog-body">
                    <div class="col-md-10 offset-md-1">
                        {!! $post->body !!}
                    </div>
                </div>
                <div class="tag-cloud">
                    @foreach($post->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <hr>
                <div class="blog-share">
                    <h3>share this article on:</h3>
                    <ul class="detail-share__links">
                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="fb-share"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a target="_blank" href="https://twitter.com/home?status={{ url()->current() }}" class="tw-share"><i class="fab fa-twitter-square"></i></a></li>
                        <li><a target="_blank" href="https://plus.google.com/share?url={{ url()->current() }}" class="gg-share"><i class="fab fa-google-plus-square"></i></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" class="li-share"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="fb-comments" data-href="{{ request()->url() }}" data-width="100%" data-numposts="10"></div>
            </div>
        </div>
    </div>
@endsection