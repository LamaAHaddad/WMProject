@component('mail::message')
# Welcom , {{$user->name}}

Thanks for your registration,

@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/user/login', 'color'=> 'error'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
