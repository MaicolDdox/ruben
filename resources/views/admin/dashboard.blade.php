@extends('components.layouts.app.app')
@section('content')
    <h1>Bienvenido al panel</h1>
    <p>Contenido de prueba para el panel de control.</p>

    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            Cerrar sesión
        </button>
    </form>
@endauth
@endsection