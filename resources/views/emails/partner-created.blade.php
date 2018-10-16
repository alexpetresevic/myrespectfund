@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $settings->get('site_title') }}
        @endcomponent
    @endslot
# Partnership account created.

Login details

Username: {{ $username }}

Password: {{ $password }}

@component('mail::button', ['url' => config('app.url').'/login'])
SIGN IN
@endcomponent

Thanks,<br>
{{ $settings->get('site_title') }}
@slot('footer')
    @component('mail::footer')
        © 2018 {{ $settings->get('site_title') }}. All rights reserved.
    @endcomponent
@endslot
@endcomponent
