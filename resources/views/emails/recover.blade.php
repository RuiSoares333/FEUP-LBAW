@component('mail::message')
Hello! Your credentials have been changed!

Make sure you dont forget them again!

@component('mail::button', ['url' => 'https://lbaw2286.lbaw.fe.up.pt/'])
Go To SLCN
@endcomponent

The {{ config('app.name') }} Team
@endcomponent
