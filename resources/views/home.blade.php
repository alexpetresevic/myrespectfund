@extends('layouts.app')

@section('content')
    <div class="hero-section">
        <img src="{{asset('/img/bg_hero.jpg')}}" alt="">
        <div class="container">
            <div class="hero-section__text">
                {{--<img src="{{asset('/img/logo-gold.png')}}" alt="">--}}
                <h1>Create Your Free Fundraiser Today</h1>
                <p>Funerals, Cremations, Memorials, And All End Of Life Needs.</p>
                <a href="{{ route('campaign.create') }}">Start Here</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="latest-campaigns">
            <h1>latest fundraisers</h1>
            <div id="funding-slider" class="owl-carousel">
                @foreach($campaigns as $campaign)
                    <div>
                        <a href="{{ route('campaign.show', ['slug' => $campaign->slug]) }}">
                            @if ($campaign->image()->exists())
                                <img src="{{asset('uploads/campaigns/' . $campaign->image->filename)}}" alt="">
                            @else
                                <img src="{{asset('/img/noavatar.jpg')}}" alt="">
                            @endif
                            <h2>{{ $campaign->title }}</h2>
                            
                            <p>${{ number_format($campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }}
                                raised of
                                ${{ number_format($campaign->goal, 2, '.', ',') }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="funeral-home">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="funeral-home__section">
                        <h1>funeral home sign up</h1>
                        <h2>list your funeral home with MyRespects</h2>
                        <p>MyRespects helps families in need of a funeral home to easily find the
                            best local option. Enter your details below to have your funeral home
                            featured in our searchable, national database.</p>
                        <ul class="funeral-home__buttons">
                            <li><a href="{{ route('page.partnership') }}">learn more</a></li>
                            <li><a href="{{ route('funeral-home.create') }}">Sign Up Now</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="funeral-home__logo">
                        <img src="{{asset('/img/logo-gold.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-home">
        <div class="container">
            <h2>latest blog posts</h2>
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-6">
                        <div class="single-blog">
                            <a href="{{ route('blog.show', ['post' => $post->slug]) }}"><h3>{{ $post->title }}</h3></a>
                            @if(isset($post) && $post->image)
                                <div class="admin-image__block">
                                    <a href="{{ route('blog.show', ['post' => $post->slug]) }}"><img id="post-image" src="{{ asset('uploads/posts/' . $post->image->filename) }}" alt=""></a>
                                </div>
                            @endif
                            <div class="blog-text__block">
                                <p>{{ str_limit(strip_tags($post->body), 150) }}</p>
                            </div>
                            <div class="post_author">
                                <div class="post_img">
                                    @if($post->author->image)
                                        <img id="profile-image"
                                             src="{{ asset('uploads/users/' . $post->author->image->filename) }}" alt="">
                                    @else
                                        <img id="profile-image" src="{{ asset('/img/noavatar.jpg') }}" alt="">
                                    @endif
                                </div>
                                <div class="post_text">
                                    <p>{{ $post->author->first_name }} {{ $post->author->last_name }}</p>
                                    <p><span>{{ $post->created_at->format('M d') }}</span></p>
                                </div>
                            </div>
                            <div class="blog-link__block">
                                <a href="{{ route('blog.show', ['post' => $post->slug]) }}">Read more <span><i
                                            class="fas fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col">
                    <div class="next-button">
                        <a href="{{ route('blog.index') }}">All Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="family-msg__section">
        <div class="container">
            <h1>what our users say</h1>
            <p>Tools that helped, in our time of need</p>
            <div class="message-section">
                <div class="col-lg-10 offset-lg-1">
                    <div id="message-slider" class="owl-carousel">
                        @foreach($testimonials as $testimonial)
                            <div>
                                <p>"{{ $testimonial->body }}"</p>
                                @if($testimonial->user)
                                    <h2>{{ $testimonial->user->first_name }} {{ $testimonial->user->last_name }}</h2>
                                    @if($testimonial->user->image)
                                        <img src="{{ asset('uploads/users/' . $testimonial->user->image->filename) }}"
                                             alt="">
                                    @else
                                        <img src="{{asset('/img/noavatar.jpg')}}" alt="">
                                    @endif
                                @else

                                    <h2>{{ $testimonial->campaign_name }}</h2>
                                    @if($testimonial->image)
                                        <img src="{{ asset('uploads/testimonials/' . $testimonial->image->filename) }}"
                                             alt="">
                                    @else
                                        <img src="{{asset('/img/noavatar.jpg')}}" alt="">
                                    @endif                                    
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
