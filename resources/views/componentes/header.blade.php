<header class="container-fluid main-header p-4">
    <nav class="pt-1 navbar-fixed-top" id="menuNav">
        <ul class="nav nav-pills ">
            <li class="nav-item"><a href="{{ route('inicio') }}" class="nav-link menu-item text-white enlace">Inicio</a></li>
            <li class="nav-item"><a href="{{ route('historia') }}" class="nav-link menu-item text-white enlace">Historia</a></li>
            <li class="nav-item"><a href="{{ route('menu') }}" class="nav-link menu-item text-white enlace">Menú</a></li>
            {{-- Se controla si es un usuario registrado y se oculta el campo reserva --}}
            @if (!Auth::check())
                <li class="nav-item"><a href="{{ route('reservas.index') }}" class="nav-link menu-item text-white enlace">Reserva</a></li>
            @endif
            <li class="nav-item"><a href="{{ route('contacto') }}" class="nav-link menu-item text-white enlace">Contacto</a></li>
            {{-- Si es un usuario regitrado aparece la opcion de mi cuenta, de lo contrario el de inicio de sesion --}}
            @if (Auth::check())
                <li class="nav-item"><a href="{{ route('reservas.index') }}" class="nav-link menu-item text-white enlace">Mi cuenta</a></li>
             @else
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link menu-item text-white enlace">Iniciar sesiòn</a></li>
            @endif
        </ul>
    </nav>
</header>

