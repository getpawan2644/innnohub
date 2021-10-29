@component('mail::message')
# {{$subject}}.
{!! $message !!}
@component('mail::button', ['url' => route('single-product',['product'=>$input['product_slug']])])
{{"View Product Page"}}
@endcomponent

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
@endcomponent
