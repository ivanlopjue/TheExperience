<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    // Todas las rutas que no necesitan de controlador recurso
    private static $nombre = 'The Experience';

    public function inicio() {
        return view('inicio', ['nombre' => self::$nombre]);
    }

    public function historia() {
        return view('historia', ['nombre' => self::$nombre]);
    }

    public function menu() {
        return view('menu', ['nombre' => self::$nombre]);
    }

    public function contacto() {
        return view('contacto', ['nombre' => self::$nombre]);
    }

}
