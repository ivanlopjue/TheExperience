@extends('plantillas.layout')
@section('titulo', 'Menú')
@section('contenido')
<div style="text-align: center">
    <h1 id="nombreRestaurante" class="text-white">- Menú {{ $nombre }} -</h1>
</div>
<div id="platosMenu">
    <div class="platos">
        <img src="/imagenes/primero.jpg" alt="" width="150px" height="100px">
        <details>
            <summary class="text-white">Tartare de atún con wasabi y caviar</summary>
            <p class="text-white"> Este plato presenta finas lonjas de atún fresco marinado en aceite de sésamo y wasabi, con un toque de caviar sobre una base de aguacate.</p>
        </details>
    </div>
    <div class="platos">
        <img src="/imagenes/segundo.jpg" alt="" width="150px" height="100px">
        <details>
            <summary class="text-white">Risotto de setas y trufas</summary>
            <p class="text-white">Este risotto cremoso está hecho con una variedad de setas sautéed y trufas frescas, mezclados con arroz Arborio y un caldo de hueso.</p>
        </details>
    </div>
    <div class="platos">
        <img src="/imagenes/pescado.jpg" alt="" width="150px" height="100px">
        <details>
            <summary class="text-white"> Pez espada a la parrilla con salsa de limón y hierbas</summary>
            <p class="text-white">Este pez espada fresco se cocina a la perfección sobre las brasas y se sirve con una salsa de limón y hierbas picante.</p>
        </details>
    </div>
    <div class="platos">
        <img src="/imagenes/carne.jpg" alt="" width="150px" height="100px">
        <details>
            <summary class="text-white"> Lomo de cerdo con manzana y jengibre</summary>
            <p class="text-white">Este lomo de cerdo tierno se asa hasta la perfección y se combina con una salsa dulce y picante de manzana y jengibre.</p>
        </details>
    </div>
    <div class="platos">
        <img src="/imagenes/cuarto.jpg" alt="" width="150px" height="100px">
        <details>
            <summary class="text-white">Roulade de pollo con espárragos y salsa de mostaza</summary>
            <p class="text-white">Este roulade de pollo relleno de espárragos frescos se cocina hasta la perfección y se sirve con una salsa de mostaza ligeramente picante.</p>
        </details>
    </div>
    <div class="platos">
        <img src="/imagenes/ensalada.jpg" alt="" width="150px" height="100px">
        <details>
            <summary class="text-white">Ensalada de quinoa con aguacate y granada</summary>
            <p class="text-white">Esta ensalada fresca y saludable combina quinoa con aguacate maduro y granada, mezclado con un aderezo ligero de aceite de oliva y limón.</p>
        </details>
    </div>
    <div class="platos">
        <img src="/imagenes/postre.jpg" alt="" width="150px" height="100px">
        <details>
            <summary class="text-white">Crème brûlée de vainilla</summary>
            <p class="text-white">Este clásico postre francés presenta una capa gruesa de crema batida con vainilla y se hornea hasta formar una corteza crocante de azúcar caramelizado.</p>
        </details>
    </div>
</div>
@endsection
