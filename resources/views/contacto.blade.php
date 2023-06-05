@extends('plantillas.layout')
@section('titulo', 'Contacto')
@section('contenido')
<div style="text-align: center">
    <h1 id="nombreRestaurante" class="text-white">- Contacto -</h1>
</div>
<div class="conjunto">
    <div class="mapa">
        <iframe src="https://maps.google.com/maps?q=Catedral de León, Plaza de Regla, León&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="100%" height="400"></iframe>
    </div>
    <div class="datos">
        <table class='text-white'>
            <tr>
                <td>Teléfono: 987 12 00 33</td>
            </tr>
            <tr>
                <td>Dirección: Catedral de León, Plaza de Regla, León</td>
            </tr>
            <tr>
                <td>Web: TheExperience.com</td>
            </tr>
        </table>
    </div>
</div>
@endsection
