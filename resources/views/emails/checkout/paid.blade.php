<x-mail::message>
# Your Transaction Has Been Confirmed

Hi, {{ $checkout->User->name }}
<br>
Your Transaction has been confirmed <b>{{ $checkout->Camps->title }}</b> camp,

<x-mail::button :url="route('user.dashboard')">
    My Dashboard
</x-mail::button>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
