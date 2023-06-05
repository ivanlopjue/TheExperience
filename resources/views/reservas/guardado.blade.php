@extends('plantillas.layout')
@section('titulo', 'Reserva')
@section('contenido')
<div style="text-align: center">
    <h1 id="nombreRestaurante" class="text-white">- Reserva -</h1>
</div>
{{-- Pagina para verificar que la reserva se ha guardado correctamente, se controla si es un usuario registrado o no --}}
@if (Auth::check())
    <div id="mensaje" style="text-align: center">
        <h3 class="text-white">Gracias por tu reserva, {{ Auth::user()->name }}</h3>
        <p class="text-white">Hemos enviado su localizador: <u><b>{{ $localizador }}</b></u> a tu correo, puedes consultar tus reservas desde <a href="{{ route('reservas.index') }}" class="btn enlace text-white">Mi cuenta</a></p>
    </div>
@else
    <div id="mensaje" style="text-align: center">
        <h3 class="text-white">Gracias por reservar con nosotros</h3>
        <p class="text-white">Hemos enviado su localizador: <u><b>{{ $localizador }}</b></u> a su correo, para modificar o anular su reserva debe llamar a nuestro teléfono de contacto</p>
        <a href="{{ route('reservas.index') }}" class="btn text-white enlace">Volver</a>
    </div>
@endif
@endsection
