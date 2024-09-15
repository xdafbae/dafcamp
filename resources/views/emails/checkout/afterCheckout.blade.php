<x-mail::message>
# register Camp: {{ $checkout->Camps->title }}

Hi, {{ $checkout->User->name }}
<br>
Thank you for registering on <b>{{ $checkout->Camps->title }}</b>

<x-mail::button :url="route('user.checkout.invoice', $checkout->id)">
    Button Text
</x-mail::button>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
