@extends('plantillas.layout')
@section('titulo', 'Reserva')
@section('contenido')
<div style="text-align: center">
    <h1 id="nombreRestaurante" class="text-white">- Reserva -</h1>
</div>
<div id="reservas">
    <div id="anonimo">
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
        <div class="container-fluid">
            {{-- Formulario para la reserva sin registro donde se recupera la informacion que ya se habia completado en caso de error--}}
            <form action="{{ route('reservas.store') }}" method="post">
                @csrf
                <div class="row mt-4">
                    <div class="input-field col-sm-6 text-white">
                        <label for="nombre_anonimo">Nombre</label>
                        <input type="text" name="nombre_anonimo" id="nombre_anonimo" class="form-control text-white enlace" value="{{ old('nombre_anonimo') }}"/>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="input-field col-sm-6 text-white">
                        <label for="correo_anonimo">Correo</label>
                        <input type="mail" name="correo_anonimo" id="correo_anonimo" class="form-control text-white enlace" value="{{ old('correo_anonimo') }}"/>
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
                    <div class="input-field col-sm-8 text-white">
                        <label for="fecha_anonimo">Fecha</label>
                        <input type="date" name="fecha_anonimo" id="fecha_anonimo" class="form-control text-white enlace" value="{{ old('fecha_anonimo') }}"/>

                    </div>
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

                        for (const $disponible of <?php echo $disponible ?>) {
                                let fecha = $disponible.fecha;
                                let hora = $disponible.hora;
                                let comen = $disponible.comen_disponibles;
                                // Se controla que la fecha seleccionada no sea anterior a la actual
                                if (fechaSeleccionada < fechaActual) {
                                    this.style.backgroundColor =  "red";
                                    error.textContent = "*No es posible reservar en fechas anteriores al dia actual";
                                    enviar.setAttribute('style', 'display: none;');
                                // Se controla que las plazas disponibles para el dia seleccionado no sean 0
                                } else if (fechaParaUsar == fecha && horaParaUsar == hora && comen == 0) {
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
    <div id="nueva_cuenta">
        <div style="text-align: center">
            <a href="{{ route('login') }}"><h2  class="btn text-white enlace">Login</h2></a>
        </div>
        <div style="text-align: center">
            <a href="{{ route('register') }}"><h2  class="btn text-white enlace">Registrate</h2></a>
        </div>
    </div>
    <div style="text-align: center; margin-top:20px; font-size:12px">
        <p  class="text-white">* Desde tu cuenta puedes gestionar tus reservas</p>
    </div>
</div>
@endsection
