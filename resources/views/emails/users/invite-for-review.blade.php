@component('mail::message')
{{--# {{$subject}}--}}

{!! $en_message !!}

@component('mail::button',['url' => $url])
{{Lang::get('content.rate_product',[],"en")}}
@endcomponent
<br/>---------------------------------------------------------------------------------------------<br/>
{!! $ar_message !!}
@component('mail::button',['url' => $url])
    {{Lang::get('content.rate_product',[],"ar")}}
@endcomponent

{{--{{Lang::get('content.thanks',[],"en")}},<br>--}}
{{--{{ config('app.name') }}--}}
@endcomponent
