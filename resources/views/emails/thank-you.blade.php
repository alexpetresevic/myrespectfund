@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $settings->get('site_title') }}
        @endcomponent
    @endslot
    <h1>{{ $title }}</h1>
    {{ $text }}
    {{ $info }}
    @slot('footer')
        @component('mail::footer')
            © 2018 {{ $settings->get('site_title') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent