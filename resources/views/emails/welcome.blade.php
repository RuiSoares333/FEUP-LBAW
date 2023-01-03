@component('mail::message')
# Welcome to Super Legit Collaborative News, {{Auth()->user()->username}}!

We hope you have a wonderful time with us!


@component('mail::button', ['url' => 'https://lbaw2286.lbaw.fe.up.pt/'])
Go To SLCN
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
