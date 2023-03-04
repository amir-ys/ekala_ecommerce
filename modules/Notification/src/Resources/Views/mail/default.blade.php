@component('mail::message')
    # {{ $title }}

    {{ $text }}

    ممنون ,
    {{ config('app.name') }}
@endcomponent
