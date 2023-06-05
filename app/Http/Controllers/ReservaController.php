<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    private static $nombre = 'The Experience';
    public $mensaje = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Se controla si es un usuario registrado, mostrando la vista mi cuenta si lo es o reserva si no lo es
        if(Auth::check()){
            $mensaje = session('mensaje');
            $disponible = Reserva::all();
            $reservaUsers = Reserva::where("reservas.id_usuario","=",Auth::user()->id)->get();
            return view('mi_cuenta', ['nombre' => self::$nombre, 'reservaUsers'=>$reservaUsers,'disponible'=> $disponible, 'mensaje' => $mensaje]);
        } else {
            $mensaje = session('mensaje');
            $disponible = Reserva::all();
            return view('reserva', ['nombre' => self::$nombre, 'disponible'=>$disponible, 'mensaje' => $mensaje]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'nombre_anonimo' => 'required|max:50',
            'correo_anonimo' => 'required|max:100',
            'tel_anonimo' => 'required|max:100',
            'fecha_anonimo' => 'required',
            'hora_anonimo' => 'required|in:13:30,14:30,20:00,21:00',
            'comensales_anonimo' => 'required|max:6',
            'obser_anonimo' => 'max:300',
           ];

        $request->validate($reglas);

        $reserva = new Reserva();
        $reserva->nombre = $request->nombre_anonimo;
        $reserva->mail = $request->correo_anonimo;
        $reserva->telefono = $request->tel_anonimo;
        $reserva->fecha = $request->fecha_anonimo;
        $reserva->hora = $request->hora_anonimo;
        $reserva->comensales = $request->comensales_anonimo;
        $reserva->localizador = substr($reserva->nombre,1,1).rand(1500, 9999).substr($reserva->telefono,2,6);
        $reserva->observaciones = $request->obser_anonimo;
        $reserva->id_usuario = $request->id_usuario;

        $fechaHora = Reserva::where('fecha','=',$reserva->fecha)->where('hora','=',$reserva->hora)->count();
        $comensales = Reserva::where('fecha','=',$reserva->fecha)->where('hora','=',$reserva->hora)->pluck('comen_disponibles')->first();
        $comensalesTotal = 15;
    //Se controla que si existe un registro con la misma fecha y hora
        if ($fechaHora > 0){
            $reservaRepetida = Reserva::where('mail','=',$reserva->mail)->where('fecha','=',$reserva->fecha)->where('hora','=',$reserva->hora)->count();
            // en caso de que ya exista una reserva igual
            if ($reservaRepetida != 0){
                $mensaje = 'Ya tienes una reserva en esa fecha y hora, consulta tu correo para ver el localizador. Si tiene problemas con su reserva pongase en contacto con nosotros';
                return redirect()->route('reservas.index', ['mensaje' => $mensaje])->with('mensaje',$mensaje);
            } else {
                // En caso de que no exista
                $reserva->comen_disponibles = $comensales -  $reserva->comensales;
                // Se controla queno se supere el numero de plazas disponibles
                if ($reserva->comen_disponibles < $reserva->comensales){
                    $mensaje = true;
                    return redirect()->route('reservas.index', ['mensaje' => $mensaje])->with('mensaje',$mensaje);
                } else {
                    Reserva::where('fecha','=',$reserva->fecha)->where('hora','=',$reserva->hora)->update(['comen_disponibles'=>$reserva->comen_disponibles]);
                    $reserva->save();
                    return view('reservas.guardado')->with(['localizador' => $reserva->localizador, 'nombre' => self::$nombre]);
                }
            }
        }else {
            $reserva->comen_disponibles = $comensalesTotal - $reserva->comensales;
            $reserva->save();
            return view('reservas.guardado')->with(['localizador' => $reserva->localizador, 'nombre' => self::$nombre]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        $reservaUsers = Reserva::where("reservas.id_usuario","=",Auth::user()->id)->get();
        return view('mi_cuenta')->with(['reservaUsers' => $reservaUsers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {

        return view('reservas.editarReserva')->with(['reserva' => $reserva]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        $reglas = [
            'nombre_anonimo' => 'required|max:50',
            'correo_anonimo' => 'required|max:100',
            'tel_anonimo' => 'required|max:100',
            'fecha_anonimo' => 'required',
            'hora_anonimo' => 'required|in:13:30,14:30,20:00,21:00',
            'comensales_anonimo' => 'required|max:6',
            'obser_anonimo' => 'max:300',
           ];

        $request->validate($reglas);

        //Reserva editada
        $reservaEditada = Reserva::find($reserva->id);
        $reservaEditada->nombre = $reserva->nombre;
        $reservaEditada->mail = $reserva->mail;
        $reservaEditada->telefono = $request->tel_anonimo;
        $reservaEditada->comensales = $request->comensales_anonimo;
        $reservaEditada->observaciones = $request->obser_anonimo;
        $reservaEditada->id_usuario = $request->id_usuario;
        $reservaEditada->localizador = $reserva->localizador;

        $comensalesYaGuardados = Reserva::where('fecha','=',$reserva->fecha)->where('hora','=',$reserva->hora)->where('localizador','=', $reservaEditada->localizador)->pluck('comensales')->first();
        $comensalesDisponibles = Reserva::where('fecha','=',$reserva->fecha)->where('hora','=',$reserva->hora)->pluck('comen_disponibles')->first();
        $reservaEditada->comen_disponibles = ($comensalesYaGuardados + $comensalesDisponibles) - $reservaEditada->comensales;
        Reserva::where('fecha','=',$reservaEditada->fecha)->where('hora','=',$reservaEditada->hora)->update(['comen_disponibles'=>$reservaEditada->comen_disponibles]);


        $reservaEditada->save();
        return view('reservas.editado')->with(['localizador' => $reservaEditada->localizador, 'nombre' => self::$nombre]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        $nuevoComenDisponible = $reserva->comensales + $reserva->comen_disponibles;
        Reserva::where('fecha','=',$reserva->fecha)->where('hora','=',$reserva->hora)->update(['comen_disponibles'=> $nuevoComenDisponible]);
        $reserva->delete();
        return redirect()->route('reservas.index');
    }

}
