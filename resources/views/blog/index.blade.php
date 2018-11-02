@extends('layouts.app')

@section('content')
    <div class="news-section">
        <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10">
            <div class="news__block">
                <h1 class="blog-header">MyRespects Blog</h1>
                <div class="news__items">
                    <div class="row">
                        <div class="col-lg-8">
                            
                            @foreach($posts as $post)
                                <div class="single-news news__item">
                                    <div class="single-news__text">
                                        <h2>
                                            <a href="{{ route('blog.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                        </h2>
                                        <div class="cat-tags">
                                            @if($post->categories()->exists())
                                                <p>{{ str_plural('Category', count($post->categories)) }}: </p>
                                                @foreach($post->categories as $key => $category)
                                                    <span><a href="{{ route('blog.filter', ['category' => $category->id]) }}">{{ $category->name }}</a></span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="single-blog__content">
                                            <div class="single-blog__img">
                                                @if($post->image)

                                                    <a href="{{ route('blog.show', ['slug' => $post->slug]) }}"><img id="post-image" src="{{ asset('uploads/posts/' . $post->image->filename) }}" alt=""></a>
                                                @endif
                                            </div>
                                            <div class="single-blog__text">
                                                <p>{!! str_limit(strip_tags($post->body), 200) !!}</p>
                                            
                                            </div>
                                            <div class="post_author">
                                                <div class="post_img">
                                                    {{-- @if($post->author->image)
                                                        <img id="profile-image"
                                                             src="{{ asset('uploads/users/' . $post->author->image->filename) }}" alt="">
                                                    @else
                                                        <img id="profile-image" src="{{ asset('/img/noavatar.jpg') }}" alt="">
                                                    @endif --}}
                                                    <img id="profile-image" src="{{ $post->author->image ? asset('uploads/users/' . $post->author->image->filename) : asset('/img/noavatar.jpg') }}" alt="">
                                                </div>
                                                <div class="post_text">
                                                    <p>{{ $post->author->first_name }} {{ $post->author->last_name }}</p>
                                                    <p><span>{{ $post->created_at->format('M d') }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="read-more__link">
                                        <a href="{{ route('blog.show', ['slug' => $post->slug]) }}">Read
                                            more</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-4">
                            <div class="category-block">
                                <h2>Blog Categories</h2>
                                <div class="row">
                                    @foreach($categories as $category)
                                        <div class="col-md-6">
                                            <p>
                                                <a href="{{ route('blog.filter', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="category-block">
                                <h2>Blog Tags</h2>
                                <div class="row">
                                    @foreach($tags as $tag)
                                        <div class="col-md-6">
                                            <p>
                                                <a href="{{ route('blog.filter.tag', ['tag' => $tag->id]) }}">{{ $tag->name }}</a>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($posts->hasMorePages())
                    <div class="col-lg-12">
                        <div class="more-button">
                            <button class="load_more_button">More</button>
                        </div>
                    </div>
                    <div style="display: none;">{{ $posts->links('vendor.pagination.bootstrap-4') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    @if ($posts->hasMorePages())
        <script>
            $(document).ready(function (){
                $('.news__items').infiniteScroll({
                    path: '.pagination li.active + li a', append: '.news__item', prefil: true, history: false, hideNav: '.pagination', scrollThreshold: false, button: '.load_more_button'
                })
            })
        </script>
    @endif
@endsection
