@component('mail::message')

# @lang('Welcome to') {{ config('app.name') }}

@lang('Hi') {{ $name }},

@lang('We are glad to have you on board.')

@if(!is_null($password))
@lang('Your login details are as follows:')

**@lang('Email')**: {{ $email }}

**@lang('Password')**: {{ $password }}

@lang('You can change your password once logged-in.')
@else
@lang('Please ask site administrator to know your login access.')
@endif

@component('mail::button', ['url' => url('login')])
@lang('Visit site')
@endcomponent

@lang('Thanks'),<br>
{{ config('app.name') }}
@endcomponent