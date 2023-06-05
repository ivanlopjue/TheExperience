@extends('plantillas.layout')
@section('titulo', 'Reserva')
@section('contenido')
<div style="text-align: center">
    <h1 id="nombreRestaurante" class="text-white">- Mi cuenta -</h1>
</div>
<nav class="text-white navbar navbar-expand-md navbar-light">
    <div class="container">
        {{-- Mensaje de bienvenida a tu cuenta --}}
        <span class="text-white navbar-brand" style="font-family: 'Courier New', Courier, monospace;"><span style="font-size: 30pxpx">{{ Auth::user()->name }}</span>, te damos la bienvenida a nuestra familia</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="text-white navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    {{-- Boton para salir de tu sesion --}}
                    <a class="btn enlace text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="cont_cuenta">
    <div style="text-align: center">
        <h4 class="text-white" style="font-family: 'Courier New', Courier, monospace;">- Mis reservas -</h4>
    </div>
    <div style="text-align: center">
        <h4 class="text-white" style="font-family: 'Courier New', Courier, monospace;">- Reservar -</h4>
    </div>
</div>
<div class="cont_cuenta">
    <div class="mis_reservas">
        <table class="table table-striped">
            {{-- Mostrar las reservas de la cuenta iniciada, se controla por el id de usuario --}}
            <thead class='text-white'>
                <tr>
                    <th></th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Comensales</th>
                    <th>Observaciones</th>
                    <th>Localizador</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class='text-white'>
                @foreach ($reservaUsers as $reserva)
                <tr>
                    <td>
                        {{-- enlace para la modificacion de la reserva --}}
                        <a href="{{ route('reservas.edit', ['reserva'=>$reserva]) }}">
                            <span class="material-icons" title="Editar">edit</span>
                        </a>
                    </td>
                    <td class='text-white'>{{ $reserva->fecha }}</td>
                    <td class='text-white'>{{ $reserva->hora }}</td>
                    <td class='text-white'>{{ $reserva->comensales }}</td>
                    <td class='text-white'>{{ $reserva->observaciones }}</td>
                    <td class='text-white'>{{ $reserva->localizador }}</td>
                    <td>
                        {{-- enlace para la eliminacion de la reserva --}}
                       <a href="#deleteModal{{ $reserva->id }}" data-bs-toggle="modal">
                        <span class="material-icons" title="Eliminar">delete</span>
                       </a>
                    </td>
                </tr>
                {{-- Formulario de confirmacion de la eliminacion de la reserva --}}
                <form action="{{ route('reservas.destroy', ['reserva' => $reserva]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    {{-- Delete Warning Modal --}}
                    <div class="modal fade" id="deleteModal{{ $reserva->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar Reserva</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body bg-dark text-white">
                                    <p>Se va a eliminar la reserva <b>{{ $reserva->localizador }}</b> para el día <b>{{ $reserva->fecha}}</b>, ¿Estás de acuerdo {{ Auth::user()->name}}?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-bs-dismiss="modal"
                                        class="btn enlace text-white">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="form_reserva">
         {{-- Control de errores de campos vacios --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Formulario en la pagina mi cuenta del usuario --}}
        <form action="{{ route('reservas.store') }}" method="post">
            @csrf
            <input type="hidden" name="id_usuario" id="id_usuario" value="{{ Auth::user()->id }}"/>
            <div class="row mt-4">
                <div class="input-field col-sm-6 text-white">
                    <label for="nombre_anonimo">Nombre</label>
                    <input type="text" name="nombre_anonimo" id="nombre_anonimo" class="form-control text-white enlace" value="{{ Auth::user()->name }}"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="input-field col-sm-6 text-white">
                    <label for="correo_anonimo">Correo</label>
                    <input type="mail" name="correo_anonimo" id="correo_anonimo" class="form-control text-white enlace" value="{{ Auth::user()->email }}"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="input-field col-sm-4 text-white">
                    <label for="tel_anonimo">Teléfono</label>
                    <input type="text" name="tel_anonimo" id="tel_anonimo" class="form-control text-white enlace" value="{{ old('tel_anonimo') }}"/>
                </div>
            </div>
                <div class="input-field col-sm-12 text-white">
                    <label for="comensales_anonimo">Comensales</label>
                    <input type="number" name="comensales_anonimo" id="comensales_anonimo" class="form-control text-white enlace" value="{{ old('comensales_anonimo') }}" min="1" max="6" step="1"/>
                    <p  class="text-white" style="font-size:12px">* Para grupos de mas de seis personas póngase en <a href="{{route('contacto')}}" class="enlace text-white">contacto</a> con nosotros, gracias</p>
                </div>
            <div class="row mt-4">
                <div class="input-field col-sm-12 text-white">
                    <label for="obser_anonimo">Observaciones</label>
                    <textarea name="obser_anonimo" id="obser_anonimo" class="form-control text-white enlace" placeholder="Alergias, intolerancias...">{{ old('obser_anonimo') }}</textarea>
                </div>
            </div>

            <div class="row mt-4">
                <div class="input-field col-sm-4 text-white">
                    <label for="hora_anonimo">Hora</label>
                    <select class="form-control text-white enlace" name="hora_anonimo" id="hora_anonimo">
                        <optgroup label="Comida ----">
                            <option value="13:30">13:30</option>
                            <option value="14:30">14:30</option>
                        </optgroup>
                        <optgroup label="Cena ----">
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                        </optgroup>
                    </select>
                </div>
                <div class="input-field col-sm-8 text-white">
                    <label for="fecha_anonimo">Fecha</label>
                    <input type="date" name="fecha_anonimo" id="fecha_anonimo" class="form-control text-white enlace" value="{{ old('fecha_anonimo') }}"/>
                </div>
            </div>
            <div style="font-size:14px; margin-top: 15px; text-align: center">
                <p  class="text-white bg-warning rounded" id="disponible">
                    {{-- Control de error si se reservan mas plazas que las disponibles --}}
                    <?php
                        if (isset($total)){
                            echo "Quedan un total de ".$total." plazas para ese día, disculpe las molestias";
                        }
                    ?>
                </p>
            </div>
            <div style="font-size:14px; margin-top: 15px; text-align: center">
                <p  class="text-white bg-warning rounded" id="disponible">
                    {{-- Control de error si se reservan mas plazas que las disponibles --}}
                    <?php
                        if (isset($mensaje)){
                            echo $mensaje;
                        }
                    ?>
                </p>
            </div>
            <div class="row mt-4">
                <div class="input-field col-sm-6 text-lg-end">
                    <input type="submit" class="btn text-white enlace" value="Reservar" id="enviar"/>
                </div>
                <div class="input-field col-sm-6 text-lg-start">
                    <input type="reset" class="btn text-white enlace" value="Borrar" />
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Modificacion del color del fondo dependiendo de la disponibilidad para la fecha y dia --}}
<script type="text/javascript">

    let fecha = document.getElementById("fecha_anonimo");
    let hora = document.getElementById("hora_anonimo");
    fecha.addEventListener("change", disponibilidad);

    function disponibilidad(){
        let fechaSeleccionada = new Date(this.value);
        let fechaParaUsar = fechaSeleccionada.toISOString().substr(0, 10);
        let fechaActual = new Date();
        let horaParaUsar = hora.value;
        let error = document.getElementById("disponible");
        let enviar =  document.getElementById("enviar");

        for (const disponible of <?php echo $disponible ?>) {
                let fecha = disponible.fecha;
                let hora = disponible.hora;
                let comen = disponible.comen_disponibles;
                let comenPasados = document.getElementById("comensales_anonimo").value;
                // Se controla que la fecha seleccionada no sea anterior a la actual
                if (fechaSeleccionada < fechaActual) {
                    this.style.backgroundColor =  "red";
                    error.textContent = "*No es posible reservar en fechas anteriores al dia actual";
                    enviar.setAttribute('style', 'display: none;');
                // Se controla que las plazas disponibles para el dia seleccionado no sean 0
                } else if (<?php echo $mensaje ?>) {
                    this.style.backgroundColor =  "red";
                    error.textContent = "*No quedan plazas para este dia y hora";
                    enviar.setAttribute('style', 'display: none;');
                // Se pone el fondo verde para indicar que hay plazas disponibles
                } else {
                    this.style.backgroundColor = "green";
                    error.textContent = '';
                    enviar.setAttribute('style', 'display: block;');
                }
            }
    }
</script>
@endsection
