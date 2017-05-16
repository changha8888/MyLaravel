<h1> {{ __('language.hello') }} </h1>

{{ __('language.mail_reset') }},

<a href=" {{ env('APP_URL') }}//reset/{{ $user->email }}/{{$code}}"> {{ __('language.click') }} </a>


