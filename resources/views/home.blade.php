@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="text-align: center">
        <div class="col-md-8">
            <div class="card bg-dark">
                <div class="card-header text-white" style="font-family: 'Courier New', Courier, monospace;">Nos alegramos de verte por aquí, <b>{{ Auth::user()->name }}</b></div>

                <div class="card-body text-white" style="text-align: center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="{{ route('reservas.index') }}" class="enlace text-white btn" >Mi cuenta</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
