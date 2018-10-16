@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $settings->get('site_title') }}
        @endcomponent
    @endslot
    {{ $funeralHome->name }} requested {{ $req }} on {{ $date }} at {{ $time }}
    
    Phone number: {{ $funeralHome->phone_number }}
    
    {{ config('app.name') }}
    @slot('footer')
        @component('mail::footer')
            © 2018 {{ $settings->get('site_title') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
