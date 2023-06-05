@extends('plantillas.layout')
@section('titulo', 'Reserva')
@section('contenido')
<div style="text-align: center">
    <h1 id="nombreRestaurante" class="text-white">- Modificar Reserva -</h1>
</div>
{{-- Confiramcion de que la reserva a sido editada --}}
<div id="mensaje" style="text-align: center">
    <h3 class="text-white">{{ Auth::user()->name }}, su reserva con el localizador " <u>{{ $localizador }}</u> " se ha moficado correctamente</h3>
    <p class="text-white"><a href="{{ route('reservas.index') }}" class="btn enlace text-white">Mi cuenta</a></p>
</div>
@endsection
