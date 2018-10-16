@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $settings->get('site_title') }}
        @endcomponent
    @endslot
# {{ $data['subject'] }}
From: {{ $data['name'] }} <{{ $data['email'] }}>

{{ $data['message'] }}
    @slot('footer')
        @component('mail::footer')
            © 2018 {{ $settings->get('site_title') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
