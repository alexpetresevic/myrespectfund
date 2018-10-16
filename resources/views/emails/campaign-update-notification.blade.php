@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $settings->get('site_title') }}
        @endcomponent
    @endslot
# Fundraiser "{{ $campaign->title }}" is updated.
[View Fundraiser]({{ route('campaign.show', ['campaign' => $campaign->slug]) }})
    @slot('footer')
        @component('mail::footer')
            © 2018 {{ $settings->get('site_title') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent