@extends('plantillas.layout')
@section('titulo', 'The Experience')
@section('contenido')
<div>
    <h1 class="text-white" id="nombreRestaurante">- {{ $nombre }} -</h1>
</div>
<div class="video">
    {{-- Video para la pagina de inicio --}}
    <video src="/video/intro.mp4" autoplay loop muted width="1080px" height="560px"></video>
</div>
<div id="articulos">
    <div class="articulosPrensa">
        <article class="text-white">"{{ $nombre }} ofrece una experiencia culinaria única e inolvidable en un ambiente sofisticado y acogedor"</article>
        <p class="text-white small">-El Paladar Gourmet-</p>
    </div>
    <div class="articulosPrensa">
        <article class="text-white">"{{ $nombre }}: El sabor de la excelencia"</article>
        <p class="text-white small"> -Gastro innovadora-</p>
    </div>
    <div class="articulosPrensa">
        <article class="text-white">"{{ $nombre }}: Una Experiencia Culinaria Inolvidable"</article>
        <p class="text-white small">-Sabores de Elite-</p>
    </div>
    <div class="articulosPrensa">
        <article class="text-white">"Restaurante impresionante que ofrece una experiencia culinaria única y emocionante"</article>
        <p class="text-white small">-La cocina del futuro-</p>
    </div>
</div>

@endsection
