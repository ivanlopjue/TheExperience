@extends('plantillas.layout')
@section('titulo', 'Historia')
@section('contenido')
    <div style="text-align: center">
        <h1 id="nombreRestaurante" class="text-white">- La historia {{ $nombre }} -</h1>
    </div>
    <div style="display: flex; flex-direction: column; max-width: 1000px; margin: 0 auto; ">
        <p class="text-white" style="margin-top: 40px">
            {{ $nombre }} fue fundado en el año 2005 por un joven chef llamado Juan. Después de haber trabajado en varios restaurantes de renombre, Juan decidió abrir su propio negocio en el que pudiera compartir su pasión por la comida y crear una experiencia única para sus comensales.
            Con el tiempo, {{ $nombre }} se convirtió en uno de los restaurantes más codiciados de la ciudad, con una lista de espera de meses para conseguir una mesa. Juan y su equipo de chefs trabajaron incansablemente para crear un menú cerrado que cambiaba cada temporada, siempre ofreciendo platos innovadores y deliciosos.
            A medida que el restaurante crecía en popularidad, Juan decidió expandir su negocio y abrir una segunda ubicación en otra ciudad. Ahora, The Experience es conocido en todo el país como uno de los mejores restaurantes para disfrutar de una experiencia culinaria única e inolvidable.</p>
        <p class="text-white" style="margin-top: 40px">
            A medida que el restaurante crecía en popularidad, Juan decidió
            expandir su negocio y abrir una segunda ubicación en otra ciudad.
            Con el tiempo, {{ $nombre }} se convirtió en una cadena de restaurantes con
            varias ubicaciones a lo largo del país, cada una con su propio menú
            único y una experiencia culinaria única.</p>
        <p class="text-white" style="margin-top: 40px">
            A lo largo de los años, {{ $nombre }} ha ganado varios premios y
            reconocimientos por su excelencia culinaria y su servicio excepcional.
            También ha sido mencionado en varias publicaciones y revistas
            gastronómicas de renombre mundial. Sin duda, {{ $nombre }} ha
            establecido una reputación como uno de los mejores restaurantes
            del país y sigue siendo un destino popular para los amantes de la
            comida de alta calidad.</p>
    </div>
@endsection
