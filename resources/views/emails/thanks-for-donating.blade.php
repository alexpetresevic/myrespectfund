@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $settings->get('site_title') }}
        @endcomponent
    @endslot
#{{ $title }}

Fundraiser story:

{!! $campaignStory !!}

Funeral address: {{ $address }}
Funeral date:    {{ $funeralDate }}
Funeral time:    {{ $funeralTime }}
    @slot('footer')
        @component('mail::footer')
            © 2018 {{ $settings->get('site_title') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent