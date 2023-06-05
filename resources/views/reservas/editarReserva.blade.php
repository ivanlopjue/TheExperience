@extends('plantillas.layout')
@section('titulo', 'Reserva')
@section('contenido')
<div style="text-align: center">
    <h1 id="nombreRestaurante" class="text-white">- Modificar Reserva -</h1>
</div>
<div id="reservas">
    <div id="anonimo">
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
            {{-- Formulario para editar la reserva, se recogen los valores de la reserva ya hecha --}}
            <form action="{{ route('reservas.update', ['reserva' => $reserva]) }}" method="post">
                @method('PUT')
                @csrf
                <input type="hidden" name="id_usuario" id="id_usuario" value="{{ Auth::user()->id }}"/>
                <div class="row mt-4">
                    <div class="input-field col-sm-6 text-white">
                        <label for="nombre_anonimo">Nombre</label>
                        <input type="text" name="nombre_anonimo" id="nombre_anonimo" class="form-control text-white enlace" value="{{ Auth::user()->name }}" readonly/>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="input-field col-sm-6 text-white">
                        <label for="correo_anonimo">Correo</label>
                        <input type="mail" name="correo_anonimo" id="correo_anonimo" class="form-control text-white enlace" value="{{ Auth::user()->email }}" readonly/>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="input-field col-sm-4 text-white">
                        <label for="tel_anonimo">Teléfono</label>
                        <input type="text" name="tel_anonimo" id="tel_anonimo" class="form-control text-white enlace" value="{{ $reserva->telefono }}"/>
                    </div>
                </div>
                    <div class="input-field col-sm-12 text-white">
                        <label for="comensales_anonimo">Comensales</label>
                        <input type="number" name="comensales_anonimo" id="comensales_anonimo" class="form-control text-white enlace" value="{{ $reserva->comensales }}" min="1" max="6" step="1"/>
                        <p  class="text-white" style="font-size:12px">* Para grupos de mas de seis personas póngase en <a href="{{route('contacto')}}" class="enlace text-white">contacto</a> con nosotros, gracias</p>
                    </div>
                <div class="row mt-4">
                    <div class="input-field col-sm-12 text-white">
                        <label for="obser_anonimo">Observaciones</label>
                        <textarea name="obser_anonimo" id="obser_anonimo" class="form-control text-white enlace" placeholder="Alergias, intolerancias...">{{ $reserva->observaciones }}</textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="input-field col-sm-8 text-white">
                        <label for="fecha_anonimo">Fecha</label>
                        <input type="date" name="fecha_anonimo" id="fecha_anonimo" class="form-control text-white enlace" value="{{ $reserva->fecha }}" readonly/>

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
                <div class="row mt-4">
                    <div class="input-field col-sm-6 text-lg-end">
                        <input type="submit" class="btn text-white enlace" value="Modificar" />
                    </div>
                    <div class="input-field col-sm-6 text-lg-start">
                        <a href="{{ route('reservas.index') }}" class="btn enlace text-white">Mi cuenta</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
