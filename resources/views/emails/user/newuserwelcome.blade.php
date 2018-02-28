@component('mail::message')
# Introduction
Obrigado por seu cadastro.!
Bem vindo ao Portifolio Gestor.

@component('mail::button', ['url' => 'http://portifolio.gestor.com'])
#Button Text

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
