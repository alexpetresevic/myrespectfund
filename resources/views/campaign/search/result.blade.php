@extends('layouts.app')

@section('content')
    <div class="news-section">
        <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 offset-md-0 col-md-12 offset-0 col-12">
            <div class="search__block">
                <h1>search results</h1>
                @if($campaigns->isEmpty())
                    <h2>No results</h2>
                @else
                    @foreach($campaigns as $campaign)
                        <div class="single-search search__item">
                            <div class="row">
                                <div class="offset-lg-0 col-lg-3 col-sm-10 offset-sm-1">
                                    @if($campaign->image)
                                        <a class="search-text__link" href="{{ route('campaign.show', ['campaign' => $campaign->slug]) }}"><img src="{{ asset('uploads/campaigns/' . $campaign->image->filename) }}" style="margin-bottom: 5px"></a>
                                    @endif
                                </div>
                                <div class="offset-lg-0 col-lg-{{ $campaign->image ? '9' : '12' }} col-sm-10 offset-sm-1">
                                    <div class="single-search__text">
                                        <h2>
                                            {{ $campaign->title }}
                                        </h2>
                                        <a class="search-text__link" href="{{ route('campaign.show', ['campaign' => $campaign->slug]) }}"><p>@php $body = strip_tags($campaign->campaign_story) @endphp
                                                {{ str_limit($body, 300) }}</p></a>
                                    </div>
                                    <div class="read-more__link">
                                        <a class="search-text__link" href="{{ route('campaign.show', ['campaign' => $campaign->slug]) }}">View Fundraiser</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
