@component('mail::message')
Hola,{{ $user->name }},
<p>Estamos cambiando tu clave</p>

@component('mail::button',['url' => url('reset/'.$user->remember_token)])
Reset Contraseña
@endcomponent
<p>En caso no cambir su clave, comunicarse con soporte ingjerson2014@gmail.com/p>
Gracias, <br>
{{ config('app.name') }}
@endcomponent
